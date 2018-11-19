<?php
// Thumnail Size
add_action('after_setup_theme', 'nt_thumbnail_size');
function nt_thumbnail_size()
{
    add_image_size('marker', 500, 240, true);
    add_image_size('card', 675, 375, true);
    add_image_size('agent-card', 750, false, true);
    add_image_size('slide-full', 1600, false, true);
    add_image_size('slide', 1000, false, true);
    add_image_size('select', 30, 30, true);
}

// Change Excerpt "More" text
add_filter('excerpt_more', 'nt_new_excerpt_more');
function nt_new_excerpt_more($more)
{
    return '';
}

add_filter('nav_menu_css_class', 'nt_special_nav_class', 10, 2);
function nt_special_nav_class($classes, $item)
{
    $classes[] = get_post_meta($item->ID, 'menu-item-mega-menu', true);
    $classes[] = get_post_meta($item->ID, 'menu-item-style', true);
    return $classes;
}

// Remove "Appearance > Customize" Menu
function nt_remove_menus()
{
    global $submenu;
    unset($submenu['themes.php'][6]);
}
add_action('admin_menu', 'nt_remove_menus');

// Get Request Parameter
function nt_get_request($key)
{
    return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : '';
}

// Check Isset
function nt_check($param)
{
    if (isset($param)) {
        return $param;
    } else {
        return '';
    }
}



// Custom Password Required Template
add_filter('the_password_form', 'nt_password_form');
function nt_password_form()
{
    global $post;

    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $output = '<form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post" class="theme-form validate-form">
    <p>' . __('This post is password protected. Please fill the password:', 'theme_front') . '</p>
    <div class="form-input-item infield-button input-wrap protected-password-input-item clearfix">
    <input name="post_password" class="input-text {required:true}" id="' . $label . '" type="password" size="20" value="" autocomplete="off" placeholder="' . __('Password', 'theme_front') . '" />
        <button type="submit" name="Submit" class="lt-button"><span>' . esc_attr__('Submit', 'theme_front') . '</span></button>
	</div>
    </form>';

    return $output;
}

// Add action wp_footer
add_action('wp_footer', 'nt_theme_footer');
function nt_theme_footer()
{

    if (nt_get_option('advance', 'show_customize') == 'on' || isset($_REQUEST['customize'])) {
        get_template_part('section/section', 'customize-panel');
    }

    if (nt_get_option('advance', 'analytic_ua')) {
        ?>
		<script type="text/javascript">//<![CDATA[
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo nt_get_option('advance', 'analytic_ua'); ?>']);
                            _gaq.push(['_trackPageview']);
            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        //]]></script>
<?php
}
}

// FB Image
add_action('wp_head', 'nt_fb_image');
function nt_fb_image()
{
    $queried_object = get_queried_object();
    if(is_single()) {
        if ($queried_object && has_post_thumbnail($queried_object->ID)) {
            $src = wp_get_attachment_image_src(get_post_thumbnail_id($queried_object->ID), 'full');
            echo '<meta property="og:image" content="' . $src[0] . '" />';
        }
    }
    
}

// Add specific CSS class by filter
add_filter('body_class', 'nt_theme_class');
function nt_theme_class($classes)
{
    global $post;

    $classes[] = nt_get_option('appearance', 'direction', 'ltr');
    $classes[] = nt_get_option('appearance', 'site_layout', 'full-width');
    $classes[] = nt_get_option('appearance', 'looks_feels', 'element-round');
    // $classes[] = 'page-load-'.nt_get_option('appearance', 'page_load', 'on');

    return $classes;
}

// WPML
function nt_wpml_language_selector_flags()
{
    if (function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if (!empty($languages)) {
            echo '<div class="wpml-language-switcher">';
            foreach ($languages as $l) {
                if (!$l['active']) {
                    echo '<a href="' . esc_url($l['url']) . '">';
                } else {
                    echo '<a href="#">';
                }
                echo '<img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" /></a>';
            }
            echo '</div>';
        }
    }
}

