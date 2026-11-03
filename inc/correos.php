<?php
defined('ABSPATH') || exit;

/*
 * Correos HTML de los formularios (propio de Lumenti; el motor inc/forms.php no se edita).
 *
 * 1. Aviso al equipo: el motor arma un texto plano y lo pasa por el filtro lumenti_form_mail; aquí se cambia
 *    por el correo del diseño.
 * 2. Confirmación a quien llenó el form: al terminar el envío (lumenti_form_submitted) y solo si el aviso al
 *    equipo salió bien (si falló, la persona ve un error y puede reintentar: no se duplica).
 *
 * Una sola fuente por correo: lumenti_email_<correo>() devuelve asunto, vista previa, pie y una lista de
 * bloques (título, párrafos, datos, botones…). De esos mismos bloques salen el HTML
 * (template-parts/emails/cuerpo.php dentro de layout.php) y la versión en texto plano (AltBody), así que las
 * dos dicen siempre lo mismo. La vista previa de la bandeja es siempre un texto que también está en el cuerpo.
 * Los 4 correos van en pares con la misma estructura:
 *   - Avisos al equipo (empresas-equipo, newsletter-equipo): título, fecha y página de origen, recuadro de
 *     quién escribió con "Responder", los datos en filas y en el pie a quién le llega la respuesta.
 *   - Correos a la persona (empresas-confirmacion, newsletter-bienvenida): saludo, qué pasa ahora, lo que
 *     eligió o los artículos, WhatsApp con su teléfono y firma.
 *
 * El From lo pone Fluent SMTP. Los avisos responden a quien envió el form (Reply-To del motor); los correos a
 * la persona responden a contacto@ (Ajustes del sitio → Contacto).
 * Para no servir de rebote de spam, los correos a la persona no repiten texto libre del form (mensaje,
 * empresa): solo el nombre (validado como nombre) y las opciones elegidas de listas fijas.
 */

const LUMENTI_EMAIL_FORMS = ['empresas', 'newsletter'];

// Colores de la web (tokens de src/css/input.css) en hexadecimal: los correos no leen variables CSS.
const LUMENTI_EMAIL_COLORS = [
    'fondo'   => '#f5f3ee', // arena
    'tarjeta' => '#ffffff',
    'linea'   => '#ece9e2',
    'titulo'  => '#1a202c',
    'texto'   => '#4e5e68',
    'suave'   => '#626771',
    'marca'   => '#2e6c79',
];

/* ---------------------------------------------------------------------------
 * Datos del sitio
 * ------------------------------------------------------------------------ */

function lumenti_email_contacto(): array
{
    $contacto = function_exists('get_field') ? (array) (get_field('opciones_contacto', 'option') ?: []) : [];

    return [
        'correo'      => sanitize_email((string) ($contacto['correo'] ?? '')),
        'paciente'    => (string) ($contacto['telefono_paciente'] ?? ''),
        'corporativo' => (string) ($contacto['telefono_corporativo'] ?? ''),
        'direccion'   => (string) ($contacto['direccion'] ?? ''),
    ];
}

function lumenti_email_logo_url(): string
{
    return get_theme_file_uri('assets/img/email/logo.png');
}

// URL de la política de privacidad (la de Ajustes → Privacidad, o la página legal del tema).
function lumenti_email_privacidad_url(): string
{
    $url = get_privacy_policy_url();
    if ($url === '') {
        $pagina = get_page_by_path('politica-de-privacidad');
        $url = $pagina ? (string) get_permalink($pagina) : '';
    }

    return $url;
}

// Dominio legible de la web (lumentisaludmental.com).
function lumenti_email_dominio(): string
{
    return (string) preg_replace('#^www\.#', '', (string) wp_parse_url(home_url('/'), PHP_URL_HOST));
}

// Fecha y hora del envío con la zona horaria de WordPress, ej. "3 de noviembre de 2026, 15:40".
function lumenti_email_fecha(): string
{
    return wp_date(__('j \d\e F \d\e Y, H:i', 'lumenti'));
}

