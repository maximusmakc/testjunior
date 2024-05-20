<div class="container-form-comments comments-area">
    <form action="http://adaurum.loc/wp-comments-post.php" method="post" id="<?= uniqid() ?>" class="comment-form" novalidate="">

        <p class="comment-form-comment">
            <textarea class="field-comment" name="comment" style="min-height: 100px;" placeholder="Введите комментарий" aria-required="true"></textarea>
        </p>

        <input type="hidden" class="_field_company" name="_field_company" value="<?= $args['_field_company'] ?>">

        <input type="hidden" class="comment_post_ID" name="comment_post_ID" value="<?= $args['post_id']; ?>">

        <input type="hidden" class="comment_parent" name="comment_parent" value="<?= $args['comment_parent_id']; ?>">

        <input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="<?= wp_create_nonce('comment_ajax') ?>">

        <p class="form-submit">
            <button name="submit" type="submit" class="btn btn-primary">Отправить</button>
        </p>
    </form>
</div>
