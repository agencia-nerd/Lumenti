<?php
defined('ABSPATH') || exit;

/*
 * Estructura común de los correos (inc/correos.php → lumenti_email_html).
 * Fondo arena de la web, tarjeta blanca de 600 px con el logo y el cuerpo, y un pie con los datos de contacto.
 * Tablas de maquetación (role="presentation") y estilos en línea: es lo que leen Gmail, Outlook (Windows y web),
 * Apple Mail, Yahoo y los clientes de Android. El <style> solo suma el ajuste a móvil y arreglos de clientes.
 * Tipografía: DM Sans donde el cliente carga fuentes web (Apple Mail, iOS, Android); si no, Arial.
 * Los títulos usan Georgia: la fuente de títulos de la web (Abenda) no está disponible en los correos.
 *
 * $args: titulo (asunto, para <title> y el nombre del artículo), preheader (vista previa en la bandeja),
 *        pie (equipo | publico), pie_nota (frase extra del pie, opcional), cuerpo (HTML ya escapado).
 */

$lumenti_c = LUMENTI_EMAIL_COLORS;
$lumenti_titulo = (string) ($args['titulo'] ?? '');
$lumenti_preheader = (string) ($args['preheader'] ?? '');
$lumenti_pie = ($args['pie'] ?? '') === 'equipo' ? 'equipo' : 'publico';
$lumenti_pie_nota = (string) ($args['pie_nota'] ?? '');
$lumenti_contacto = lumenti_email_contacto();
$lumenti_privacidad = lumenti_email_privacidad_url();
$lumenti_sans = LUMENTI_EMAIL_SANS;
// Central de citas: abre WhatsApp (la atiende un bot), no una llamada.
$lumenti_wa = lumenti_whatsapp_url('citas', lumenti_whatsapp_message('citas'));
$lumenti_pie_estilo = 'margin:0 0 6px;font-family:' . $lumenti_sans . ';font-size:13px;line-height:20px;color:' . $lumenti_c['suave'] . ';';
$lumenti_pie_enlace = 'color:' . $lumenti_c['suave'] . ';text-decoration:underline;';
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title><?= esc_html($lumenti_titulo) ?></title>
    <!--[if mso]>
    <noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript>
    <style>table, td, p, a, h1, h2 { font-family: Arial, Helvetica, sans-serif !important; } h1, h2 { font-family: Georgia, serif !important; }</style>
    <![endif]-->
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!--<![endif]-->
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        a[x-apple-data-detectors], #MessageViewBody a { color: inherit !important; text-decoration: none !important; }
        u + #body a { color: inherit; text-decoration: none; }
        @media only screen and (max-width: 620px) {
            .lm-e-exterior { padding: 16px 12px 32px !important; }
            .lm-e-tarjeta { padding: 32px 24px !important; }
            .lm-e-h1 { font-size: 24px !important; line-height: 31px !important; }
            .lm-e-fila-etiqueta, .lm-e-fila-valor { display: block !important; width: 100% !important; }
            .lm-e-fila-etiqueta { padding: 14px 0 2px !important; }
            .lm-e-fila-valor { border-top: 0 !important; padding: 0 0 14px !important; }
            .lm-e-botones, .lm-e-boton-celda { display: block !important; width: 100% !important; }
            .lm-e-boton-celda { padding: 0 0 12px !important; }
            .lm-e-btn { width: 100% !important; }
            .lm-e-btn a { display: block !important; }
            .lm-e-pie { padding: 24px 12px 0 !important; }
        }
    </style>