// Primer nombre para el saludo ("Ana Pérez" → "Ana").
function lumenti_email_primer_nombre(string $nombre): string
{
    $partes = preg_split('/\s+/u', trim($nombre));

    return (string) ($partes[0] ?? '');
}

// Página desde la que se envió el form: URL completa y ruta legible ("/empresas/").
function lumenti_email_origen(): array
{
    $url = esc_url_raw((string) wp_get_raw_referer());
    $ruta = $url !== '' ? ((string) wp_parse_url($url, PHP_URL_PATH) ?: '/') : '';

    return ['url' => $url, 'ruta' => $ruta];
}

// Teléfono para mostrar → enlace tel: ("+51 942 901 535" → "tel:+51942901535").
function lumenti_email_tel(string $telefono): string
{
    $digitos = preg_replace('/\D+/', '', $telefono);

    return $digitos !== '' ? 'tel:+' . $digitos : '';
}

/* ---------------------------------------------------------------------------
 * Piezas del diseño (devuelven HTML ya escapado)
 * ------------------------------------------------------------------------ */

const LUMENTI_EMAIL_SANS = "'DM Sans',Arial,Helvetica,sans-serif";
const LUMENTI_EMAIL_SERIF = "Georgia,'Times New Roman',serif";

// Botón "a prueba de Outlook": la celda lleva el color de fondo y el enlace ocupa toda la celda.
function lumenti_email_boton(string $url, string $texto, string $variante = 'primario'): string
{
    if ($url === '' || $texto === '') {
        return '';
    }
    $c = LUMENTI_EMAIL_COLORS;
    $primario = $variante === 'primario';

    return sprintf(
        '<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="lm-e-btn" style="border-collapse:separate;">'
        . '<tr><td align="center" bgcolor="%1$s" style="border-radius:8px;background-color:%1$s;border:1px solid %3$s;">'
        . '<a href="%4$s" target="_blank" style="display:inline-block;padding:15px 26px;font-family:%6$s;font-size:16px;line-height:20px;font-weight:600;color:%2$s;text-decoration:none;border-radius:8px;white-space:nowrap;">%5$s</a>'
        . '</td></tr></table>',
        esc_attr($primario ? $c['marca'] : $c['tarjeta']),
        esc_attr($primario ? '#ffffff' : $c['marca']),
        esc_attr($c['marca']),
        esc_url($url),
        esc_html($texto),
        esc_attr(LUMENTI_EMAIL_SANS)
    );
}

// Fila de botones (en móvil se apilan a todo el ancho). $botones: [[url, texto, variante]].
function lumenti_email_botones(array $botones): string
{
    $celdas = '';
    foreach ($botones as $b) {
        $html = lumenti_email_boton((string) ($b[0] ?? ''), (string) ($b[1] ?? ''), (string) ($b[2] ?? 'primario'));
        if ($html !== '') {
            $celdas .= '<td class="lm-e-boton-celda" style="padding:0 12px 0 0;">' . $html . '</td>';
        }
    }

    return $celdas === '' ? '' : '<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="lm-e-botones" style="border-collapse:collapse;"><tr>' . $celdas . '</tr></table>';
}

// Enlace de texto del cuerpo (color de marca, subrayado: en un correo un enlace tiene que verse como enlace).
function lumenti_email_enlace(string $url, string $texto): string
{
    if ($url === '' || $texto === '') {
        return esc_html($texto);
    }

    return '<a href="' . esc_url($url, ['http', 'https', 'mailto', 'tel']) . '" target="_blank" style="color:' . esc_attr(LUMENTI_EMAIL_COLORS['marca']) . ';text-decoration:underline;">' . esc_html($texto) . '</a>';
}

// Separador vertical que respetan todos los clientes (Outlook ignora el margin de los div).
function lumenti_email_espacio(int $alto): string
{
    return '<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;"><tr><td height="' . $alto . '" style="height:' . $alto . 'px;font-size:0;line-height:0;">&nbsp;</td></tr></table>';
}

