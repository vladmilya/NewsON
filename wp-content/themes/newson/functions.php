<?php

function newson_style() {
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'bootstrap');  
    wp_register_style( 'font-awesome', get_template_directory_uri() . '/font-awesome-4.5.0/css/font-awesome.css');   
    wp_enqueue_style( 'font-awesome');
    wp_register_style( 'main-style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style( 'main-style');
    wp_register_style( 'myfonts', get_template_directory_uri() . '/css/MyFontsWebfontsKit.css');
    wp_enqueue_style( 'myfonts');
}
add_action( 'wp_enqueue_scripts', 'newson_style' );

function newson_scripts() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, false );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true );
    wp_enqueue_script( 'bootstrap');    
    wp_register_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array(), false, true );
    wp_enqueue_script( 'bxslider');
    wp_register_script( 'highlight', get_template_directory_uri() . '/js/highlight.js', false, NULL, false );
    wp_enqueue_script( 'highlight' );
    wp_register_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.min.js', false, NULL, false );
    wp_enqueue_script( 'gmap3' );
    wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array(), false, true );
    wp_enqueue_script( 'main'); 
}
add_action( 'wp_enqueue_scripts', 'newson_scripts' );

register_nav_menus( array(
		'primary'   => __( 'Main Menu', 'newson' ),
        'secondary'    => __( 'Footer Menu', 'newson' ),
	) );
    