</head>
<body id="body" style="margin:0;padding:0;width:100%;background-color:<?= esc_attr($lumenti_c['fondo']) ?>;" bgcolor="<?= esc_attr($lumenti_c['fondo']) ?>">
    <div role="article" aria-roledescription="email" aria-label="<?= esc_attr($lumenti_titulo) ?>" lang="es" style="background-color:<?= esc_attr($lumenti_c['fondo']) ?>;">
        <?php if ($lumenti_preheader !== '') : ?>
            <?php // Vista previa en la bandeja; el relleno evita que el cliente complete con el texto del cuerpo. ?>
            <div style="display:none;max-height:0;max-width:0;overflow:hidden;opacity:0;mso-hide:all;font-size:1px;line-height:1px;color:<?= esc_attr($lumenti_c['fondo']) ?>;"><?= esc_html($lumenti_preheader) ?><?= str_repeat('&#847;&zwnj;&nbsp;', 40) ?></div>
        <?php endif; ?>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="<?= esc_attr($lumenti_c['fondo']) ?>" style="border-collapse:collapse;background-color:<?= esc_attr($lumenti_c['fondo']) ?>;">
            <tr>
                <td class="lm-e-exterior" align="center" style="padding:40px 16px 48px;">
                    <!--[if mso]><table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center"><tr><td><![endif]-->
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;border-collapse:collapse;">
                        <tr>
                            <td class="lm-e-tarjeta" bgcolor="<?= esc_attr($lumenti_c['tarjeta']) ?>" style="background-color:<?= esc_attr($lumenti_c['tarjeta']) ?>;border-radius:6px;padding:44px 48px 48px;">
                                <a href="<?= esc_url(home_url('/')) ?>" target="_blank" style="display:inline-block;text-decoration:none;">
                                    <img src="<?= esc_url(lumenti_email_logo_url()) ?>" width="150" height="24" alt="Lumenti" style="display:block;width:150px;height:auto;max-width:150px;border:0;font-family:Georgia,serif;font-size:20px;color:<?= esc_attr($lumenti_c['titulo']) ?>;">
                                </a>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;"><tr><td height="36" style="height:36px;font-size:0;line-height:0;">&nbsp;</td></tr></table>
                                <?= $args['cuerpo'] ?? '' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML de las plantillas de correo, escapado en cada una. ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="lm-e-pie" style="padding:28px 8px 0;">
                                <?php if ($lumenti_pie === 'equipo') : ?>
                                    <p style="<?= esc_attr($lumenti_pie_estilo) ?>"><?= esc_html(lumenti_email_pie_equipo()) ?></p>
                                    <?php if ($lumenti_pie_nota !== '') : ?>
                                        <p style="<?= esc_attr($lumenti_pie_estilo) ?>"><?= esc_html($lumenti_pie_nota) ?></p>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <p style="<?= esc_attr($lumenti_pie_estilo) ?>color:<?= esc_attr($lumenti_c['texto']) ?>;font-weight:600;">Lumenti · <?= esc_html__('Salud mental', 'lumenti') ?></p>
                                    <?php if ($lumenti_contacto['direccion'] !== '') : ?>
                                        <p style="<?= esc_attr($lumenti_pie_estilo) ?>"><?= esc_html($lumenti_contacto['direccion']) ?> · <?= esc_html__('También atendemos en línea', 'lumenti') ?></p>
                                    <?php endif; ?>
                                    <p style="<?= esc_attr($lumenti_pie_estilo) ?>">
                                        <?php if ($lumenti_contacto['correo'] !== '') : ?><a href="mailto:<?= esc_attr($lumenti_contacto['correo']) ?>" style="<?= esc_attr($lumenti_pie_enlace) ?>"><?= esc_html($lumenti_contacto['correo']) ?></a><?php endif; ?>
                                        <?php if ($lumenti_wa !== '' && $lumenti_contacto['citas'] !== '') : ?> · <a href="<?= esc_url($lumenti_wa) ?>" target="_blank" style="<?= esc_attr($lumenti_pie_enlace) ?>">WhatsApp <?= esc_html($lumenti_contacto['citas']) ?></a><?php endif; ?>
                                    </p>
                                    <p style="<?= esc_attr($lumenti_pie_estilo) ?>">
                                        <a href="<?= esc_url(home_url('/')) ?>" target="_blank" style="<?= esc_attr($lumenti_pie_enlace) ?>"><?= esc_html(lumenti_email_dominio()) ?></a>
                                        <?php if ($lumenti_privacidad !== '') : ?> · <a href="<?= esc_url($lumenti_privacidad) ?>" target="_blank" style="<?= esc_attr($lumenti_pie_enlace) ?>"><?= esc_html__('Política de privacidad', 'lumenti') ?></a><?php endif; ?>
                                    </p>
                                    <?php if ($lumenti_pie_nota !== '') : ?>
                                        <p style="<?= esc_attr($lumenti_pie_estilo) ?>margin-top:14px;"><?= esc_html($lumenti_pie_nota) ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <!--[if mso]></td></tr></table><![endif]-->
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