// Valor de una fila: texto, lista o enlace ['url' => …, 'texto' => …]. Devuelve '' si está vacío.
function lumenti_email_valor_html(array $fila): string
{
    if (isset($fila['enlace'])) {
        $texto = (string) ($fila['enlace']['texto'] ?? '');
        return $texto === '' ? '' : lumenti_email_enlace((string) ($fila['enlace']['url'] ?? ''), $texto);
    }
    if (isset($fila['lista'])) {
        return implode('<br>', array_map('esc_html', array_values(array_filter(array_map('strval', (array) $fila['lista'])))));
    }

    return nl2br(esc_html((string) ($fila['valor'] ?? '')));
}

function lumenti_email_valor_texto(array $fila): string
{
    if (isset($fila['enlace'])) {
        return (string) ($fila['enlace']['texto'] ?? '');
    }
    if (isset($fila['lista'])) {
        $items = array_values(array_filter(array_map('strval', (array) $fila['lista'])));
        return $items ? "\n- " . implode("\n- ", $items) : '';
    }

    return (string) ($fila['valor'] ?? '');
}

/* ---------------------------------------------------------------------------
 * Render: HTML y texto plano a partir de los mismos bloques
 * ------------------------------------------------------------------------ */

/*
 * Bloques de un correo (cada uno es ['tipo' => …, …]):
 *   titulo   texto                                  título principal (h1)
 *   meta     texto, enlace? [url, texto]            línea chica bajo el título (fecha · página de origen)
 *   parrafo  texto
 *   recuadro titulo, texto?, botones? [[url, texto, variante]]   recuadro arena (quién escribió)
 *   subtitulo texto, nota?                         título de sección (h2) con una línea chica opcional
 *   filas    filas [[etiqueta, valor | lista | enlace]]        datos etiqueta / valor
 *   articulos articulos [[titulo, url, categoria, minutos]]
 *   botones  botones [[url, texto, variante]], nota?           botones con una línea chica debajo
 *   firma    saludo, firma
 */

function lumenti_email_html(array $correo): string
{
    ob_start();
    get_template_part('template-parts/emails/cuerpo', null, ['bloques' => $correo['bloques']]);
    $cuerpo = (string) ob_get_clean();

    ob_start();
    get_template_part('template-parts/emails/layout', null, [
        'titulo'    => $correo['asunto'],
        'preheader' => $correo['preheader'],
        'pie'       => $correo['pie'],
        'pie_nota'  => $correo['pie_nota'],
        'cuerpo'    => $cuerpo,
    ]);

    return (string) ob_get_clean();
}

function lumenti_email_texto(array $correo): string
{
    $partes = [];
    foreach ($correo['bloques'] as $b) {
        switch ($b['tipo']) {
            case 'titulo':
            case 'parrafo':
                $partes[] = (string) $b['texto'];
                break;
            case 'meta':
                $partes[] = trim((string) $b['texto'] . (!empty($b['enlace']['texto']) ? ' · ' . $b['enlace']['texto'] . ' (' . $b['enlace']['url'] . ')' : ''));
                break;
            case 'recuadro':
                $lineas = array_filter([(string) $b['titulo'], (string) ($b['texto'] ?? '')]);
                foreach ((array) ($b['botones'] ?? []) as $btn) {
                    if (!empty($btn[0])) {
                        $lineas[] = $btn[1] . ': ' . $btn[0];
                    }
                }
                $partes[] = implode("\n", $lineas);
                break;
            case 'subtitulo':
                $partes[] = mb_strtoupper((string) $b['texto'], 'UTF-8') . (!empty($b['nota']) ? "\n" . $b['nota'] : '');
                break;
            case 'filas':
                $lineas = [];
                foreach ($b['filas'] as $fila) {
                    $valor = lumenti_email_valor_texto($fila);
                    if (trim($valor) !== '') {
                        $lineas[] = $fila['etiqueta'] . ': ' . $valor;
                    }
                }
                if ($lineas) {
                    $partes[] = implode("\n", $lineas);
                }
                break;
            case 'articulos':
                $lineas = [];
                foreach ($b['articulos'] as $art) {
                    $meta = lumenti_email_articulo_meta($art);
                    $lineas[] = '- ' . $art['titulo'] . ($meta !== '' ? ' (' . $meta . ')' : '') . "\n  " . $art['url'];
                }
                if ($lineas) {
                    $partes[] = implode("\n", $lineas);
                }
                break;
            case 'botones':
                $lineas = [];
                foreach ($b['botones'] as $btn) {
                    if (!empty($btn[0])) {
                        $lineas[] = $btn[1] . ': ' . $btn[0];
                    }
                }
                if (!empty($b['nota'])) {
                    $lineas[] = $b['nota'];
                }
                if ($lineas) {
                    $partes[] = implode("\n", $lineas);
                }
                break;
            case 'firma':
                $partes[] = $b['saludo'] . "\n" . $b['firma'];
                break;
        }
    }

    return implode("\n\n", array_filter($partes, static fn($p) => trim($p) !== '')) . "\n\n-- \n" . lumenti_email_texto_pie($correo);
}

