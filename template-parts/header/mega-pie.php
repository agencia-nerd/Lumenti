<?php
/**
 * Franja inferior de los mega menús: "¿No sabes cuál elegir? Contáctanos" (WhatsApp).
 * Sin número de WhatsApp en Ajustes del sitio no se muestra.
 *
 * $args: whatsapp (URL o '').
 */

if (($args['whatsapp'] ?? '') === '') {
    return;
}
?>
<p class="flex items-center gap-2.5 bg-fondo-alt px-gutter-nav py-5 text-sm text-cuerpo-2">
    <?php esc_html_e('¿No sabes cuál elegir?', 'lumenti'); ?>
    <a href="<?php echo esc_url($args['whatsapp']); ?>" class="group inline-flex items-center gap-1.5 font-semibold text-primario hover:text-primario-800" target="_blank" rel="noopener noreferrer">
        <?php esc_html_e('Contáctanos', 'lumenti'); ?>
        <?php echo lumenti_icon('flecha', 'size-4 transition-transform duration-300 ease-suave group-hover:translate-x-1'); ?>
        <span class="sr-only">(<?php esc_html_e('se abre en una pestaña nueva', 'lumenti'); ?>)</span>
    </a>
</p>
