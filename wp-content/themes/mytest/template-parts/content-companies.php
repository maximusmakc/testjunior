<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mytest
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="col h-100">
        <div class="card h-100">
            <div class="card-body">
                <div class="h-100 d-flex flex-column justify-content-between">
                    <div class="mb-2">
                        <div class="card-title d-flex align-items-center">
                            <div class="pe-2"><?php the_post_thumbnail('thumbnail'); ?></div>
                            <h5 class="label-post-archive"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></h5>
                        </div>

                        <p class="card-text"><?= wp_trim_words(get_the_content(), 30, ' ...'); ?></p>
                    </div>

                    <div class="text-end">
                        <a href="<?php the_permalink(); ?>" class="text-dark"><i>Подробнее</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