// Pie del texto plano: lo mismo que imprime layout.php.
function lumenti_email_texto_pie(array $correo): string
{
    if ($correo['pie'] === 'equipo') {
        return implode("\n", array_filter([lumenti_email_pie_equipo(), $correo['pie_nota']]));
    }
    $c = lumenti_email_contacto();
    $privacidad = lumenti_email_privacidad_url();

    return implode("\n", array_filter([
        'Lumenti · ' . __('Salud mental', 'lumenti'),
        $c['direccion'] !== '' ? $c['direccion'] . ' · ' . __('También atendemos en línea', 'lumenti') : '',
        implode(' · ', array_filter([$c['correo'], $c['paciente']])),
        lumenti_email_dominio() . ' (' . home_url('/') . ')',
        $privacidad !== '' ? __('Política de privacidad', 'lumenti') . ': ' . $privacidad : '',
        $correo['pie_nota'],
    ]));
}

function lumenti_email_pie_equipo(): string
{
    return sprintf(__('Aviso automático de un formulario de %s.', 'lumenti'), lumenti_email_dominio());
}

// "Neurodivergencias · 4 min de lectura"
function lumenti_email_articulo_meta(array $art): string
{
    $minutos = (int) ($art['minutos'] ?? 0);

    return implode(' · ', array_filter([
        (string) ($art['categoria'] ?? ''),
        $minutos > 0 ? sprintf(_n('%d min de lectura', '%d min de lectura', $minutos, 'lumenti'), $minutos) : '',
    ]));
}

/* ---------------------------------------------------------------------------
 * Envío (HTML + texto plano)
 * ------------------------------------------------------------------------ */

// wp_mail no acepta el texto alternativo: se guarda aquí y se pone en PHPMailer justo antes de enviar.
function lumenti_email_alt_body(?string $texto = null, bool $tomar = false): string
{
    static $pendiente = '';
    if ($texto !== null) {
        $pendiente = $texto;
    }
    if ($tomar) {
        $valor = $pendiente;
        $pendiente = '';
        return $valor;
    }

    return $pendiente;
}

add_action('phpmailer_init', function ($phpmailer) {
    $texto = lumenti_email_alt_body(null, true);
    if ($texto !== '' && $phpmailer->ContentType === 'text/html') {
        $phpmailer->AltBody = $texto;
    }
});

function lumenti_email_send($to, array $correo, array $headers = []): bool
{
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    lumenti_email_alt_body(lumenti_email_texto($correo));
    $ok = (bool) wp_mail($to, $correo['asunto'], lumenti_email_html($correo), $headers);
    lumenti_email_alt_body('', true); // Por si wp_mail falló antes de phpmailer_init.

    return $ok;
}

