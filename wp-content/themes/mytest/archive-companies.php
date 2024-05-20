<?php
/**
 * Template Name: Список компаний
 */

$paged = (get_query_var('page')) ? get_query_var('page') : 1;
$query = new WP_Query([
    'post_type' => 'companies',
    'posts_per_page' => 10,
	'paged' => $paged
]);
?>

<?php get_header(); ?>

<main id="primary" class="container site-main">
    <header>
        <h1 class="my-5"><i><?php single_post_title() ?></i></h1>
    </header>

    <?php if ($query->have_posts()) : ?>
        <div class="album py-3">
            <div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3  row-cols-lg-4  row-cols-xl-5 g-3">
                    <?php while ($query->have_posts()) : ?>
                        <?php $query->the_post(); ?>
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div>Ничего не найдено.</div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

    <?php $array_page = paginate_links([
        'current' => max(1, get_query_var('page')),
        'total' => $query->max_num_pages,
        'type' => 'array',
        'prev_text'    => __('« '),
        'next_text'    => __(' »'),
        'mid_size' => 1
    ]); ?>

    <?php if ($array_page && sizeof($array_page)) : ?>
    <nav class="mt-5">
        <ul class="pagination justify-content-center">
        <?php foreach ($array_page as $item) : ?>
            <li class="page-item">
                <?= str_replace(['page-numbers', 'current'], ['page-link', 'active'], $item) ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>
</main><!-- #main -->

<?php get_footer(); ?>
