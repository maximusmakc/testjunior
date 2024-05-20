jQuery(function($) {

    let modalDom = $('#mainModal');
    let modalTitle = modalDom.find('.modal-title');
    let modalBody = modalDom.find('.modal-body');
    let modalObj = new bootstrap.Modal(modalDom);

    $(document).ready(function() {

        send_comment();

        /**
         * Обработчик нажания на кнопку "Ответить" на комментарий
         * Выводит в модальное окно форму ответа на комментарий
         */
        $(document).on('click', '.btn-reply', function () {
            let data = {
                action: 'action_get_form_comment',
                parent_comment_id: $(this).data('parent')
            };

            jQuery.post(targetAjax.url, data, function(response) {
                modalTitle.text('Ответ на комментарий');
                modalBody.html(response);
                modalObj.show();
            });
        })

        /**
         * Поднимает форму обратной связи в модальное окно
         */
        $(document).on('click', '.btn-callback', function () {
            modalTitle.text('Запрос обратного звонка');
            modalBody.html('<p>Сюда вставляем форму с необходимыми полями.</p><div class="text-end"><button class="btn btn-success request-call">Запросить звонок</button></div>');
            modalObj.show();
        })

        /**
         * Ответ на запрос обратного звонка
         */
        $(document).on('click', '.request-call', function () {
            modalObj.hide();
            setTimeout(function () {
                modalObj.show();
                modalTitle.text('Ваша заявка принята');
                modalBody.html('<p>Спасибо за обратную связь. Ожидайте звонка администратора</p>');
            }, 500);
        });

        /**
         * Валидация формы комментария при взаимодействии с полями
         */
        $(document).on('blur keyup', '.comment-form input, .comment-form textarea', function () {
            validate_comment($(this).closest('.comment-form'));
        });
    });


    /**
     * Отправка формы комментария
     */
    function send_comment() {
        $(document).on('submit', '.comment-form', function(e) {
            e.preventDefault();

            if (validate_comment($(this)) === false) return false;

            let commentForm = $(this),
                action = '&action=comment_ajax',
                item_prop_company = commentForm.closest('.item-prop-company'),
                commentList = item_prop_company.find('.comment-list'),
                comment_parent_id = Number(commentForm.find("input[name=comment_parent]").val()),
                post_id = Number(commentForm.find("input[name=comment_post_ID]").val()),
                value_field = String(commentForm.find("input[name=_field_company]").val());

            if(commentForm.closest('#mainModal').length) modalObj.hide();

            $.ajax({
                type: 'POST',
                url: targetAjax.url,
                data: commentForm.serialize() + action,
                success: function(newComment) {

                    // обновляем счетчик комментариев
                    let data = {
                        action: 'action_update_counter_comment',
                        post_id: post_id,
                        value_field: value_field
                    };
                    jQuery.post(targetAjax.url, data, function(count) {
                        $('#'+value_field).find('.quantity-comments').text(count);
                    });

                    // обновляем список комментариев
                    if (comment_parent_id > 0) {
                        let el_reply = $(document).find('#comment-'+comment_parent_id);
                        if (el_reply.children('.children').length) el_reply.children('.children').append(newComment);
                        else el_reply.append('<ul class="children">' + newComment + '</ul>');
                    }
                    else commentList.append(newComment);


                    if (item_prop_company.find('.accordion-collapse').is(":hidden")) {
                        item_prop_company.find('.accordion-button').trigger( "click" );
                    }

                    // очищаем поле комментария
                    commentForm.find('.field-comment').val('');
                }
            } );

            return false;
        });
    }

    /**
     * Обработчик ajax ошибок
     */
    $(document).ajaxError(function(event, xhr, options) {
        switch (xhr.status){
            case 403:
                alert('Requested page forbidden (404).');
                break;
            case 404:
                alert('Requested page not found (404).');
                break;
            case 500:
                alert('Internal Server Error (500).');
                break;
        }
    });

    /**
     * Валидация формы комментария
     */
    function validate_comment(form) {

        let valid = true;

        form.find('.validation-error').remove();

        let commentField = form.find('.field-comment');
        if (commentField.length && commentField.val() == '') {
            form.find(".comment-form-comment").append('<p class="validation-error text-danger">Заполните комментарий</p>');
            valid = false;
        }

        return valid;
    }
});