/* ---------------------------------------------------------------------------
 * Datos de cada form
 * ------------------------------------------------------------------------ */

// Texto visible de una opción de select/radio (el form guarda la clave).
function lumenti_email_opcion(array $form, string $key, string $valor): string
{
    return (string) ($form['fields'][$key]['options'][$valor] ?? $valor);
}

// "Taller… | Programa…" (campo oculto del grupo de casillas, inc/forms-extras.php) → lista.
function lumenti_email_grupo(string $valor): array
{
    $separador = defined('LUMENTI_FORM_GROUP_SEPARATOR') ? trim(LUMENTI_FORM_GROUP_SEPARATOR) : '|';

    return array_values(array_filter(array_map('trim', explode($separador, $valor))));
}

function lumenti_email_datos_empresas(array $form, array $data): array
{
    $whatsapp = preg_replace('/\D+/', '', (string) ($data['whatsapp'] ?? ''));

    return [
        'nombre'         => (string) ($data['nombre'] ?? ''),
        'empresa'        => (string) ($data['empresa'] ?? ''),
        'cargo'          => (string) ($data['cargo'] ?? ''),
        'whatsapp'       => $whatsapp,
        'whatsapp_texto' => $whatsapp !== '' ? '+51 ' . trim(chunk_split($whatsapp, 3, ' ')) : '',
        'correo'         => sanitize_email((string) ($data['correo'] ?? '')),
        'busca'          => lumenti_email_grupo((string) ($data['busca'] ?? '')),
        'colaboradores'  => lumenti_email_opcion($form, 'colaboradores', (string) ($data['colaboradores'] ?? '')),
        'mensaje'        => (string) ($data['mensaje'] ?? ''),
        'privacidad'     => !empty($data['privacidad']),
    ];
}

function lumenti_email_datos_newsletter(array $data): array
{
    return [
        'correo'     => sanitize_email((string) ($data['email'] ?? '')),
        'privacidad' => !empty($data['privacidad']),
    ];
}

// Últimos artículos publicados para la bienvenida: título, enlace, categoría y minutos de lectura.
function lumenti_email_articulos(int $cantidad): array
{
    $out = [];
    foreach (get_posts(['numberposts' => $cantidad, 'post_status' => 'publish', 'suppress_filters' => false]) as $post) {
        $categoria = get_the_category($post->ID);
        $out[] = [
            'titulo'    => wp_specialchars_decode(get_the_title($post), ENT_QUOTES),
            'url'       => (string) get_permalink($post),
            'categoria' => $categoria ? $categoria[0]->name : '',
            'minutos'   => function_exists('lumenti_reading_time') ? lumenti_reading_time($post) : 0,
        ];
    }

    return $out;
}

/* ---------------------------------------------------------------------------
 * Los 4 correos (única fuente de su contenido)
 * ------------------------------------------------------------------------ */

// Partes comunes de los dos avisos al equipo: fecha + página de origen, y a quién le llega la respuesta.
function lumenti_email_meta_equipo(): array
{
    $origen = lumenti_email_origen();

    return [
        'tipo'   => 'meta',
        'texto'  => sprintf(__('Llegó el %s', 'lumenti'), lumenti_email_fecha()),
        'enlace' => $origen['url'] !== '' ? ['url' => $origen['url'], 'texto' => sprintf(__('desde %s', 'lumenti'), $origen['ruta'])] : null,
    ];
}

function lumenti_email_nota_respuesta(string $correo): string
{
    return $correo !== '' ? sprintf(__('Si respondes este correo, tu respuesta le llega a %s.', 'lumenti'), $correo) : '';
}

function lumenti_email_privacidad_valor(bool $aceptada, string $detalle = ''): string
{
    if (!$aceptada) {
        return __('No aceptada', 'lumenti');
    }

    return $detalle !== '' ? sprintf(__('Aceptada, %s', 'lumenti'), $detalle) : __('Aceptada', 'lumenti');
}

