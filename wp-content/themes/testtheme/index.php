<?php get_header(); ?>
<main>
    <section class="mt-5 container">
        <h1 class="h3"><i>КОМПАНИИ</i></h1>
    </section>

    <div class="album py-3">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3  row-cols-lg-4  row-cols-xl-5 g-3">
                <?php $query = new WP_Query([
                    'post_type' => 'companies',
                    'posts_per_page' => 1
                ]) ?>

                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : ?>
                        <?php $query->the_post(); ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="h-100 d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title d-flex align-items-center">
                                                <div class="pe-2"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
                                                <span><?php the_title(); ?></span>
                                            </h5>

                                            <p class="card-text"><?= wp_trim_words(get_the_content(), 30, ' ...'); ?></p>
                                        </div>

                                        <div class="text-end">
                                            <a href="<?php the_permalink(); ?>" class="text-dark"><i>Подробнее</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div>Компаний не найдено.</div>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>

                <?= paginate_links( [
                    'base'    => user_trailingslashit( wp_normalize_path( get_permalink() .'/%#%/' ) ),
                    'current' => max( 1, get_query_var( 'page' ) ),
                    'total'   => $query->max_num_pages,
                ] ); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
