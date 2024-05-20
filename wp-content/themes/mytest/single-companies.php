<?php
load_template(dirname( __FILE__ ) .  '/inc/MyWalkerComments.php');
$array_extra = array_merge(array_extra_fields_company(), ['company_comment' => 'Комментарий для компании']);

?>

<?php get_header(); ?>

<main id="primary" class="container site-main single-companies">
    <div class="wrap-content">
        <h1 class="my-5"><?php the_title(); ?></h1>

        <?php foreach ($array_extra as $key => $name) : ?>

        <?php global $key ?>
        <div id="<?= $key ?>" class="item-prop-company my-5">
            <h2 class="mb-3"><?= $name ?></h2>

            <?php $meta_values = get_post_meta(get_the_ID(), $key); ?>
            <?php if (sizeof($meta_values)) : ?>
                <p>Значение: <?= implode(' ,', $meta_values) ?></p>
            <?php endif; ?>

            <?php $comments = get_comments([
                'post_id' => get_the_ID(),
                'meta_key' => '_field_company',
                'meta_value' => $key,
                'orderby' => ['comment_date_gmt' => 'ASC'],
            ]); ?>

            <div class="container-comments">
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#comment-<?= $key ?>">
                            <span class="label-section-comments me-2">Комментарии</span>
                            <span class="quantity-comments"><?= count($comments) ?></span>
                        </button>
                    </h2>
                    <div id="comment-<?= $key ?>" class="accordion-collapse collapse show">
                        <div class="accordion-body comments-body">
                            <ul class="comment-list p-0 m-0">
                                <?php if (sizeof($comments))
                                    wp_list_comments([
                                        'walker' => new MyWalkerComments(),
                                        'style' => 'ul',
                                        'format' => 'html5',
                                        'short_ping' => true,
                                    ], $comments);
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- .container-comments -->

            <?php if (is_user_logged_in()) : ?>
                <?php if (comments_open()) render_form_comment_company($key, get_the_ID()); ?>
            <?php else : ?>
            <p><a href="<?= get_bloginfo('url') ?>/wp-login.php">Войдите или зарегистрируйтесь</a>, чтоб иметь возможность оставлять комментарии.</p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div><!-- .wrap-content -->
</main><!-- #main -->

<?php get_footer(); ?>