function lumenti_email_empresas_equipo(array $d): array
{
    $nombre = lumenti_email_primer_nombre($d['nombre']);
    $mailto = $d['correo'] !== ''
        ? 'mailto:' . $d['correo'] . '?subject=' . rawurlencode(sprintf(__('Propuesta de Lumenti para %s', 'lumenti'), $d['empresa'] !== '' ? $d['empresa'] : $d['nombre']))
        : '';
    $wa = $d['whatsapp'] !== ''
        ? 'https://wa.me/51' . $d['whatsapp'] . '?text=' . rawurlencode(sprintf(__('Hola, %1$s. Te escribimos de Lumenti por la solicitud de propuesta que enviaste para %2$s.', 'lumenti'), $nombre, $d['empresa']))
        : '';
    $quien = implode(' · ', array_filter([$d['cargo'], $d['empresa']]));

    return [
        'asunto'    => sprintf(__('Solicitud de propuesta: %s', 'lumenti'), $d['empresa'] !== '' ? $d['empresa'] : $d['nombre']),
        'preheader' => implode(' · ', array_filter([$d['nombre'], $quien])),
        'pie'       => 'equipo',
        'pie_nota'  => lumenti_email_nota_respuesta($d['correo']),
        'bloques'   => [
            ['tipo' => 'titulo', 'texto' => __('Nueva solicitud de propuesta', 'lumenti')],
            lumenti_email_meta_equipo(),
            ['tipo' => 'recuadro', 'titulo' => $d['nombre'], 'texto' => $quien, 'botones' => [
                [$mailto, __('Responder', 'lumenti'), 'primario'],
                [$wa, __('Escribir por WhatsApp', 'lumenti'), 'secundario'],
            ]],
            ['tipo' => 'subtitulo', 'texto' => __('Datos de la solicitud', 'lumenti')],
            ['tipo' => 'filas', 'filas' => [
                ['etiqueta' => __('Nombre y apellido', 'lumenti'), 'valor' => $d['nombre']],
                ['etiqueta' => __('Empresa', 'lumenti'), 'valor' => $d['empresa']],
                ['etiqueta' => __('Cargo o área', 'lumenti'), 'valor' => $d['cargo']],
                ['etiqueta' => __('WhatsApp', 'lumenti'), 'enlace' => ['url' => $wa, 'texto' => $d['whatsapp_texto']]],
                ['etiqueta' => __('Correo', 'lumenti'), 'enlace' => ['url' => $d['correo'] !== '' ? 'mailto:' . $d['correo'] : '', 'texto' => $d['correo']]],
                ['etiqueta' => __('Qué buscan', 'lumenti'), 'lista' => $d['busca']],
                ['etiqueta' => __('Colaboradores', 'lumenti'), 'valor' => $d['colaboradores']],
                ['etiqueta' => __('Mensaje', 'lumenti'), 'valor' => $d['mensaje']],
                ['etiqueta' => __('Política de privacidad', 'lumenti'), 'valor' => lumenti_email_privacidad_valor($d['privacidad'])],
            ]],
        ],
    ];
}

function lumenti_email_newsletter_equipo(array $d): array
{
    $mailto = $d['correo'] !== '' ? 'mailto:' . $d['correo'] : '';
    $quien = __('Se suscribió al newsletter del blog', 'lumenti');

    return [
        'asunto'    => sprintf(__('Nueva suscripción al newsletter: %s', 'lumenti'), $d['correo']),
        'preheader' => implode(' · ', array_filter([$d['correo'], $quien])),
        'pie'       => 'equipo',
        'pie_nota'  => lumenti_email_nota_respuesta($d['correo']),
        'bloques'   => [
            ['tipo' => 'titulo', 'texto' => __('Nueva suscripción al newsletter', 'lumenti')],
            lumenti_email_meta_equipo(),
            ['tipo' => 'recuadro', 'titulo' => $d['correo'], 'texto' => $quien, 'botones' => [
                [$mailto, __('Responder', 'lumenti'), 'primario'],
            ]],
            ['tipo' => 'subtitulo', 'texto' => __('Datos de la suscripción', 'lumenti')],
            ['tipo' => 'filas', 'filas' => [
                ['etiqueta' => __('Correo', 'lumenti'), 'enlace' => ['url' => $mailto, 'texto' => $d['correo']]],
                ['etiqueta' => __('Política de privacidad', 'lumenti'), 'valor' => lumenti_email_privacidad_valor($d['privacidad'], __('incluye recibir contenidos por correo', 'lumenti'))],
            ]],
        ],
    ];
}

