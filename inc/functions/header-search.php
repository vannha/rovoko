<?php
/**
 * Header Search Icon
 * @since 1.0.0 
*/
if(!function_exists('rovoko_header_search')){
	function rovoko_header_search($args = []){
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '',
			'icon'	 => 'flaticon-magnifying-glass',
			'type'	 => ''
		]);
		$show_search = rovoko_get_opts('header_search', '0');
		if('0' === $show_search) return;
		wp_enqueue_script( 'magnific-popup' );
 		wp_enqueue_style( 'magnific-popup' );
		$link_classes = ['header-icon'];
		$link_classes = ['ef5-header-search-icon'];
		
		if($args['type'] === 'popup'){
			$link_classes[] = 'ef5-header-popup ';
			$form_classes[] = 'mfp-hide container';
		} else {
			$link_classes[] = 'ef5-search-toggle';
		}
		echo wp_kses_post($args['before']);
	?>
		<a href="#rovoko-search-popup" class="<?php echo trim(implode(' ', $link_classes));?>"><span class="icon <?php echo esc_attr($args['icon']);?>"></span></a>
	<?php
		echo wp_kses_post($args['after']);
	}
}

if(!function_exists('rovoko_search_popup_html')){
	function rovoko_search_popup_html($args = []){
		$show_search = 1;//rovoko_get_opts('header_search', '0');
		if('0' === $show_search) return;
		$form_classes = ['ef5-searchform'];
		$args = wp_parse_args($args, [
			'icon'	 => 'fal fa-search',
			'type'	 => 'popup'
		]);

		if($args['type'] === 'popup'){
			$form_classes[] = 'mfp-hide container';
		}
	?>
		<div id="rovoko-search-popup" class="<?php echo trim(implode(' ', $form_classes));?>">
			<div class="row justify-content-center">
				<div class="col-auto">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	<?php
	}
}
add_action('wp_footer','rovoko_search_popup_html');
