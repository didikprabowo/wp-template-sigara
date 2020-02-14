<?php

if (!function_exists('sigara_setup')) :
	function sigara_setup()
	{
		load_theme_textdomain('sigara', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
		));

		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 40,
				'width'       => 80,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);


		add_image_size('single-feature', 720, 450, true);
		add_theme_support('single-feature');

		register_nav_menus(array(
			'header_1' => 'Primary',
			'footer_1' => 'Footer',
			'social_1'   => 'Social'
		));
	}
endif;

add_action('after_setup_theme', 'sigara_setup');

function sigara_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'sigara'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'sigara'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'sigara_widgets_init');

function sigara_scripts()
{
	wp_enqueue_style('sigara-style', get_stylesheet_uri());
	wp_enqueue_script('sigara-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
	wp_enqueue_script('sigara-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'sigara_scripts');
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/function/post_comment_bootstrap.php';
require get_template_directory() . '/function/nav_list_bootstrap.php';
require get_template_directory() . '/rich.php';
require get_template_directory() . '/helpers/helper.php';
require get_template_directory() . '/helpers/custom.php';
require_once get_parent_theme_file_path('function/comment_list_bootstrap.php');

if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
// // getRich
function getRich()
{
	$r = new Rich();
	$r->getHome();
}
add_action('wp_head', 'getRich');
// // CDNStyle
function CDNStyle()
{
	wp_register_style('bt', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
	wp_register_style('font_awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css');
	wp_register_style('font_google', esc_url('https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap&subset=latin-ext'));
	wp_enqueue_style(['bt', 'font_google', 'font_awesome']);
}

// // Load the theme stylesheets
function LocalStyle()
{
	wp_enqueue_style('main', get_template_directory_uri() . '/css/style.css');
	wp_enqueue_style('custom', get_template_directory_uri() . '/css/lozad.css');
}

function CDNScript()
{
	wp_register_script("lozad", "https://cdn.jsdelivr.net/npm/lozad", null, null, false);
	wp_register_script('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', null, null, true);
	wp_register_script('observer', 'https://raw.githubusercontent.com/w3c/IntersectionObserver/master/polyfill/intersection-observer.js', null, null, true);
	wp_register_script('poper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', null, null, true);
	wp_enqueue_script(['bootstrap4', 'observer', 'poper', 'lozad']);
}

function localScript()
{
	if (is_single()) {
		wp_enqueue_script('myscript', get_template_directory_uri() . '/js/single.js', array(), false, true);
	} else if (is_single() || is_page() || is_author() || is_category() || is_tag() || is_search() || is_home() || is_date() || is_404()) {
		wp_enqueue_script('myscript_s', get_template_directory_uri() . '/js/scripts.js', array(), false, true);
	}
}

add_action('wp_enqueue_scripts', 'LocalStyle');
add_action('wp_enqueue_scripts', 'CDNStyle');
add_action('wp_enqueue_scripts', 'CDNScript');
add_action('wp_enqueue_scripts', 'localScript');

// //menu

function getLogo()
{
	$custom_logo_id = get_theme_mod('custom_logo');
	$image = wp_get_attachment_image_src($custom_logo_id, 'full');
	return $image[0];
}



function wp_infinitepaginate()
{
	$loopFile = $_POST['loop_file'];
	$paged = $_POST['page_no'];
	$action = $_POST['what'];
	$value = $_POST['value'];

	if ($action == 'author_name') {
		$arg = array('author_name' => $value, 'paged' => $paged, 'post_status' => 'publish');
	} elseif ($action == 'category_name') {
		$arg = array(
			'category_name' => $value,
			'paged' => $paged,
			'post_status' => 'publish'
		);
	} elseif ($action == 'tag') {
		$arg = array(
			'tag' => $value,
			'paged' => $paged,
			'post_status' => 'publish'
		);
	} elseif ($action == 'search') {
		$arg = array('s' => $value, 'paged' => $paged, 'post_status' => 'publish');
	} else {
		$arg = array('paged' => $paged, 'post_status' => 'publish');
	}
	# Load the posts
	query_posts($arg);
	get_template_part($loopFile);

	exit;
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate'); // for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate'); // if user not logged in

function misha_my_load_more_scripts()
{
	global $wp_query;
	wp_enqueue_script('jquery');
	wp_register_script('my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery'));
	wp_localize_script('my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
		'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	));

	wp_enqueue_script('my_loadmore');
}

add_action('wp_enqueue_scripts', 'misha_my_load_more_scripts');

function misha_loadmore_ajax_handler()
{
	$args = json_decode(stripslashes($_POST['query']), true);
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	query_posts($args);
	if (have_posts()) :
		while (have_posts()) : the_post();
			get_template_part('template-parts/content', get_post_format());
		endwhile;
	endif;
	die;
}

add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler');

function wpb_track_post_views($post_id)
{
	if (!is_single()) return;
	if (empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}
	wpb_get_post_views($post_id);
}
add_action('wp_head', 'wpb_track_post_views');
function wpb_get_post_views($postID)
{
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count . ' Views';
}


function ci_get_related_posts($post_id, $related_count, $args = array())
{
	$terms = get_the_terms($post_id, 'category');

	if (empty($terms)) $terms = array();

	$term_list = wp_list_pluck($terms, 'slug');

	$related_args = array(
		'post_type' => 'post',
		'posts_per_page' => $related_count,
		'post_status' => 'publish',
		'post__not_in' => array($post_id),
		'orderby' => 'rand',
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'fields' => 'slug',
				'terms' => array('category-2', 'category-1-3', 'category-2-4')
			),
			array(
				'taxonomy' => 'post_tag',
				'fields' => 'slug',
				'terms' => array('tag2')
			),
		)
	);

	return new WP_Query($related_args);
}


function getIcon($text)
{
	if (stripos($text, "facebook") !== false) {
		return  '<i class="fab fa-facebook-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "instagram") !== false) {
		return  '<i class="fab fa-instagram-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "twitter") !== false) {
		return  '<i class="fab fa-twitter-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "pinterest") !== false) {
		return  '<i class="fab fa-pinterest-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "linkedin") !== false) {
		return  '<i class="fab fa-linkedin fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "website") !== false) {
		return  '<i class="fab fa-link fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "tumblr") !== false) {
		return  '<i class="fab fa-tumblr-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "whatsapp") !== false) {
		return  '<i class="fab fa-whatsapp-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "youtube") !== false) {
		return  '<i class="fab fa-youtube-square fa-2x float-left mr-2"></i>';
	} else if (stripos($text, "reddit") !== false) {
		return  '<i class="fab fa-reddit-square fa-2x float-left mr-2"></i>';
	}
}

function metaSEO()
{
	echo '<meta name="title" content="' . get_the_title() . '">';
	echo '<meta name="description" content="' . shorten_string(get_the_excerpt(), 35) . '">';

	echo '<meta property="og:title" content="' . get_the_title() . '">';
	echo '<meta property="og:site_name" content="' . get_bloginfo() . '">';
	echo '<meta property="og:url" content="' . get_the_permalink() . '">';
	echo '<meta property="og:description" content="' . shorten_string(get_the_excerpt(), 35) . '">';
	echo '<meta property="og:type" content="article">';
	if (is_home() || is_tag() || is_category()) {
		echo '<meta property="og:image" content="' . getLogo() . '">';
	} else if (is_author()) {
		echo '<meta property="og:image" content="' . esc_url(get_avatar_url(get_the_author_meta('ID'))) . '">';
	} else if (is_single()) {
		echo '<meta property="og:image" content="' . get_the_post_thumbnail_url('medium') . '">';
	}
}

add_action("wp_head", "metaSEO");