// WhatsApp de los correos a la persona: invitación, botón y el número visible debajo.
function lumenti_email_bloques_whatsapp(string $invitacion, string $url, string $etiqueta_telefono, string $telefono): array
{
    if ($url === '') {
        return [];
    }

    return [
        ['tipo' => 'parrafo', 'texto' => $invitacion],
        ['tipo' => 'botones', 'botones' => [[$url, __('Escribir por WhatsApp', 'lumenti'), 'primario']], 'nota' => $telefono !== '' ? $etiqueta_telefono . ': ' . $telefono : ''],
    ];
}

function lumenti_email_empresas_confirmacion(array $d): array
{
    $contacto = lumenti_email_contacto();
    $nombre = lumenti_email_primer_nombre($d['nombre']);
    $intro = __('Recibimos tu solicitud. Nuestro equipo corporativo la revisará con calma para preparar una propuesta pensada en tu organización y en lo que hoy necesita tu equipo.', 'lumenti');
    $wa = lumenti_whatsapp_url('corporativo', sprintf(__('Hola, soy %s. Envié una solicitud de propuesta desde la web y quisiera agregar algo.', 'lumenti'), $d['nombre']));
    $filas = [
        ['etiqueta' => __('Qué buscan', 'lumenti'), 'lista' => $d['busca']],
        ['etiqueta' => __('Colaboradores', 'lumenti'), 'valor' => $d['colaboradores']],
    ];
    $hay_filas = $d['busca'] || $d['colaboradores'] !== '';

    return [
        'asunto'    => $nombre !== '' ? sprintf(__('Recibimos tu solicitud, %s', 'lumenti'), $nombre) : __('Recibimos tu solicitud', 'lumenti'),
        'preheader' => $intro,
        'pie'       => 'publico',
        'pie_nota'  => '',
        'bloques'   => array_merge(
            [
                ['tipo' => 'titulo', 'texto' => $nombre !== '' ? sprintf(__('Gracias por escribirnos, %s', 'lumenti'), $nombre) : __('Gracias por escribirnos', 'lumenti')],
                ['tipo' => 'parrafo', 'texto' => $intro],
                ['tipo' => 'parrafo', 'texto' => __('Te contactaremos a la brevedad por correo o por WhatsApp para conversar los detalles.', 'lumenti')],
            ],
            $hay_filas ? [
                ['tipo' => 'subtitulo', 'texto' => __('Lo que nos contaste', 'lumenti')],
                ['tipo' => 'filas', 'filas' => $filas],
            ] : [],
            lumenti_email_bloques_whatsapp(
                __('Si quieres sumar algo o tienes una consulta puntual, responde este correo o escríbenos por WhatsApp.', 'lumenti'),
                $wa,
                __('Atención corporativa', 'lumenti'),
                $contacto['corporativo']
            ),
            [['tipo' => 'firma', 'saludo' => __('Un saludo,', 'lumenti'), 'firma' => __('Equipo corporativo de Lumenti', 'lumenti')]]
        ),
    ];
}