// Sort Terms
function nt_sort_terms_hierarchicaly(array &$cats, array &$into, $parentId = 0)
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        nt_sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
    }
}

// Get Meta Value
function nt_get_meta_values($key = '', $type = 'post', $status = 'publish')
{
    global $wpdb;
    if (empty($key)) {
        return;
    }

    $r = $wpdb->get_col($wpdb->prepare("
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s'
        AND p.post_status = '%s'
        AND p.post_type = '%s'
    ", $key, $status, $type));
    return $r;
}

function is_decimal($val)
{
    return (strpos($val, '.') !== false);
}

// Currency
function nt_currency($price, $per = '')
{
    if (!is_numeric($price)) {
        return $price;
    }

    $currency = nt_get_option('property', 'currency');
    $currencyPositon = nt_get_option('property', 'currency_position');
    if ($per) {
        $per = ' <small>/' . $per . '</small>';
    }

    if ($currencyPositon == 'before') {
        return $currency . '<span>' . nt_currency_format($price) . '</span>' . $per;
    } else {
        return '<span>' . nt_currency_format($price) . '</span>' . $currency . $per;
    }
}

// Area Format
function nt_area_format($area)
{
    // var_dump($area);
    return number_format($area, (is_decimal($area)) ? 2 : 0, nt_get_option('property', 'decimal_point', '.'), nt_get_option('property', 'thousands_sep', ','));
}

// Currency Format
function nt_currency_format($amount)
{
    return number_format($amount, (is_decimal($amount)) ? 2 : 0, nt_get_option('property', 'decimal_point', '.'), nt_get_option('property', 'thousands_sep', ','));
}

// Theme Item Module
get_template_part('section/function', 'property-search-form');
get_template_part('section/function', 'single-property');
get_template_part('section/function', 'property-card');
get_template_part('section/function', 'property-list');
get_template_part('section/function', 'agent-card');
get_template_part('section/function', 'post-card');

// Enable paged on agent, property
add_action('template_redirect', function() {
    if ( is_singular(array('agent', 'property')) ) {
      global $wp_query;
      $page = (int) $wp_query->get('page');
      if ( $page > 1 ) {
        // convert 'page' to 'paged'
        $query->set( 'page', 1 );
        $query->set( 'paged', $page );
      }
      // prevent redirect
      remove_action( 'template_redirect', 'redirect_canonical' );
    }
  }, 0 );

add_action('pre_get_posts', 'nt_property_filter');
function nt_property_filter($query)
{

    if (is_admin()) {
        return;
    }
    
    

    // Sorting
    if (!isset($query->query['bypass_sort'])) {
        if (($query->is_tax(array('location', 'status', 'type')) || $query->is_post_type_archive('property')) || (is_page() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'property')) {

            $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : nt_get_option('property', 'default_sorting', '');
            $_REQUEST['sort'] = $sort;
            if ($sort) {
                if ($sort == 'price-desc') {
                    $query->query_vars['orderby'] = 'meta_value_num';
                    $query->query_vars['order'] = 'desc';
                    $query->query_vars['meta_key'] = '_meta_price';
                } else if ($sort == 'price-asc') {
                    $query->query_vars['orderby'] = 'meta_value_num';
                    $query->query_vars['order'] = 'asc';
                    $query->query_vars['meta_key'] = '_meta_price';
                } else if ($sort == 'date-asc') {
                    $query->query_vars['orderby'] = 'date';
                    $query->query_vars['order'] = 'asc';
                } else if ($sort == 'date-desc') {
                    $query->query_vars['orderby'] = 'date';
                    $query->query_vars['order'] = 'desc';
                } else if ($sort == 'name-asc') {
                    $query->query_vars['orderby'] = 'title';
                    $query->query_vars['order'] = 'asc';
                } else if ($sort == 'name-desc') {
                    $query->query_vars['orderby'] = 'title';
                    $query->query_vars['order'] = 'desc';
                }
            }

        }
    }

    if (isset($query->query['bypass_filter'])) {
        return;
    }

    if (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'property') {

        // WPML
        $query->query_vars['suppress_filters'] = 0;

        // Property per Page
        if (!is_admin() && !isset($query->query_vars['posts_per_page'])) {
            $query->query_vars['posts_per_page'] = nt_get_option('property', 'per_page', get_option('posts_per_page'));
        }

        // ID
        if (isset($_REQUEST['property-id']) && $_REQUEST['property-id']) {
            $query->query_vars['meta_query'][] = array('key' => '_meta_id', 'value' => $_REQUEST['property-id'], 'compare' => 'LIKE');
        }

        // Bedroom
        if (isset($_REQUEST['min-bed']) && $_REQUEST['min-bed']) {
            $query->query_vars['meta_query'][] = array('key' => '_meta_bedroom', 'value' => $_REQUEST['min-bed'], 'compare' => '>=', 'type' => 'NUMERIC');
        }

        // Bathroom
        if (isset($_REQUEST['min-bath']) && $_REQUEST['min-bath']) {
            $query->query_vars['meta_query'][] = array('key' => '_meta_bathroom', 'value' => $_REQUEST['min-bath'], 'compare' => '>=', 'type' => 'NUMERIC');
        }

        // Price
        if (isset($_REQUEST['l-price']) && isset($_REQUEST['u-price'])) {
            $prices = get_meta_values('_meta_price', 'property');
            foreach ($prices as $key => $price) {
                if (($price >= $_REQUEST['l-price'] && $price <= $_REQUEST['u-price']) || $price == '0') {
                    unset($prices[$key]);
                }
            }

            $query->query_vars['meta_query'][] = array('key' => '_meta_price', 'value' => $prices, 'compare' => 'NOT IN');
        }

        // Area
        if (isset($_REQUEST['l-area']) && isset($_REQUEST['u-area'])) {
            $areas = get_meta_values('_meta_area', 'property');
            foreach ($areas as $key => $area) {
                if (($area >= $_REQUEST['l-area'] && $area <= $_REQUEST['u-area']) || $area == '0') {
                    unset($areas[$key]);
                }
            }
            $query->query_vars['meta_query'][] = array('key' => '_meta_area', 'value' => $areas, 'compare' => 'NOT IN', 'type' => 'NUMERIC');
        }

        $query->query_vars['tax_query']['relation'] = 'AND';

        // Location
        if (isset($_REQUEST['s-location']) && $_REQUEST['s-location']) {
            $query->query_vars['tax_query'][] = array('taxonomy' => 'location', 'include_children' => true, 'field' => 'term_id', 'terms' => array($_REQUEST['s-location']), 'operator' => 'IN');
        }
        // Status
        if (isset($_REQUEST['s-status']) && $_REQUEST['s-status']) {
            $query->query_vars['tax_query'][] = array('taxonomy' => 'status', 'include_children' => true, 'field' => 'term_id', 'terms' => array($_REQUEST['s-status']), 'operator' => 'IN');
        }
        // Type
        if (isset($_REQUEST['s-type']) && $_REQUEST['s-type']) {
            $query->query_vars['tax_query'][] = array('taxonomy' => 'type', 'include_children' => true, 'field' => 'term_id', 'terms' => array($_REQUEST['s-type']), 'operator' => 'IN');
        }

        // var_dump($query);
        // die();

    }
}

function get_meta_values($key = '', $type = 'post', $status = 'publish')
{

    global $wpdb;

    if (empty($key)) {
        return;
    }

    $r = $wpdb->get_col($wpdb->prepare("
        SELECT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s'
        AND p.post_status = '%s'
        AND p.post_type = '%s'
    ", $key, $status, $type));

    return $r;
}
