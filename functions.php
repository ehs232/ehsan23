<?php

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', 'cafe_coffee_charm_my_theme_enqueue_styles');
function cafe_coffee_charm_my_theme_enqueue_styles() {
    $cafe_coffee_charm_parent_style = 'coffee-tea-main'; // Style handle of parent theme
    wp_enqueue_style($cafe_coffee_charm_parent_style, get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('construction-company-style', get_stylesheet_uri(), array($cafe_coffee_charm_parent_style));
}

add_action('wp_enqueue_scripts', 'cafe_coffee_charm_script');
function cafe_coffee_charm_script() {
    $cafe_coffee_charm_parent_script_handle = 'coffee-tea-theme-js'; // Script handle of parent theme
    wp_enqueue_script($cafe_coffee_charm_parent_script_handle, get_theme_file_uri('/assets/js/theme.js'), array(), null, true);
}

// Theme setup
if (!function_exists('cafe_coffee_charm_setup')) :
    function cafe_coffee_charm_setup() {
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('custom-header');
        add_theme_support('responsive-embeds');
        add_theme_support('post-thumbnails');
        add_theme_support('align-wide');
        load_theme_textdomain( 'cafe-coffee-charm', get_template_directory() . '/languages' );
        add_editor_style(array('assets/css/editor-style.css'));
        add_theme_support('custom-background', apply_filters('cafe_coffee_charm_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        if ( ! defined( 'COFFEE_TEA_DEMO_IMPORT_URL' ) ) {
            define( 'COFFEE_TEA_DEMO_IMPORT_URL', esc_url( admin_url( 'themes.php?page=cafecoffeecharm-wizard' ) ) );
        }
        if ( ! defined( 'COFFEE_TEA_WELCOME_MESSAGE' ) ) {
            define( 'COFFEE_TEA_WELCOME_MESSAGE', __( 'Welcome! Thank you for choosing Cafe Coffee Charm', 'cafe-coffee-charm' ) );
        }
        if ( ! defined( 'COFFEE_TEA_DEMO_IMPORT_URL' ) ) {
            define( 'COFFEE_TEA_DEMO_IMPORT_URL', esc_url( admin_url( 'themes.php?page=cafecoffeecharm-wizard' ) ) );
        }

    }
endif;
add_action('after_setup_theme', 'cafe_coffee_charm_setup');

// Set content width
function cafe_coffee_charm_content_width() {
    $GLOBALS['content_width'] = apply_filters('cafe_coffee_charm_content_width', 1170);
}
add_action('after_setup_theme', 'cafe_coffee_charm_content_width', 0);

// Register widget areas
function cafe_coffee_charm_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'cafe-coffee-charm'),
        'id' => 'coffee-tea-sidebar-primary',
        'description' => __('The Primary Widget Area', 'cafe-coffee-charm'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInUp">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4><div class="title"><span class="shap"></span></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'cafe-coffee-charm'),
        'id' => 'coffee-tea-footer-widget-area',
        'description' => __('The Footer Widget Area', 'cafe-coffee-charm'),
        'before_widget' => '<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.5s"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h5 class="widget-title w-title">',
        'after_title' => '</h5><span class="shap"></span>',
    ));
}
add_action('widgets_init', 'cafe_coffee_charm_widgets_init');

// Remove customizer settings
function cafe_coffee_charm_remove_custom($wp_customize) {

    $wp_customize->remove_setting('coffee_tea_slider4');
    $wp_customize->remove_control('coffee_tea_slider4');

    $wp_customize->remove_setting('coffee_tea_slider5');
    $wp_customize->remove_control('coffee_tea_slider5');

    $wp_customize->remove_section('coffee_tea_product_section');

}
add_action('customize_register', 'cafe_coffee_charm_remove_custom', 1000);

function cafe_coffee_charm_child_customize_register( $wp_customize ) {

    /*=========================================
    product Section
    =========================================*/
    $wp_customize->add_section(
        'cafe_coffee_charm_our_products_section', array(
            'title' => esc_html__( 'Best Selling Products Section', 'cafe-coffee-charm' ),
            'priority' => 13,
            'panel' => 'coffee_tea_frontpage_sections',
        )
    );

    // About Us Hide/ Show Setting // 
    $wp_customize->add_setting( 
        'cafe_coffee_charm_our_products_show_hide_section' , 
            array(
            'default' => false,
            'sanitize_callback' => 'coffee_tea_sanitize_checkbox',
            'capability' => 'edit_theme_options',
            'priority' => 2,
        ) 
    );
    $wp_customize->add_control(
    'cafe_coffee_charm_our_products_show_hide_section', 
        array(
            'label'       => esc_html__( 'Hide / Show Section', 'cafe-coffee-charm' ),
            'section'     => 'cafe_coffee_charm_our_products_section',
            'settings'    => 'cafe_coffee_charm_our_products_show_hide_section',
            'type'        => 'checkbox'
        ) 
    );

    $wp_customize->add_setting( 
        'cafe_coffee_charm_category_small_heading',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );  
    $wp_customize->add_control( 
        'cafe_coffee_charm_category_small_heading',
        array(
            'label'         => __('Add Short Heading','cafe-coffee-charm'),
            'section'       => 'cafe_coffee_charm_our_products_section',
            'type'          => 'text',
        )
    );

    // About Heading
    $wp_customize->add_setting( 
        'cafe_coffee_charm_product_heading',
        array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );  
    $wp_customize->add_control( 
        'cafe_coffee_charm_product_heading',
        array(
            'label'         => __('Add Heading','cafe-coffee-charm'),
            'section'       => 'cafe_coffee_charm_our_products_section',
            'type'          => 'text',
        )
    );

    $cafe_coffee_charm_args = array(
        'type'           => 'product',
        'child_of'       => 0,
        'parent'         => '',
        'orderby'        => 'term_group',
        'order'          => 'ASC',
        'hide_empty'     => false,
        'hierarchical'   => 1,
        'number'         => '',
        'taxonomy'       => 'product_cat',
        'pad_counts'     => false
    );
    $categories = get_categories($cafe_coffee_charm_args);
    $cafe_coffee_charm_cats = array();
    $i = 0;
    foreach ($categories as $category) {
        if ($i == 0) {
            $default = $category->slug;
            $i++;
        }
        $cafe_coffee_charm_cats[$category->slug] = $category->name;
    }

    // Set the default value to "none"
    $cafe_coffee_charm_default_value = 'product_cat8';

    $wp_customize->add_setting(
        'cafe_coffee_charm_our_product_product_category',
        array(
            'default'           => $cafe_coffee_charm_default_value,
            'sanitize_callback' => 'coffee_tea_sanitize_select',
        )
    );

    // Add "None" as an option in the select dropdown
    $cafe_coffee_charm_cats_with_none = array_merge(array('none' => 'None'), $cafe_coffee_charm_cats);

    $wp_customize->add_control(
        'cafe_coffee_charm_our_product_product_category',
        array(
            'type'    => 'select',
            'choices' => $cafe_coffee_charm_cats_with_none,
            'label'   => __('Select Trending Products Category', 'cafe-coffee-charm'),
            'section' => 'cafe_coffee_charm_our_products_section',
        )
    );


}
add_action( 'customize_register', 'cafe_coffee_charm_child_customize_register', 20 );