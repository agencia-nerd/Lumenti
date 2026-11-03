<?php
defined('ABSPATH') || exit;

/*
 * Cuerpo de los correos: pinta en HTML los bloques que define cada correo en inc/correos.php
 * (lumenti_email_empresas_equipo(), …). La versión en texto plano sale de los mismos bloques
 * (lumenti_email_texto()), así que las dos dicen lo mismo. Tipos de bloque: ver inc/correos.php.
 *
 * $args: bloques (array).
 */

$lumenti_c = LUMENTI_EMAIL_COLORS;
$lumenti_sans = LUMENTI_EMAIL_SANS;
$lumenti_serif = LUMENTI_EMAIL_SERIF;
$lumenti_bloques = array_values((array) ($args['bloques'] ?? []));

$lumenti_p = 'margin:0 0 16px;font-family:' . $lumenti_sans . ';font-size:16px;line-height:26px;color:' . $lumenti_c['texto'] . ';';
$lumenti_chico = 'margin:0;font-family:' . $lumenti_sans . ';font-size:14px;line-height:20px;color:' . $lumenti_c['suave'] . ';';
$lumenti_h2 = 'margin:0;font-family:' . $lumenti_serif . ';font-size:20px;line-height:26px;font-weight:normal;color:' . $lumenti_c['titulo'] . ';';

