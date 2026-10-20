<?php
/**
 * Botón flotante de WhatsApp (solo <1200). Se oculta mientras la persona escribe en un campo
 * (header.js) o en una plantilla que lo desactive:
 *   add_filter('lumenti_mostrar_fab', '__return_false');
 */

$lumenti_whatsapp = lumenti_whatsapp_url();
if ($lumenti_whatsapp === '' || !apply_filters('lumenti_mostrar_fab', true)) {
    return;
}
?>
<div class="fixed right-[calc(20px+env(safe-area-inset-right,0px))] bottom-[calc(20px+env(safe-area-inset-bottom,0px))] z-40 animate-fab rounded-full shadow-[0_10px_28px_rgb(28_44_58/0.22)] transition-[opacity,translate] duration-300 ease-suave data-oculto:pointer-events-none data-oculto:translate-y-4 data-oculto:opacity-0 xl:hidden" data-fab>
    <a href="<?php echo esc_url($lumenti_whatsapp); ?>" class="btn btn-primario w-[70px] transition-transform duration-150 active:scale-94 [--btn-h:70px] [--btn-px:0] [--btn-radius:50%]" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Escríbenos por WhatsApp (se abre en una pestaña nueva)', 'lumenti'); ?>">
        <?php echo lumenti_icon('whatsapp', 'size-8'); ?>
    </a>
</div>
