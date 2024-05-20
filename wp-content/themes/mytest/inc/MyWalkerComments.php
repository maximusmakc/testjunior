<?php

/**
 * Мой класс для вывода списка комментариев
 * Class MyWalkerComments
 */
class MyWalkerComments extends Walker_Comment
{
    /**
     * For HTML5
     * @param WP_Comment $comment
     * @param int $depth
     * @param array $args
     */
    protected function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

        $commenter          = wp_get_current_commenter();
        $show_pending_links = ! empty( $commenter['comment_author'] );

        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
        }
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body mb-5">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <div class="d-flex align-items-center">
                        <?php
                        if ( 0 != $args['avatar_size'] ) {
                            echo get_avatar( $comment, $args['avatar_size'] );
                        }
                        ?>
                        <?php
                        $comment_author = get_comment_author_link( $comment );

                        if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
                            $comment_author = get_comment_author( $comment );
                        }

                        printf(
                        /* translators: %s: Comment author link. */
                            sprintf( '<span class="fn text-dark mx-3">%s</span>', $comment_author )
                        );
                        ?>
                    </div>
                </div><!-- .comment-author -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                <?php endif; ?>
            </footer><!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <div class="comment-metadata">
                <div class="d-flex align-items-center">
                    <div class="me-3"><?= get_comment_time('d.m.Y в H:i') ?></div>

                    <?php if (is_user_logged_in()) : ?>
                    <div>
                        <?php if ( '1' == $comment->comment_approved || $show_pending_links ) {
                            echo '<button type="button" class="btn-reply btn btn-info" data-parent="'.$comment->comment_ID.'">Ответить</button>';
                        } ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div><!-- .comment-metadata -->
        </article><!-- .comment-body -->
        <?php
    }

}
