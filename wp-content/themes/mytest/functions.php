<?php
/**
 * mytest functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mytest
 */

load_template(dirname( __FILE__ ) .  '/inc/MyWalkerComments.php');

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mytest_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on mytest, use a find and replace
		* to change 'mytest' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'mytest', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'top' => esc_html__( 'Меню в шапке', 'mytest' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'mytest_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'mytest_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mytest_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mytest_content_width', 640 );
}
add_action( 'after_setup_theme', 'mytest_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mytest_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mytest' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mytest' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mytest_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mytest_scripts() {
	wp_enqueue_style( 'mytest-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mytest-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mytest-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

//	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//		wp_enqueue_script( 'comment-reply' );
//	}
}
add_action( 'wp_enqueue_scripts', 'mytest_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Подключаем стили и скрипты
 */
add_action('wp_enqueue_scripts', 'scripts_plug');
function scripts_plug() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('style_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('script_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
    wp_localize_script('script', 'targetAjax', ['url' => admin_url('admin-ajax.php')]);
}

/**
 * Регистрация нового типа записей (Companies)
 */
add_action( 'init', 'register_post_types' );
function register_post_types() {

    register_post_type( 'companies', [
        'label'  => null,
        'labels' => [
            'name'               => 'Компании', // основное название для типа записи
            'singular_name'      => 'Компания', // название для одной записи этого типа
            'add_new'            => 'Добавить компанию', // для добавления новой записи
            'add_new_item'       => 'Добавление компании', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование компании', // для редактирования типа записи
            'new_item'           => 'Новая компания', // текст новой записи
            'view_item'          => 'Смотреть компанию', // для просмотра записи этого типа.
            'search_items'       => 'Искать компанию', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Компании', // название меню
        ],
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => true, // зависит от public
        'exclude_from_search'   => true, // зависит от public
        'show_ui'               => true, // зависит от public
        'show_in_nav_menus'     => true, // зависит от public
        'show_in_menu'          => true, // показывать ли в меню админки
        'show_in_admin_bar'     => true, // зависит от show_in_menu
        'show_in_rest'          => null, // добавить в REST API. C WP 4.7
        'rest_base'             => null, // $post_type. C WP 4.7
        'menu_position'         => 3,
        'menu_icon'             => 'dashicons-businessman',
        //'capability_type'     => 'post',
        //'capabilities'        => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'        => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
//        'hierarchical'          => true,
        'supports'              => ['title', 'editor', 'author', 'thumbnail', 'comments', 'page-attributes'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'has_archive'           => true,
        'rewrite'               => true,
        'query_var'             => true,
    ] );
}

/**
 * Настройка уведомелний к новому типу записей (Companies)
 * на странице редактирования
 */
add_filter( 'post_updated_messages', 'true_post_type_messages' );
function true_post_type_messages( $messages ) {

    global $post, $post_ID;

    $messages[ 'companies' ] = [
        0 => '',
        1 => 'Данные компании обновлёны.',
        2 => 'Поле изменено.',
        3 => 'Поле удалено.',
        4 => 'Данные компании обновлёны.',
        5 => isset( $_GET[ 'revision' ] ) ? sprintf( 'Компания восстановлена из редакции: %s', wp_post_revision_title( (int) $_GET[ 'revision' ], false ) ) : false,
        6 => 'Компания опубликована.',
        7 => 'Данные компании сохранёны.',
        8 => 'Отправлено на проверку.',
        9 => sprintf( 'Компания запланирован на публикацию на <strong>%1$s</strong>.', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
        10 => 'Черновик компании сохранён',
    ];

    return $messages;
}

/**
 * Информация на вкладке "Помощь" для Companies
 */
add_action( 'admin_head', 'true_post_type_help_tab', 25 );
function true_post_type_help_tab() {

    $screen = get_current_screen();
    if ( 'companies' !== $screen->post_type ) {
        return;
    }

    $screen->add_help_tab([
        'id'      => 'tab_1',
        'title'   => 'Общая информация',
        'content' => '<h3>Общая информация</h3><p>Текст вкладки</p>'
    ]);

    $screen->add_help_tab([
        'id'      => 'tab_2',
        'title'   => 'Дополнительная инфа',
        'content' => '<h3>Дополнительная инфа</h3><p>Текст вкладки</p>'
    ]);
}


/**
 * Подключаем дополнительные поля в Companies
 */
add_action( 'add_meta_boxes_companies', 'extra_fields_meta_box_companies', 1 );
function extra_fields_meta_box_companies() {
    add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'companies', 'normal', 'high' );
}

/**
 * Массив дополнительный полей для Companies
 * @return array
 */
function array_extra_fields_company()
{
    return [
        'company_name' => 'Название компании',
        'company_inn' => 'ИНН',
        'company_about' => 'Общая информация',
        'company_director' => 'Генеральный директор',
        'company_address' => 'Адрес',
        'company_phone' => 'Телефон',
    ];
}

/**
 * HTML дополнительных полей для Companies
 * @param $post
 */
function extra_fields_box_func($post) {
    ?>
    <div class="inside">
        <label for="extra[company_name]"><?= array_extra_fields_company()['company_name']?></label>
        <input type="text" name="extra[company_name]" value="<?= get_post_meta($post->ID, 'company_name', 1) ?>" style="width: 100%"/>
    </div>

    <div class="inside">
        <label for="extra[company_inn]"><?= array_extra_fields_company()['company_inn']?></label>
        <input type="number" name="extra[company_inn]" value="<?= get_post_meta($post->ID, 'company_inn', 1) ?>" style="width: 100%"/>
    </div>

    <div class="inside">
        <label for="company_about"><?= array_extra_fields_company()['company_about']?></label>
        <textarea type="text" name="extra[company_about]" style="width: 100%; min-height: 100px"><?= get_post_meta($post->ID, 'company_about', 1) ?></textarea>
    </div>

    <div class="inside">
        <label for="extra[company_director]"><?= array_extra_fields_company()['company_director']?></label>
        <input type="text" name="extra[company_director]" value="<?= get_post_meta($post->ID, 'company_director', 1) ?>" style="width: 100%"/>
    </div>

    <div class="inside">
        <label for="extra[company_address]"><?= array_extra_fields_company()['company_address']?></label>
        <input type="text" name="extra[company_address]" value="<?= get_post_meta($post->ID, 'company_address', 1) ?>" style="width: 100%"/>
    </div>

    <div class="inside">
        <label for="extra[company_phone]"><?= array_extra_fields_company()['company_phone']?></label>
        <input type="text" name="extra[company_phone]" value="<?= get_post_meta( $post->ID, 'company_phone', 1) ?>" style="width: 100%"/>
    </div>

    <input type="hidden" name="extra_fields_nonce" value="<?= wp_create_nonce('extra_fields_nonce_id') ?>"/>
    <?php
}

/**
 * Сохранение данных из дополнительных полей для Companies
 */
add_action('save_post', 'extra_fields_companies_save_on_update', 0);
function extra_fields_companies_save_on_update($post_id) {
    if (
        empty($_POST['extra'])
        || ! wp_verify_nonce($_POST['extra_fields_nonce'], 'extra_fields_nonce_id')
        || wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)
    ) return false;

    $extra = $_POST['extra'];

    $extra = array_map('sanitize_text_field', $extra);
    foreach($extra as $key => $value) {
        if(!trim($value)) delete_post_meta($post_id, $key);
        else update_post_meta($post_id, $key, $value);
    }

    return $post_id;
}

/**
 * HTML дополнительного поля-идентификатора для Comments Companies
 */
add_action('comment_form_logged_in_after', 'extend_comment_custom_fields');
//add_action('comment_form_after_fields', 'extend_comment_custom_fields');
function extend_comment_custom_fields() {
    echo '<input id="_field_company" name="_field_company" value="" type="hidden" />';
}

/**
 * Сохраняет данные поля-идентификатора формы Comment для Companies
 */
add_action('comment_post', function ($comment_id) {
    if (!empty($_POST['_field_company'])) {
        $meta_val = sanitize_text_field($_POST['_field_company']);
        add_comment_meta($comment_id, '_field_company', $meta_val);
    }
});

/**
 * Принимает и сохраняет данные из формы Comments
 * Возвращает сохраненную запись
 */
add_action('wp_ajax_comment_ajax', 'action_save_comment');
function action_save_comment() {

    $comment = wp_handle_comment_submission(wp_unslash($_POST));
    if (is_wp_error($comment)) {
        $data = (int) $comment->get_error_data();
        if (!empty($data)) {
            wp_die(
                '<p>' . $comment->get_error_message() . '</p>',
                __('Comment Submission Failure'),
                ['response'  => $data, 'back_link' => true,]
            );
        } else exit;
    }

    $user = wp_get_current_user();
    $cookies_consent = (isset($_POST['wp-comment-cookies-consent']));

    do_action('set_comment_cookies', $comment, $user, $cookies_consent);

    wp_list_comments([
        'walker' => new MyWalkerComments(),
        'format' => 'html5',
        'short_ping' => true
    ], [$comment]);

    wp_die();
}

/**
 * Обновляет счетчик комментариев
 */
add_action('wp_ajax_action_update_counter_comment', 'action_update_counter_comment');
function action_update_counter_comment() {

    $post_id = intval($_POST['post_id']);
    $value_field = $_POST['value_field'];

    if (isset($post_id) && !empty($post_id) && isset($value_field) && !empty($value_field))
    {
        echo get_comments([
            'post_id' => $post_id,
            'meta_key' => '_field_company',
            'meta_value' => $value_field,
            'count' => true
        ]);
    }

    wp_die();
}

/**
 * Возвращает форму Comments для ответа на комментарий
 */
add_action('wp_ajax_action_get_form_comment', 'action_get_form_comment');
function action_get_form_comment() {

    $parent_comment_id = intval($_POST['parent_comment_id']);

    if (isset($parent_comment_id) && !empty($parent_comment_id))
    {
        if ($comment = get_comment($parent_comment_id))
        {
            echo "<p>Ответ для {$comment->comment_author}</p>";
            render_form_comment_company(
                get_comment_meta($comment->comment_ID, '_field_company', true),
                $comment->comment_post_ID,
                $comment->comment_ID
            );
        }
    }

    wp_die();
}

/**
 * Регистрация виджета для шапки
 */
add_action( 'widgets_init', 'register_nav_widgets' );
function register_nav_widgets() {
    register_sidebar([
        'name' => 'Виждет с шапке',
        'id' => 'nav-sidebar',
        'description' => 'Выводиться в шапке для иконок.',
        'before_widget' => '<li class="homepage-widget-block">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ]);
}

/**
 * Добавляем классы к элементам списка главной навигации
 */
add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );
function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
    if($args->theme_location == 'top'){
        $classes[] = 'nav-item';
    }

    return $classes;
}

/**
 * Добавляем классы к ссылкам главной навигации
 */
add_filter('nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4);
function filter_nav_menu_link_attributes( $attr, $item, $args, $depth ) {

    $default_class = 'nav-link';
    $class_active = 'active';

    $attr['class'] = isset($attr['class']) ? "{$attr['class']} $default_class" : "$default_class";
    if ($item->current) $attr['class'] = $attr['class'] ." ". $class_active;

    return $attr;
}

/**
 * Рендер формы комментирования для Companies
 * @param $field_company
 * @param $post_id
 * @param int $comment_parent_id
 */
function render_form_comment_company($field_company, $post_id, $comment_parent_id = 0) {
    $params = [
        '_field_company' => $field_company,
        'post_id' => $post_id,
        'comment_parent_id' => $comment_parent_id
    ];

    load_template(dirname( __FILE__ ) .  '/template-parts/form-comments-company.php', false, $params);
}
?>