function newson_widgets_init() {
    register_sidebar( array(
		'name'          => __( 'Footer Left', 'newson' ),
		'id'            => 'footer1',
		'description'   => __( 'Add widgets here to appear in the left website footer area.', 'newson' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Footer Right', 'newson' ),
		'id'            => 'footer2',
		'description'   => __( 'Add widgets here to appear in the right website footer area.', 'newson' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'newson' ),
		'id'            => 'blog_sidebar',
		'description'   => __( 'Add widgets here to appear in the blog side bar.', 'newson' ),
		'before_widget' => '<div class="panel panel-default">',
		'after_widget'  => '<div></div></div>',
		'before_title'  => '<div class="panel-heading"><h3 class="panel-title">',
		'after_title'   => '</h3></div>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Blog Post Sidebar', 'newson' ),
		'id'            => 'blog_post_sidebar',
		'description'   => __( 'Add widgets here to appear in the blog post side bar.', 'newson' ),
		'before_widget' => '<div class="panel panel-default">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="panel-heading"><h3 class="panel-title">',
		'after_title'   => '</h3></div>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Team Member Sidebar', 'newson' ),
		'id'            => 'team_post_sidebar',
		'description'   => __( 'Add widgets here to appear in the team memeber page side bar.', 'newson' ),
		'before_widget' => '<div class="panel panel-default">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="panel-heading"><h3 class="panel-title">',
		'after_title'   => '</h3></div>',
	) );
    
    register_sidebar( array(
		'name'          => __( 'Search Sidebar', 'newson' ),
		'id'            => 'search_sidebar',
		'description'   => __( 'Add widgets here to appear in the search page side bar.', 'newson' ),
		'before_widget' => '<div class="panel panel-default">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="panel-heading"><h3 class="panel-title">',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'newson_widgets_init' );

//Featured images on
add_theme_support( 'post-thumbnails' ); 

//shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

function html_widget_title( $title ) {
	//HTML tag opening/closing brackets
	$title = str_replace( '[', '<', $title );
	$title = str_replace( ']', '>', $title );
    $title = str_replace( '((', '"', $title );
    $title = str_replace( '))', '"', $title );

	return $title;
}
add_filter( 'widget_title', 'html_widget_title' );

/*function newson_change_widget_title($title)
{
    $title = str_replace('[twitter]', '<i class="fa fa-twitter"></i>', $title);
    return $title;
}
add_filter('widget_title', 'newson_change_widget_title', 10);*/

//search filter
function SearchFilter($query) {
    if ($query->is_search and !is_admin()) {
        $query->set('post_type', 'post');
        $query->set('category_name', 'news');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

function newson_general_settings_register_fields(){
    register_setting('general', 'hidden_h1', 'esc_attr');
    add_settings_field('hidden_h1', '<label for="hidden_h1">'.__('Hidden H1' , 'hidden_h1' ).'</label>' , 'newson_general_settings_fields_html', 'general');
} 
function newson_general_settings_fields_html(){
    $value = get_option( 'hidden_h1', '' );
    echo '<input type="text" id="hidden_h1" name="hidden_h1" value="' . $value . '" class="regular-text"/>';
}
add_filter('admin_init', 'newson_general_settings_register_fields');

function newson_latest_posts_shortcode($atts){
    extract( shortcode_atts( array(
			'num' => '',
    ),$atts ));
    $aPosts = latest_news_posts($num);
    $sPosts = '';
    if(!empty($aPosts)){
        $sPosts.='<ul class="posts-list">';
        foreach($aPosts as $post){
            $sPosts.='<li>
                        <a href="'.$post['link'].'">'.$post['title'].'</a> 
                        <span>'.$post['date'].'</span>                                               
                      </li>';
        }
        $sPosts.='
        <li class="show-more"><a href="'.esc_url( home_url( '/' ) ).'news/" class="more"><span class="btn"><span class="icon-right-big"></span></span>More</a></li>
        </ul>';
    }
    return $sPosts;
}
add_shortcode('latest_news', 'newson_latest_posts_shortcode');

function newson_team_shortcode($atts){
    extract( shortcode_atts( array(
			'num' => '',
    ),$atts ));
    $aPosts = team_posts($num);
    $sPosts = '';
    if(!empty($aPosts)){
        $sPosts.='<ul class="posts-list">';
        foreach($aPosts as $post){
            $sPosts.='<li>
                        <a href="'.$post['link'].'">'.$post['title'].'</a> 
                        <span>'.$post['position'].'</span>                                               
                      </li>';
        }
        $sPosts.='</ul>';
    }
    return $sPosts;
}
add_shortcode('team', 'newson_team_shortcode');

function get_sub_categories($parent, $detail = false){
    $idObj = get_category_by_slug($parent); 
    $id = $idObj->term_id;
    unset($idObj);
    $args = array(
        'type'                     => 'post',
        'child_of'                 => 0,
        'parent'                   => $id,
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'hide_empty'               => 0,
        'hierarchical'             => 1,
        'exclude'                  => '',
        'include'                  => '',
        'number'                   => '',
        'taxonomy'                 => 'category',
        'pad_counts'               => false 
    );
    $categories = get_categories( $args );
    if($detail){
        $aCategories = $categories;
    }else{
        $aCategories = array();
        if(!empty($categories)){
            foreach($categories as $k=>$cat){
                $aCategories[$k]['cat_ID'] = $cat->cat_ID;
                $aCategories[$k]['name'] = $cat->name;
                $aCategories[$k]['slug'] = $cat->slug;
            }
            unset($categories);
        } 
    }
    return $aCategories;
}

function latest_news_posts($num=''){
    $args = array(
            'showposts'=>$num,
            'category_name' => 'news',
            'orderby' => 'published',
            'order'   => 'DESC',
    );
    $query = new WP_Query( $args );
    $aPosts = array();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $aPost = array();
            $aPost['title'] = $query->post->post_title;
            $aPost['date'] = get_the_time('F j, Y', $query->post->ID);
            $aPost['link'] = get_permalink($query->post->ID);
            $aPosts[] = $aPost;
        }
    }
    return $aPosts;
}

function team_posts($num='-1'){
    $args = array(
            'showposts'=>$num,
            'category_name' => 'team'
    );
    $query = new WP_Query( $args );
    $aPosts = array();
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $meta = get_post_meta($query->post->ID);
            $aPost = array();
            $aPost['title'] = $query->post->post_title;
            $aPost['position'] = $meta['position'][0];
            $aPost['link'] = get_permalink($query->post->ID);
            $aPosts[] = $aPost;
        }
    }
    return $aPosts;
}

function make_menu($name){
    $args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false );
    $aMenu = wp_get_nav_menu_items( $name, $args );
    $aOutputMenu = array();
    if(!empty($aMenu))foreach($aMenu as $item){
        if($item->menu_item_parent){
            if(isset($aOutputMenu[$item->menu_item_parent])){
                $aOutputMenu[$item->menu_item_parent]['submenu'][] = $item;
            }
        }else{
            $aOutputMenu[$item->ID]['main'] = $item;
        }
    }
    return $aOutputMenu;
}

function dump($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    echo "<hr />";
}