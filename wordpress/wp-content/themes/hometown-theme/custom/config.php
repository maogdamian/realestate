<?php

$nt_config = array(

    // Theme Post Format
    'theme_post_format' => array(),

    // Theme Menus
    'theme_menus' => array(
        'primary' => __('Primary', 'theme_admin'),
        'primary-left' => __('Primary Left (center logo layout)', 'theme_admin'),
        'primary-right' => __('Primary Right (center logo layout)', 'theme_admin'),
    ),

    // Libs
    'theme_libs' => array(),

    // Plugins
    'theme_plugins' => array(
        array(
            'name' => 'WPBakery Visual Composer',
            'slug' => 'js_composer',
            'version' => '5.4.7',
            'source' => get_template_directory() . '/plugin/js_composer.zip',
            'required' => true,
        ),
        array(
            'name' => 'HomeTown CPT',
            'slug' => 'hometown-cpt',
            'version' => '1.3.0',
            'source' => get_template_directory() . '/plugin/hometown-cpt.zip',
            'required' => true,
        ),
        array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'version' => '5.4.5.2',
            'source' => get_template_directory() . '/plugin/revslider.zip',
            'required' => false,
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'version' => '4.2.1',
            'source' => 'https://downloads.wordpress.org/plugin/contact-form-7.4.2.1.zip',
            'required' => false,
        ),
        array(
            'name' => 'oAuth Twitter Feed for Developers',
            'slug' => 'oauth-twitter-feed-for-developers',
            'version' => '2.2.1',
            'source' => 'https://downloads.wordpress.org/plugin/oauth-twitter-feed-for-developers.2.2.1.zip',
            'required' => false,
        ),
        array(
            'name' => 'WP-PageNavi',
            'slug' => 'wp-pagenavi',
            'version' => '2.87',
            'source' => 'https://downloads.wordpress.org/plugin/wp-pagenavi.2.87.zip',
            'required' => false,
        ),
    ),

    // Theme Sidebar
    'theme_sidebars' => array(
        array(
            'id' => 'blog',
            'name' => __('Blog - Sidebar', 'theme_admin'),
            'description' => __('Blog - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'page',
            'name' => __('Page - Sidebar', 'theme_admin'),
            'description' => __('Page - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'property',
            'name' => __('Property - Sidebar', 'theme_admin'),
            'description' => __('Property - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'agent',
            'name' => __('Agent - Sidebar', 'theme_admin'),
            'description' => __('Agent - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'member',
            'name' => __('Member - Sidebar', 'theme_admin'),
            'description' => __('Member - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'dsidxpress',
            'name' => __('dsIDXpress - Sidebar', 'theme_admin'),
            'description' => __('dsIDXpress - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'footer-1',
            'name' => __('Footer #1', 'theme_admin'),
            'description' => __('Footer #1 - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'footer-2',
            'name' => __('Footer #2', 'theme_admin'),
            'description' => __('Footer #2 - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'footer-3',
            'name' => __('Footer #3', 'theme_admin'),
            'description' => __('Footer #3 - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
        array(
            'id' => 'footer-4',
            'name' => __('Footer #4', 'theme_admin'),
            'description' => __('Footer #4 - Sidebar Widget Area', 'theme_admin'),
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        ),
    ),

    // Theme Options
    'theme_options' => array(
        'setup' => array('name' => __('Setup', 'theme_admin'), 'icon' => 'nt-icon-cog'),
        'branding' => array('name' => __('Branding', 'theme_admin'), 'icon' => 'nt-icon-user'),
        'appearance' => array('name' => __('Appearance', 'theme_admin'), 'icon' => 'nt-icon-pencil'),
        'font' => array('name' => __('Font', 'theme_admin'), 'icon' => 'nt-icon-doc'),
        'header' => array('name' => __('Header', 'theme_admin'), 'icon' => 'nt-icon-calendar'),
        'footer' => array('name' => __('Footer', 'theme_admin'), 'icon' => 'nt-icon-calendar'),
        'page' => array('name' => __('Page', 'theme_admin'), 'icon' => 'nt-icon-calendar'),

        // 'agent'             => array( 'name' => 'Agent', 'icon' => 'nt-icon-photo'),
        'blog' => array('name' => __('Blog', 'theme_admin'), 'icon' => 'nt-icon-calendar'),
        'page' => array('name' => __('Page', 'theme_admin'), 'icon' => 'nt-icon-calendar'),
        'property' => array('name' => __('Property', 'theme_admin'), 'icon' => 'nt-icon-shop'),
        // 'dsidxpress'         => array( 'name' => 'dsIDXpress', 'icon' => 'nt-icon-calendar'),
        'advance' => array('name' => __('Advance', 'theme_admin'), 'icon' => 'nt-icon-beaker'),
        // 'custom'         => array( 'name' => 'Custom', 'icon' => 'nt-icon-params')
    ),

);
