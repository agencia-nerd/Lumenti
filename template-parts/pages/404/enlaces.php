<?php
defined('ABSPATH') || exit;

/*
 * 404 · enlaces. Título, buscador de especialistas (va al listado con ?q=, el mismo buscador por nombre o
 * condición) y accesos a las secciones principales (lumenti_404_enlaces(), inc/pagina-404.php).
 */

$lumenti_enlaces = lumenti_404_enlaces();
$lumenti_listado = (string) get_post_type_archive_link('especialista');
?>
<section class="lm-404" aria-labelledby="lm-404-title">
    <div class="lm-404__inner">
        <div class="lm-404__head">
            <?php get_template_part('template-parts/components/section-title', null, [
                'titulo' => __('¿POR DÓNDE *QUIERES SEGUIR?*', 'lumenti'),
                'id' => 'lm-404-title',
                'texto' => __('Estas son las secciones que más consultan quienes llegan a Lumenti.', 'lumenti'),
                'texto_clase' => 'lm-404__intro',
            ]); ?>
            <?php if ($lumenti_listado !== '') : ?>
                <form class="lm-404__search" role="search" method="get" action="<?= esc_url($lumenti_listado) ?>">
                    <label class="lm-field lm-404__field">
                        <span class="lm-field__label"><?= esc_html__('Busca un especialista', 'lumenti') ?></span>
                        <span class="lm-field__control">
                            <svg class="lm-field__icon lm-field__icon--start" aria-hidden="true" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg>
                            <input class="lm-field__input lm-field__input--search" type="search" name="q" placeholder="<?= esc_attr__('Por nombre o condición…', 'lumenti') ?>" autocomplete="off">
                        </span>
                    </label>
                    <button class="lm-btn lm-btn--primary lm-404__submit" type="submit"><?= esc_html__('Buscar', 'lumenti') ?></button>
                </form>
            <?php endif; ?>
        </div>
        <?php if ($lumenti_enlaces) : ?>
            <ul class="lm-404__links">
                <?php foreach ($lumenti_enlaces as $lumenti_enlace) : ?>
                    <li>
                        <a class="lm-404__link" href="<?= esc_url($lumenti_enlace['url']) ?>">
                            <span class="lm-404__link-title"><?= esc_html($lumenti_enlace['titulo']) ?></span>
                            <span class="lm-404__link-text"><?= esc_html($lumenti_enlace['texto']) ?></span>
                            <svg class="lm-404__link-icon" aria-hidden="true" width="20" height="20" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"/></svg>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