foreach ($lumenti_bloques as $lumenti_i => $lumenti_b) :
    $lumenti_tipo = (string) ($lumenti_b['tipo'] ?? '');
    $lumenti_siguiente = (string) ($lumenti_bloques[$lumenti_i + 1]['tipo'] ?? '');
    // Antes de un título de sección, de un recuadro o de la firma el aire es mayor que entre párrafos.
    $lumenti_aire = in_array($lumenti_siguiente, ['subtitulo', 'recuadro', 'firma'], true) ? 32 : 16;

    switch ($lumenti_tipo) :
        case 'titulo': ?>
            <h1 class="lm-e-h1" style="margin:0 0 <?= $lumenti_siguiente === 'meta' ? 8 : 20 ?>px;font-family:<?= esc_attr($lumenti_serif) ?>;font-size:28px;line-height:35px;font-weight:normal;letter-spacing:0.01em;color:<?= esc_attr($lumenti_c['titulo']) ?>;"><?= esc_html((string) $lumenti_b['texto']) ?></h1>
            <?php break;

        case 'meta': ?>
            <p style="<?= esc_attr($lumenti_chico) ?>"><?= esc_html((string) $lumenti_b['texto']) ?><?php if (!empty($lumenti_b['enlace']['texto'])) : ?> · <?= lumenti_email_enlace((string) $lumenti_b['enlace']['url'], (string) $lumenti_b['enlace']['texto']) // phpcs:ignore -- escapado en el helper ?><?php endif; ?></p>
            <?= lumenti_email_espacio(28) // phpcs:ignore -- HTML fijo ?>
            <?php break;

        case 'parrafo': ?>
            <p style="<?= esc_attr($lumenti_p) ?>margin-bottom:<?= $lumenti_aire ?>px;"><?= esc_html((string) $lumenti_b['texto']) ?></p>
            <?php break;

        case 'recuadro':
            $lumenti_botones = lumenti_email_botones((array) ($lumenti_b['botones'] ?? [])); ?>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="<?= esc_attr($lumenti_c['fondo']) ?>" style="border-collapse:separate;background-color:<?= esc_attr($lumenti_c['fondo']) ?>;border-radius:6px;">
                <tr>
                    <td style="padding:24px;">
                        <p style="margin:0 0 4px;font-family:<?= esc_attr($lumenti_sans) ?>;font-size:18px;line-height:26px;font-weight:600;color:<?= esc_attr($lumenti_c['titulo']) ?>;word-break:break-word;"><?= esc_html((string) $lumenti_b['titulo']) ?></p>
                        <?php if (!empty($lumenti_b['texto'])) : ?>
                            <p style="margin:0;font-family:<?= esc_attr($lumenti_sans) ?>;font-size:15px;line-height:22px;color:<?= esc_attr($lumenti_c['texto']) ?>;"><?= esc_html((string) $lumenti_b['texto']) ?></p>
                        <?php endif; ?>
                        <?php if ($lumenti_botones !== '') : ?>
                            <?= lumenti_email_espacio(20) // phpcs:ignore -- HTML fijo ?>
                            <?= $lumenti_botones // phpcs:ignore -- escapado en el helper ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <?= lumenti_email_espacio(36) // phpcs:ignore -- HTML fijo ?>
            <?php break;

        case 'subtitulo': ?>
            <h2 style="<?= esc_attr($lumenti_h2) ?>"><?= esc_html((string) $lumenti_b['texto']) ?></h2>
            <?php if (!empty($lumenti_b['nota'])) : ?>
                <p style="<?= esc_attr($lumenti_chico) ?>margin-top:4px;"><?= esc_html((string) $lumenti_b['nota']) ?></p>
            <?php endif; ?>
            <?= lumenti_email_espacio(12) // phpcs:ignore -- HTML fijo ?>
            <?php break;

        case 'filas':
            $lumenti_html = '';
            foreach ((array) $lumenti_b['filas'] as $lumenti_fila) {
                $lumenti_valor = lumenti_email_valor_html((array) $lumenti_fila);
                if (trim(wp_strip_all_tags($lumenti_valor)) === '') {
                    continue;
                }
                $lumenti_html .= '<tr>'
                    . '<td class="lm-e-fila-etiqueta" valign="top" width="38%" style="padding:14px 16px 14px 0;border-top:1px solid ' . esc_attr($lumenti_c['linea']) . ';font-family:' . esc_attr($lumenti_sans) . ';font-size:14px;line-height:20px;color:' . esc_attr($lumenti_c['suave']) . ';">' . esc_html((string) $lumenti_fila['etiqueta']) . '</td>'
                    . '<td class="lm-e-fila-valor" valign="top" style="padding:14px 0;border-top:1px solid ' . esc_attr($lumenti_c['linea']) . ';font-family:' . esc_attr($lumenti_sans) . ';font-size:16px;line-height:24px;color:' . esc_attr($lumenti_c['titulo']) . ';word-break:break-word;">' . $lumenti_valor . '</td>'
                    . '</tr>';
            }
            if ($lumenti_html !== '') : ?>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-bottom:1px solid <?= esc_attr($lumenti_c['linea']) ?>;"><?= $lumenti_html // phpcs:ignore -- escapado arriba ?></table>
                <?php if ($lumenti_siguiente !== '') {
                    echo lumenti_email_espacio(32); // phpcs:ignore -- HTML fijo
                } ?>
            <?php endif;
            break;

        case 'articulos': ?>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-bottom:1px solid <?= esc_attr($lumenti_c['linea']) ?>;">
                <?php foreach ((array) $lumenti_b['articulos'] as $lumenti_art) : $lumenti_meta = lumenti_email_articulo_meta((array) $lumenti_art); ?>
                    <tr>
                        <td style="padding:16px 0;border-top:1px solid <?= esc_attr($lumenti_c['linea']) ?>;">
                            <?php if ($lumenti_meta !== '') : ?>
                                <p style="margin:0 0 4px;font-family:<?= esc_attr($lumenti_sans) ?>;font-size:13px;line-height:18px;color:<?= esc_attr($lumenti_c['suave']) ?>;"><?= esc_html($lumenti_meta) ?></p>
                            <?php endif; ?>
                            <a href="<?= esc_url((string) ($lumenti_art['url'] ?? '')) ?>" target="_blank" style="font-family:<?= esc_attr($lumenti_serif) ?>;font-size:18px;line-height:25px;color:<?= esc_attr($lumenti_c['titulo']) ?>;text-decoration:none;"><?= esc_html((string) ($lumenti_art['titulo'] ?? '')) ?>&nbsp;<span style="color:<?= esc_attr($lumenti_c['marca']) ?>;">&rarr;</span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?= lumenti_email_espacio(28) // phpcs:ignore -- HTML fijo ?>
            <?php break;

        case 'botones':
            $lumenti_botones = lumenti_email_botones((array) $lumenti_b['botones']);
            if ($lumenti_botones !== '') : ?>
                <?= $lumenti_botones // phpcs:ignore -- escapado en el helper ?>
                <?php if (!empty($lumenti_b['nota'])) : ?>
                    <p style="<?= esc_attr($lumenti_chico) ?>margin-top:8px;"><?= esc_html((string) $lumenti_b['nota']) ?></p>
                <?php endif; ?>
                <?= lumenti_email_espacio(36) // phpcs:ignore -- HTML fijo ?>
            <?php endif;
            break;

        case 'firma': ?>
            <p style="<?= esc_attr($lumenti_p) ?>margin:0;"><?= esc_html((string) $lumenti_b['saludo']) ?><br><span style="color:<?= esc_attr($lumenti_c['titulo']) ?>;font-weight:600;"><?= esc_html((string) $lumenti_b['firma']) ?></span></p>
            <?php break;
    endswitch;
endforeach;
