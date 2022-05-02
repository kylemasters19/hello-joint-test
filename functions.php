<?php
/**
 * Theme functions and definitions
 *
 * @package HelloJoint
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

const HELLO_JOINT_VERSION = '2.5.0';

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_joint_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_joint_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		$hook_result = apply_filters_deprecated( 'joint_hello_theme_load_textdomain', [ true ], '2.0', 'hello_joint_load_textdomain' );
		if ( apply_filters( 'hello_joint_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-joint', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'joint_hello_theme_register_menus', [ true ], '2.0', 'hello_joint_register_menus' );
		if ( apply_filters( 'hello_joint_register_menus', $hook_result ) ) {
			register_nav_menus( [ 'menu-1' => __( 'Header', 'hello-joint' ) ] );
			register_nav_menus( [ 'menu-2' => __( 'Footer', 'hello-joint' ) ] );
		}

		$hook_result = apply_filters_deprecated( 'joint_hello_theme_add_theme_support', [ true ], '2.0', 'hello_joint_add_theme_support' );
		if ( apply_filters( 'hello_joint_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'joint_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_joint_add_woocommerce_support' );
			if ( apply_filters( 'hello_joint_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_joint_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_JOINT_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_JOINT_VERSION );
	}
}

if ( ! function_exists( 'hello_joint_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_joint_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'joint_hello_theme_enqueue_style', [ true ], '2.0', 'hello_joint_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_joint_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-joint',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_JOINT_VERSION
			);
		}

		if ( apply_filters( 'hello_joint_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-joint-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_JOINT_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_joint_scripts_styles' );

if ( ! function_exists( 'hello_joint_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_joint_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'joint_hello_theme_register_elementor_locations', [ true ], '2.0', 'hello_joint_register_elementor_locations' );
		if ( apply_filters( 'hello_joint_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_joint_register_elementor_locations' );

if ( ! function_exists( 'hello_joint_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_joint_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_joint_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_joint_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
 */

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
 */
function hello_register_customizer_functions() {
	if ( hello_header_footer_experiment_active() && is_customize_preview() ) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_register_customizer_functions' );

if ( ! function_exists( 'hello_joint_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_joint_check_hide_title( bool $val ): bool {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_joint_page_title', 'hello_joint_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_joint_body_open' ) ) {
	function hello_joint_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}

if ( ! function_exists( 'hello_joint_login_logo_url' ) ) {
	function hello_joint_login_logo_url() {
		return home_url();
	}
}
add_filter( 'login_headerurl', 'hello_joint_login_logo_url' );

if ( ! function_exists( 'hello_joint_login_logo_url_title' ) ) {
	function hello_joint_login_logo_url_title() {
		return 'Powered by WeedPress';
	}
}
add_filter( 'login_headertext', 'hello_joint_login_logo_url_title' );

if ( ! function_exists( 'hello_joint_admin_stylesheet' ) ) {
	function hello_joint_admin_stylesheet() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'stylesheet_directory' ) . '/admin.min.css">';
	}
}
add_action( 'login_head', 'hello_joint_admin_stylesheet' );
add_action( 'admin_head', 'hello_joint_admin_stylesheet' );

if ( ! function_exists( 'hello_joint_remove_unused_assets' ) ) {
	function hello_joint_remove_unused_assets() {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-blocks-style' );

		// Remove emoji's
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'hello_joint_disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'hello_joint_disable_emojis_remove_dns_prefetch', 10, 2 );
	}
}
add_action( 'wp_enqueue_scripts', 'hello_joint_remove_unused_assets' );

if ( ! function_exists( 'hello_joint_disable_emojis_tinymce' ) ) {
	function hello_joint_disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}

if ( ! function_exists( 'hello_joint_disable_emojis_remove_dns_prefetch' ) ) {
	function hello_joint_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' === strtolower( $relation_type ) ) {
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}

		return $urls;
	}
}

if ( ! function_exists( 'hello_joint_preload_featured_image' ) ) {
	function hello_joint_preload_featured_image() {
		global $post;
		if ( ! is_admin() && is_page( $post->ID ) ) {
			$thumbnail = get_post_thumbnail_id( $post->ID );
			if ( $thumbnail ) {
				$image = wp_get_attachment_image_url( $thumbnail, 'full' );
				if ( $image ) {
					echo '<link rel="preload" as="image" href="' . $image . '" />';
				}
			}
		}
	}
}
add_action( 'wp_head', 'hello_joint_preload_featured_image', 1 );
