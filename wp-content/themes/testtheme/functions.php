<?php
/**
 * Подключаем стили и скрипты
 */
//add_action('wp_enqueue_scripts', 'scripts_plug');
//function scripts_plug() {
//    wp_enqueue_style('style', get_stylesheet_uri());
//    wp_enqueue_style('style_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
//    wp_enqueue_script( 'jquery' );
//}

/**
 * Подключаем навигацию
 */
//add_action( 'after_setup_theme', function () {
//    register_nav_menus(['top' => 'Меню в header']);
//});

/**
 * Поключаем thumbnail к постам типа Компании
 */
//add_theme_support( 'post-thumbnails' );

// хук для регистрации
//add_action( 'init', 'create_taxonomy' );
//function create_taxonomy() {
//    register_taxonomy( 'taxonomy_companies', [ 'companies' ], [
//        'label'                 => '', // определяется параметром $labels->name
//        'labels'                => [
//            'name'              => 'Группы',
//            'singular_name'     => 'Группа',
//            'search_items'      => 'Search Genres',
//            'all_items'         => 'All Genres',
//            'view_item '        => 'View Genre',
//            'parent_item'       => 'Parent Genre',
//            'parent_item_colon' => 'Parent Genre:',
//            'edit_item'         => 'Edit Genre',
//            'update_item'       => 'Update Genre',
//            'add_new_item'      => 'Add New Genre',
//            'new_item_name'     => 'New Genre Name',
//            'menu_name'         => 'Группы',
//            'back_to_items'     => '← Back to Genre',
//        ],
//        'description'           => '', // описание таксономии
//        'public'                => true,
//        // 'publicly_queryable'    => null, // равен аргументу public
//        // 'show_in_nav_menus'     => true, // равен аргументу public
//        // 'show_ui'               => true, // равен аргументу public
//        // 'show_in_menu'          => true, // равен аргументу show_ui
//        // 'show_tagcloud'         => true, // равен аргументу show_ui
//        // 'show_in_quick_edit'    => null, // равен аргументу show_ui
//        'hierarchical'          => false,
//
//        'rewrite'               => true,
//        //'query_var'             => $taxonomy, // название параметра запроса
//        'capabilities'          => array(),
//        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
//        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
//        'show_in_rest'          => null, // добавить в REST API
//        'rest_base'             => null, // $taxonomy
//        // '_builtin'              => false,
//        //'update_count_callback' => '_update_post_term_count',
//    ] );
//}
//
///**
// * Регистрация нового типа записей (Компании)
// */
//add_action( 'init', 'register_post_types' );
//function register_post_types() {
//
//    register_post_type( 'companies', [
//        'label'  => null,
//        'labels' => [
//            'name'               => 'Компании', // основное название для типа записи
//            'singular_name'      => 'Компания', // название для одной записи этого типа
//            'add_new'            => 'Добавить компанию', // для добавления новой записи
//            'add_new_item'       => 'Добавление компании', // заголовка у вновь создаваемой записи в админ-панели.
//            'edit_item'          => 'Редактирование компании', // для редактирования типа записи
//            'new_item'           => 'Новая компания', // текст новой записи
//            'view_item'          => 'Смотреть компанию', // для просмотра записи этого типа.
//            'search_items'       => 'Искать компанию', // для поиска по этим типам записи
//            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
//            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
//            'parent_item_colon'  => '', // для родителей (у древовидных типов)
//            'menu_name'          => 'Компании', // название меню
//        ],
//        'description'           => '',
//        'public'                => true,
//        'publicly_queryable'    => true, // зависит от public
//        'exclude_from_search'   => true, // зависит от public
//        'show_ui'               => true, // зависит от public
//        'show_in_nav_menus'     => true, // зависит от public
//        'show_in_menu'          => true, // показывать ли в меню админки
//        'show_in_admin_bar'     => true, // зависит от show_in_menu
//        'show_in_rest'          => null, // добавить в REST API. C WP 4.7
//        'rest_base'             => null, // $post_type. C WP 4.7
//        'menu_position'         => 3,
//        'menu_icon'             => 'dashicons-businessman',
//        //'capability_type'     => 'post',
//        //'capabilities'        => 'post', // массив дополнительных прав для этого типа записи
//        //'map_meta_cap'        => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
//        'hierarchical'          => true,
//        'supports'              => ['title', 'editor', 'author', 'thumbnail', 'comments', 'page-attributes'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
//        'taxonomies'            => [],
//        'has_archive'           => false,
//        'rewrite'               => true,
//        'query_var'             => true,
//    ] );
//}
//
///**
// * Корректировка уведомелний к новому типу записей (компании)
// * на странице редактирования
// */
//add_filter( 'post_updated_messages', 'true_post_type_messages' );
//function true_post_type_messages( $messages ) {
//
//    global $post, $post_ID;
//
//    $messages[ 'companies' ] = [
//        0 => '',
//        1 => 'Данные компании обновлёны.',
////        2 => 'Поле изменено.',
////        3 => 'Поле удалено.',
//        4 => 'Данные компании обновлёны.',
//        5 => isset( $_GET[ 'revision' ] ) ? sprintf( 'Компания восстановлена из редакции: %s', wp_post_revision_title( (int) $_GET[ 'revision' ], false ) ) : false,
//        6 => 'Компания опубликована.',
//        7 => 'Данные компании сохранёны.',
//        8 => 'Отправлено на проверку.',
//        9 => sprintf( 'Компания запланирован на публикацию на <strong>%1$s</strong>.', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
//        10 => 'Черновик компании сохранён',
//    ];
//
//    return $messages;
//}
//
///**
// * Кастомная информация на вкладке "Помощь" для пояснения чего-либо
// */
//add_action( 'admin_head', 'true_post_type_help_tab', 25 );
//function true_post_type_help_tab() {
//
//    $screen = get_current_screen();
//    if ( 'companies' !== $screen->post_type ) {
//        return;
//    }
//
//    // Добавляем первую вкладку
//    $screen->add_help_tab( array(
//        'id'      => 'tab_1',
//        'title'   => 'Общая информация',
//        'content' => '<h3>Общая информация</h3><p>Текст вкладки</p>'
//    ) );
//
//    // Добавляем вторую вкладку
//    $screen->add_help_tab( array(
//        'id'      => 'tab_2',
//        'title'   => 'Дополнительная инфа',
//        'content' => '<h3>Дополнительная инфа</h3><p>Текст вкладки</p>'
//    ) );
//}
//
///**
// *
// */
//// подключаем функцию активации мета блока (my_extra_fields)
//add_action( 'add_meta_boxes_companies', 'extra_fields_meta_box_companies', 1 );
//function extra_fields_meta_box_companies() {
//    add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'companies', 'normal', 'high' );
//}
//
//function extra_fields_box_func( $post ) {
//    ?>
<!--    <div class="inside">-->
<!--        <label for="extra[company_name]">Название компании</label>-->
<!--        <input type="text" name="extra[company_name]" value="--><?//= get_post_meta( $post->ID, 'company_name', 1 ) ?><!--" style="width: 100%"/>-->
<!--    </div>-->
<!---->
<!--    <div class="inside">-->
<!--        <label for="extra[company_inn]">ИНН</label>-->
<!--        <input type="number" name="extra[company_inn]" value="--><?//= get_post_meta( $post->ID, 'company_inn', 1 ) ?><!--" style="width: 100%"/>-->
<!--    </div>-->
<!---->
<!--    <div class="inside">-->
<!--        <label for="company_about">Общая информация</label>-->
<!--        <textarea type="text" name="extra[company_about]" style="width: 100%; min-height: 100px">-->
<!--            --><?//= get_post_meta( $post->ID, 'company_about', 1 ) ?>
<!--        </textarea>-->
<!--    </div>-->
<!---->
<!--    <div class="inside">-->
<!--        <label for="extra[company_director]">Генеральный директор</label>-->
<!--        <input type="text" name="extra[company_director]" value="--><?//= get_post_meta( $post->ID, 'company_director', 1 ) ?><!--" style="width: 100%"/>-->
<!--    </div>-->
<!---->
<!--    <div class="inside">-->
<!--        <label for="extra[company_address]">Адрес</label>-->
<!--        <input type="text" name="extra[company_address]" value="--><?//= get_post_meta( $post->ID, 'company_address', 1 ) ?><!--" style="width: 100%"/>-->
<!--    </div>-->
<!---->
<!--    <div class="inside">-->
<!--        <label for="extra[company_phone]">Телефон</label>-->
<!--        <input type="text" name="extra[company_phone]" value="--><?//= get_post_meta( $post->ID, 'company_phone', 1 ) ?><!--" style="width: 100%"/>-->
<!--    </div>-->
<!---->
<!--    <input type="hidden" name="extra_fields_nonce" value="--><?//= wp_create_nonce( 'extra_fields_nonce_id' ) ?><!--"/>-->
<!--    --><?php
//}
//
///**
// * Обновление экстра полей при сохранении записей типа Companies
// */
//add_action( 'save_post', 'extra_fields_companies_save_on_update', 0 );
//function extra_fields_companies_save_on_update( $post_id ) {
//    if (
//        empty( $_POST['extra'] )
//        || ! wp_verify_nonce( $_POST['extra_fields_nonce'], 'extra_fields_nonce_id' )
//        || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id )
//    ) return false;
//
//    $extra = $_POST['extra'];
//
//    $extra = array_map( 'sanitize_text_field', $extra );
//    foreach( $extra as $key => $value ) {
//        if(!trim($value)) delete_post_meta( $post_id, $key );
//        else update_post_meta( $post_id, $key, $value );
//    }
//
//    return $post_id;
//}
