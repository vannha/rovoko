<?php
/**
 * Header Main 
*/
if(!function_exists('rovoko_header_main')){
    function rovoko_header_main($class = ''){
        $header_layout = rovoko_get_opts('header_layout','1');
        get_template_part('template-parts/header/layout', $header_layout);
    }
}
/**
 * Header Class 
**/
if(!function_exists('rovoko_header_class')){
    function rovoko_header_class($class = ''){
        $classes = [];
        $classes[] = 'ef5-header';
        $header_ontop  = rovoko_get_opts('header_ontop','0');
        $header_sticky = rovoko_get_opts('header_sticky','0');
        $header_layout = rovoko_get_opts('header_layout','1');

        $classes[] = 'header-layout-'.$header_layout;
        if($header_layout === '3') $classes[] = 'side-header';

        if(!$header_ontop && !$header_sticky){
            $classes[] = 'header-default';
        } elseif ($header_ontop && !$header_sticky){
            $classes[] = 'header-ontop';
        } elseif (!$header_ontop && $header_sticky){
            $classes[] = 'header-default header-default-sticky sticky-on';
        } elseif($header_ontop && $header_sticky){
            $classes[] = 'header-ontop header-ontop-sticky sticky-on';
        } elseif($header_ontop){
            $classes[] = 'header_ontop';
        } elseif($header_sticky){
            $classes[] = 'header-default header-default-sticky sticky-on';
        }

        if(!empty($class)) $classes[] = $class;
        
        echo 'class="'.trim(implode(' ', $classes)).'"';
    }
}
if(!function_exists('rovoko_header_inner_class')){
    function rovoko_header_inner_class($class = ''){
        $header_fullwidth = rovoko_get_opts('header_fullwidth', '0');
        $classes = array('header-inner');
        if('1' === $header_fullwidth){
            $classes[] = 'no-container';
        } else {
            $classes[] = 'container';
        }
        if(!empty($class)) $classes[] = $class;
        echo trim(implode(' ', $classes));
    }
}
if(!function_exists('rovoko_header_ontop')){
    function rovoko_header_ontop(){
        $header_ontop = rovoko_get_opts('header_ontop');
        return  $header_ontop;
    }
}

if(!function_exists('rovoko_header_sticky')){
    function rovoko_header_sticky(){
        $header_sticky = rovoko_get_opts('header_sticky');
        return  $header_sticky;
    }
}

if(!function_exists('rovoko_header_menu')){
    function rovoko_header_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = rovoko_get_opts('header_menu','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php get_template_part( 'template-parts/header/header-menu' ); ?>
            </nav>
        <?php
    }
}

if(!function_exists('rovoko_header_side_menu')){
    function rovoko_header_side_menu($args = []){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $header_menu = rovoko_get_opts('header_menu','ef5-primary');
        if('none' === $header_menu) return;
        ?>
            <nav id="ef5-navigation" class="<?php echo trim(implode(' ', (array)$args['class']));?>">
                <?php get_template_part( 'template-parts/header/header-side-menu' ); ?>
            </nav>
        <?php
    }
}

if(!function_exists('rovoko_header_menu_fallback')){
    function rovoko_header_menu_fallback(){
        printf(
            '<ul id="ef5-header-menu" class="%1$s"><li class="menu-item required"><a href="%2$s">%3$s</a></li></ul>',
            esc_attr(rovoko_header_menu_class('primary-menu-not-set')),
            esc_url( admin_url( 'nav-menus.php?action=locations' ) ),
            esc_html__( 'Primary menu is not set, please location to "Primary Menu".','rovoko' )
        );
    }
}

/**
 * Header Menu Class
 * add class to menu container class
 *
*/
if(!function_exists('rovoko_header_menu_class')){
    function rovoko_header_menu_class($class=''){
        $classes = ['ef5-menu'];
        $header_layout = rovoko_get_opts('header_layout', '1');
        $header_ontop  = rovoko_get_opts('header_ontop','0');
        $header_sticky = rovoko_get_opts('header_sticky','0');
	    $header_social_menu = rovoko_get_opts('header_social_menu_items','');
	    $header_custom_text = rovoko_get_opts('header_custom_text','');

        if($header_layout === '3')
            $classes[] = 'ef5-side-menu';
        else 
            $classes[] = 'ef5-header-menu';

        if(!$header_ontop && !$header_sticky){
            $classes[] = 'menu-default';
        } elseif ($header_ontop && !$header_sticky){
            $classes[] = 'menu-ontop';
        } elseif (!$header_ontop && $header_sticky){
            $classes[] = 'menu-default';
        } elseif($header_ontop && $header_sticky){
            $classes[] = 'menu-ontop';
        }

        if($header_social_menu == 1 || !empty($header_custom_text)) $classes[] = 'has-social-menu';

        $classes[] = $class;

        return trim(implode(' ', $classes));
    }
}