function lumenti_email_newsletter_bienvenida(array $d): array
{
    $contacto = lumenti_email_contacto();
    $intro = __('Cada cierto tiempo te enviaremos artículos escritos por nuestro equipo de psiquiatras y psicólogos: ansiedad, sueño, crianza, tratamientos y otros temas de salud mental, explicados con claridad y sin alarmar.', 'lumenti');
    $articulos = lumenti_email_articulos(3);
    $blog = (int) get_option('page_for_posts');
    $blog_url = $blog ? (string) get_permalink($blog) : home_url('/blog/');

    return [
        'asunto'    => __('Ya eres parte del newsletter de Lumenti', 'lumenti'),
        'preheader' => $intro,
        'pie'       => 'publico',
        'pie_nota'  => '',
        'bloques'   => array_merge(
            [
                ['tipo' => 'titulo', 'texto' => __('Gracias por suscribirte', 'lumenti')],
                ['tipo' => 'parrafo', 'texto' => $intro],
                ['tipo' => 'parrafo', 'texto' => __('Sin llenar tu bandeja: solo cuando tengamos algo que valga la pena leer.', 'lumenti')],
            ],
            $articulos ? [
                ['tipo' => 'subtitulo', 'texto' => __('Para empezar', 'lumenti'), 'nota' => __('Algunos de los últimos artículos del blog.', 'lumenti')],
                ['tipo' => 'articulos', 'articulos' => $articulos],
            ] : [],
            [['tipo' => 'botones', 'botones' => [[$blog_url, __('Ver todos los artículos', 'lumenti'), 'secundario']]]],
            lumenti_email_bloques_whatsapp(
                __('Si en algún momento quieres hablar con un especialista, escríbenos por WhatsApp. Te ayudamos a encontrar al profesional adecuado.', 'lumenti'),
                lumenti_whatsapp_url('paciente', lumenti_whatsapp_message('paciente')),
                __('Atención al paciente', 'lumenti'),
                $contacto['paciente']
            ),
            [['tipo' => 'firma', 'saludo' => __('Un saludo,', 'lumenti'), 'firma' => __('Equipo de Lumenti', 'lumenti')]]
        ),
    ];
}

/* ---------------------------------------------------------------------------
 * 1. Aviso al equipo (reemplaza el texto plano del motor)
 * ------------------------------------------------------------------------ */

add_filter('lumenti_form_mail', function (array $mail, array $form, array $data) {
    $id = (string) ($form['id'] ?? '');
    if (!in_array($id, LUMENTI_EMAIL_FORMS, true)) {
        return $mail;
    }

    $correo = $id === 'empresas'
        ? lumenti_email_empresas_equipo(lumenti_email_datos_empresas($form, $data))
        : lumenti_email_newsletter_equipo(lumenti_email_datos_newsletter($data));

    lumenti_email_alt_body(lumenti_email_texto($correo));

    $mail['subject'] = $correo['asunto'];
    $mail['message'] = lumenti_email_html($correo);
    $mail['headers'] = array_values(array_filter(
        (array) $mail['headers'],
        static fn($h) => stripos((string) $h, 'Content-Type:') !== 0
    ));
    $mail['headers'][] = 'Content-Type: text/html; charset=UTF-8';

    return $mail;
}, 10, 3);

/* ---------------------------------------------------------------------------
 * 2. Correo a quien llenó el form
 * ------------------------------------------------------------------------ */

add_action('lumenti_form_submitted', function ($form_id, $data, $sent, $form) {
    if (!$sent || !in_array((string) $form_id, LUMENTI_EMAIL_FORMS, true)) {
        return;
    }

    $contacto = lumenti_email_contacto();
    $headers = $contacto['correo'] !== '' ? ['Reply-To: ' . $contacto['correo']] : [];

    if ($form_id === 'empresas') {
        $d = lumenti_email_datos_empresas((array) $form, (array) $data);
        if (is_email($d['correo'])) {
            lumenti_email_send($d['correo'], lumenti_email_empresas_confirmacion($d), $headers);
        }
        return;
    }

    $d = lumenti_email_datos_newsletter((array) $data);
    if (is_email($d['correo'])) {
        lumenti_email_send($d['correo'], lumenti_email_newsletter_bienvenida($d), $headers);
    }
}, 10, 4);
