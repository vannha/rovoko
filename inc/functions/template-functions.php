<?php

/**
 * Post Header
 *
 * Showing post header in loop / single
 *
 **/
if ( ! function_exists( 'rovoko_post_header' ) ) {
	function rovoko_post_header( $args = [] ) {
		$args          = wp_parse_args( $args, [
			'heading_tag' => 'h3',
			'title_link'  => true,
			'class'       => '',
		] );
		$classes       = [ 'ef5-post-header', $args['class'] ];
		$title_classes = [ 'ef5-heading', $args['heading_tag'] ];
		$stick_icon    = ( is_sticky() && is_home() && ! is_paged() ) ? '<span class="sticky-post"><span class="sticky-post-inner">Featured</span></span>' : '';
		$link_open     = $args['title_link'] === true ? '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' : '';
		$link_close    = $args['title_link'] === true ? '</a>' : '';

		?>
        <div class="<?php echo trim( implode( ' ', $classes ) ); ?>">
            <div class="ef5-before-title empty-none"><?php do_action( 'rovoko_before_loop_title' ); ?></div>
			<?php the_title( '<div class="' . trim( implode( ' ', $title_classes ) ) . '">' . $link_open . $stick_icon, $link_close . '</div>' ); ?>
            <div class="ef5-after-title empty-none"><?php do_action( 'rovoko_after_loop_title' ); ?></div>
        </div>
		<?php
	}
}


if ( ! function_exists( 'rovoko_post_title' ) ) {
	function rovoko_post_title( $args = [] ) {
		$args          = wp_parse_args( $args, [
			'heading_tag' => 'h4',
			'class'       => '',
			'echo'        => true
		] );
		$title_classes = [ 'ef5-heading', $args['heading_tag'], $args['class'] ];
		$stick_icon    = ( is_sticky() && is_home() && ! is_paged() ) ? '<span class="fa fa-thumb-tack"></span>&nbsp;&nbsp;' : '';
		$link_open     = is_singular() ? '' : '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		$link_close    = is_singular() ? '' : '</a>';
		if ( $args['echo'] ) {
			the_title( '<div class="' . trim( implode( ' ', $title_classes ) ) . '">' . $link_open . $stick_icon, $link_close . '</div>' );
		} else {
			return '<div class="' . trim( implode( ' ', $title_classes ) ) . '">' . $link_open . $stick_icon . get_the_title() . $link_close . '</div>';
		}
	}
}

/**
 * Post Meta
 * Prints HTML with meta information for the current post.
 */
if ( ! function_exists( 'rovoko_post_meta' ) ) {
	add_action( 'rovoko_after_post_media', 'rovoko_post_meta' );
	function rovoko_post_meta( $args = [] ) {
		if ( is_singular() ) {
			$author_on     = ! empty( $args['show_author'] ) ? $args['show_author'] : rovoko_get_theme_opt( 'post_author_on', '1' );
			$date_on       = ! empty( $args['show_date'] ) ? $args['show_date'] : rovoko_get_theme_opt( 'post_date_on', '1' );
			$comments_on   = ! empty( $args['show_cmt'] ) ? $args['show_cmt'] : rovoko_get_theme_opt( 'post_comments_on', '1' );
			$show_like     = ! empty( $args['show_like'] ) ? $args['show_like'] : rovoko_get_theme_opt( 'post_like_on', '0' );
			$comments_icon = 'flaticon-comment-1';
			$date_icon     = 'flaticon-calendar';
			$comments_text = $cats_on = false;
		} else {
			$author_on     = ! empty( $args['show_author'] ) ? $args['show_author'] : rovoko_get_theme_opt( 'archive_author_on', '1' );
			$date_on       = ! empty( $args['show_date'] ) ? $args['show_date'] : rovoko_get_theme_opt( 'archive_date_on', '1' );
			$cats_on       = ! empty( $args['show_cat'] ) ? $args['show_cat'] : rovoko_get_theme_opt( 'archive_categories_on', '1' );
			$comments_on   = ! empty( $args['show_cmt'] ) ? $args['show_cmt'] : rovoko_get_theme_opt( 'archive_comments_on', '1' );
			$show_like     = ! empty( $args['show_like'] ) ? $args['show_like'] : rovoko_get_theme_opt( 'archive_like_on', '0' );
			$comments_icon = 'flaticon-comment';
			$date_icon     = 'flaticon-calendar-1';
			$comments_text = true;
		}

		$args  = wp_parse_args( $args, [
			'class'           => '',
			'show_author'     => $author_on,
			'show_date'       => $date_on,
			'show_cat'        => $cats_on,
			'show_cmt'        => $comments_on,
			'cmt_icon'        => $comments_icon,
			'cmt_text'        => $comments_text,
			'date_icon'       => $date_icon,
			'show_like'       => $show_like,
			'show_edit'       => false,
			'stretch_content' => false,
			'sep'             => '',
		] );
		$metas = [];
		if ( $args['show_author'] ) {
			$metas[] = rovoko_posted_by( [
				'show_author'   => $args['show_author'],
				'echo'          => false,
				'icon'          => '',
				'author_avatar' => true,
			] );
		}
		if ( $args['show_date'] ) {
			$metas[] = rovoko_posted_on( [
				'show_date' => $args['show_date'],
				'icon'      => $args['date_icon'],
				'echo'      => false
			] );
		}
		if ( $args['show_cat'] ) {
			$metas[] = rovoko_posted_in( [ 'show_cat' => $args['show_cat'], 'echo' => false ] );
		}
		if ( $args['show_like'] ) {
			$metas[] = rovoko_post_count_like( [ 'show_like' => $args['show_like'], 'echo' => false ] );
		}
		if ( $args['show_cmt'] && comments_open() ) {
			$metas[] = rovoko_comments_popup_link( [
				'show_cmt'  => $args['show_cmt'],
				'show_text' => $args['cmt_text'],
				'icon'      => $args['cmt_icon'],
				'echo'      => false
			] );
		}
		if ( $args['show_edit'] ) {
			$metas[] = rovoko_edit_link( [ 'show_edit' => $args['show_edit'], 'echo' => false ] );
		}

		$output      = implode( $args['sep'], $metas );
		$css_classes = [ 'ef5-meta', $args['class'], 'd-flex', 'align-items-center' ];
		if ( $args['stretch_content'] ) {
			$css_classes[] = 'justify-content-between';
		}
		$classes = trim( implode( ' ', $css_classes ) );
		if ( $output ) {
			printf( '<div class="%s">%s</div>', $classes, $output );
		}
	}
}

/**
 * Post Excerpt
 */
if ( ! function_exists( 'rovoko_post_excerpt' ) ) {
	function rovoko_post_excerpt( $args = [] ) {
		$args = wp_parse_args( $args, [
			'show_excerpt' => '1',
			'class'        => '',
			'length'       => apply_filters( 'rovoko_excerpt_length', 37 ),
			'more'         => '&hellip;',
			'echo'         => true
		] );
		if ( $args['show_excerpt'] !== '1' ) {
			return;
		}
		$classes      = [ 'ef5-excerpt', $args['class'] ];
		$content      = get_the_excerpt();
		$excerpt_more = apply_filters( 'rovoko_excerpt_more', $args['more'] );
		$excerpt      = wp_trim_words( $content, $args['length'], $excerpt_more );
		if ( $args['echo'] ) {
			?>
            <div class="<?php echo trim( implode( ' ', $classes ) ); ?>">
				<?php printf( '%s', $excerpt ); ?>
            </div>
			<?php
		} else {
			return '<div class="' . trim( implode( ' ', $classes ) ) . '">' . $excerpt . '</div>';
		}
	}
}

/**
 * Post Content
 */
if ( ! function_exists( 'rovoko_post_content' ) ) {
	function rovoko_post_content( $args = [] ) {
		$args    = wp_parse_args( $args, [
			'class' => ''
		] );
		$classes = [
			'ef5-content',
			'ef5-content-' . get_post_type(),
		];
		if ( is_singular() ) {
			$classes[] = 'ef5-single-content';
		}
		$classes[] = 'clearfix';
		?>
        <div class="<?php echo trim( implode( ' ', $classes ) ); ?>">
			<?php the_content(); ?>
        </div>
		<?php
	}
}

/**
 * Loop Pagination
 */
if ( ! function_exists( 'rovoko_loop_pagination' ) ) {
	function rovoko_loop_pagination( $args = [] ) {
		$args = wp_parse_args( $args, [
			'show_pagination' => '1',
			'style'           => rovoko_get_theme_opt( 'archive_nav_type', apply_filters( 'rovoko_loop_pagination', '3' ) ),
			'class'           => ''
		] );
		if ( $args['show_pagination'] !== '1' ) {
			wp_reset_query();

			return;
		}
		$paginate_links = [ 'nav-links', 'layout-' . $args['style'], $args['class'] ];
		printf( '%s', '<div class="ef5-loop-pagination layout-type-' . esc_attr( $args['style'] ) . '">' );
		switch ( $args['style'] ) {
			case '5':
				previous_posts_link(
					apply_filters( 'rovoko_loop_pagination_prev_text', esc_html__( 'Previous', 'rovoko' ) )
				);
				next_posts_link(
					apply_filters( 'rovoko_loop_pagination_next_text', esc_html__( 'Next', 'rovoko' ) )
				);
				break;
			case '4':
				posts_nav_link(
					apply_filters( 'rovoko_loop_pagination_sep_text', '<span class="d-none"></span>' ),
					apply_filters( 'rovoko_loop_pagination_prev_text', esc_html__( 'Previous', 'rovoko' ) ),
					apply_filters( 'rovoko_loop_pagination_next_text', esc_html__( 'Next', 'rovoko' ) )
				);
				break;
			case '3':
				echo '<div class="' . trim( implode( ' ', $paginate_links ) ) . '">';
				echo paginate_links( [
					'prev_text' => '<span class="prev hint--top" data-hint="' . apply_filters( 'rovoko_loop_pagination_prev_text', esc_html__( 'Previous', 'rovoko' ) ) . '"><span class="flaticon-return"></span></span>',
					'next_text' => '<span class="next hint--top" data-hint="' . apply_filters( 'rovoko_loop_pagination_next_text', esc_html__( 'Next', 'rovoko' ) ) . '"><span class="flaticon-next-1"></span></span>'
				] );
				echo '</div>';
				break;
			case '2':
				rovoko_the_posts_pagination( [
					'prev_text' => '<span class="prev hint--top" data-hint="' . apply_filters( 'rovoko_loop_pagination_prev_text', esc_html__( 'Previous', 'rovoko' ) ) . '"><span>' . apply_filters( 'rovoko_loop_pagination_prev_text', esc_html__( 'Previous', 'rovoko' ) ) . '</span></span>',
					'next_text' => '<span class="next hint--top" data-hint="' . apply_filters( 'rovoko_loop_pagination_next_text', esc_html__( 'Next', 'rovoko' ) ) . '"><span>' . apply_filters( 'rovoko_loop_pagination_next_text', esc_html__( 'Next', 'rovoko' ) ) . '</span></span>',
					'class'     => $args['class']
				] );
				break;
			default:
				the_posts_navigation();
				break;
		}
		printf( '%s', '</div>' );
		wp_reset_query();
	}
}

function rovoko_get_the_posts_pagination( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
		// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
		if ( ! empty( $args['screen_reader_text'] ) && empty( $args['aria_label'] ) ) {
			$args['aria_label'] = $args['screen_reader_text'];
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 1,
				'prev_text'          => _x( 'Previous', 'previous set of posts', 'rovoko' ),
				'next_text'          => _x( 'Next', 'next set of posts', 'rovoko' ),
				'screen_reader_text' => esc_html__( 'Posts navigation', 'rovoko' ),
				'aria_label'         => esc_html__( 'Posts', 'rovoko' ),
				'class'              => ''
			)
		);

		// Make sure we get a string back. Plain is the next best thing.
		if ( isset( $args['type'] ) && 'array' == $args['type'] ) {
			$args['type'] = 'plain';
		}

		// Set up paginated links.
		$links = paginate_links( $args );

		if ( $links ) {
			$navigation = _navigation_markup( $links, $args['class'], $args['screen_reader_text'], $args['aria_label'] );
		}
	}

	return $navigation;
}

function rovoko_the_posts_pagination( $args = array() ) {
	echo rovoko_get_the_posts_pagination( $args );
}

add_filter( 'navigation_markup_template', 'rovoko_navigation_markup_template', 10, 2 );
function rovoko_navigation_markup_template( $template, $class ) {
	$template = '
        <nav class="navigation">
            <div class="nav-links %1$s">%3$s</div>
        </nav>
    ';

	return $template;
}

/**
 * Single post Author
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'rovoko_post_author' ) ) {
	function rovoko_post_author( $args = array() ) {
		$args = wp_parse_args( $args, array( 'layout' => '1' ) );
		extract( $args );
		$show_author = rovoko_get_opts( 'post_author_info', '0' );
		if ( '0' === $show_author || empty( get_the_author_meta( 'description' ) ) ) {
			return;
		}
		$user_info = get_userdata( get_the_author_meta( 'ID' ) );
		?>
        <div class="author-box text-center text-md-<?php echo rovoko_align(); ?>">
            <div class="row">
                <div class="author-avatar col-12 col-md-2 col-lg-auto"><?php
					echo get_avatar( get_the_author_meta( 'ID' ), 120 );
					?></div>
                <div class="author-info col">
                    <div class="author-name text-capitalize">
                        <div class="h4"><?php the_author(); ?></div>
                    </div>
                    <div class="author-bio"><?php the_author_meta( 'description' ); ?></div>
					<?php rovoko_user_social( [ 'class' => 'align-self-end w-100' ] ); ?>
                </div>
            </div>
        </div>
		<?php
	}
}

/**
 * Display single post related
 *
 * @since 1.0.0
 */
/**
 * Get custom post type taxonomy TAGS
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'rovoko_get_custom_post_tag_taxonomy' ) ) {
	function rovoko_get_custom_post_tag_taxonomy() {
		$post      = get_post();
		$tax_names = get_object_taxonomies( $post );
		$result    = 'post_tag';
		if ( is_array( $tax_names ) ) {
			foreach ( $tax_names as $name ) {
				if ( strpos( $name, apply_filters( 'rovoko_post_related_by', 'cat' ) ) !== false ) {
					$result = $name;
				}
			}
		}

		return $result;
	}
}
if ( ! function_exists( 'rovoko_post_related' ) ) {
	function rovoko_post_related( $args = array() ) {
		global $post;
		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$args = wp_parse_args( $args, array(
			'title'          => esc_html__( 'Related Posts', 'rovoko' ),
			'posts_per_page' => '6',
			'columns'        => '2',
			'carousel'       => apply_filters( 'rovoko_post_related_carousel', false )
		) );
		extract( $args );

		$show_related = rovoko_get_theme_opt( 'post_related_on', '0' );

		if ( '0' === $show_related ) {
			return;
		}

		if ( $carousel ) {
			$col    = 'item';
			$gal_id = 'ef5-single-post-related';
			$rtl    = is_rtl() ? true : false;
			wp_enqueue_script( 'owl-carousel' );
			wp_enqueue_script( 'ef5-owl-carousel' );
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'ef5-owl-carousel' );
			global $ef5_owl;
			$ef5_owl[ $gal_id ] = [
				'rtl'        => $rtl,
				'margin'     => 30,
				'nav'        => true,
				'navClass'   => [ 'ef5-owl-nav-button ef5-owl-prev', 'ef5-owl-nav-button ef5-owl-next' ],
				'navText'    => [
					'<span class="flaticon-back" data-title="' . esc_attr__( 'Previous', 'rovoko' ) . '"></span>',
					'<span class="flaticon-next" data-title="' . esc_attr__( 'Next', 'rovoko' ) . '"></span>'
				],
				'dots'       => true,
				'dotsData'   => true,
				'items'      => 2,
				'responsive' => array(
					0   => array(
						'items' => 1
					),
					768 => array(
						'items' => 2
					)
				)
			];
			wp_localize_script( 'owl-carousel', 'ef5systems_owl', $ef5_owl );
		} else {
			$col = 'col-md-' . round( 12 / $columns );
		}

		//for use in the loop, list 2 posts related to first tag on current postF
		$tag_tax_name = rovoko_get_custom_post_tag_taxonomy();
		$post         = get_post();
		$tags         = get_the_terms( $post->ID, $tag_tax_name );
		$rtl          = is_rtl() ? true : false;
		if ( $tags && $show_related ) {
			$_tag = array();
			foreach ( $tags as $tag ) {
				$_tag[] = $tag->slug;
			}
			$args          = array(
				'post_type'           => get_post_type(),
				'tax_query'           => array(
					array(
						'taxonomy' => $tag_tax_name,
						'field'    => 'slug',
						'terms'    => $_tag,
					),
				),
				'post__not_in'        => array( $post->ID ),
				'posts_per_page'      => $posts_per_page,
				'ignore_sticky_posts' => 1
			);
			$related_query = new WP_Query( $args );
			if ( $related_query->have_posts() ) {
				echo '<div class="ef5-related">';
				echo '<div class="related-title h2"><span>' . esc_html( $title ) . '</span></div>';
				echo '<div class="ef5-owl-nav"></div>';
				echo '<div class="ef5-owl owl-carousel owl-theme" id="ef5-single-post-related">';
				while ( $related_query->have_posts() ) : $related_query->the_post();
					echo '<div class="ef5-grid-item ' . esc_attr( $col ) . '">';
					get_template_part( 'template-parts/loop/content-related', get_post_format() );
					echo '</div>';
				endwhile;
				echo '</div></div>';
			}
			wp_reset_postdata();
		}
	}
}
/**
 * Single Post Pagination
 */
if ( ! function_exists( 'rovoko_post_navigation' ) ) {
	function rovoko_post_navigation( $args = [] ) {
		$args       = wp_parse_args( $args, [
			'layout' => '1'
		] );
		$navigation = get_the_post_navigation();
		$previous   = get_previous_post_link(
			'<div class="nav-previous">%link</div>',
			'<div class="meta-nav">' . esc_html__( 'Previous Post', 'rovoko' ) . '</div><div class="post-title h4">%title</div>'
		);

		$next      = get_next_post_link(
			'<div class="nav-next">%link</div>',
			'<div class="meta-nav">' . esc_html__( 'Next Post', 'rovoko' ) . '</div><div class="post-title h4">%title</div>'
		);
		$nav_links = [ 'nav-links' ];
		if ( empty( $previous ) ) {
			$nav_links[] = 'justify-content-end';
		}
		if ( is_singular( 'attachment' ) ) {
			// Parent post navigation.
			the_post_navigation(
				array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><br/><span class="post-title">%title</span>', 'Parent post link', 'rovoko' ),
				)
			);
		} elseif ( is_singular( 'post' ) ) {
			// Previous/next post navigation.
			switch ( $args['layout'] ) {
				default:
					?>
                    <nav class="navigation post-navigation">
                        <div class="<?php echo implode( ' ', $nav_links ); ?>">
							<?php echo rovoko_html( $previous . $next ) ?>
                        </div>
                    </nav>
					<?php
					break;
			}
		} elseif ( is_singular( 'ef5_portfolio' ) ) {
			rovoko_portfolio_navigation( $args );
		}
	}
}

/**
 * Single portfolio navigation
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'rovoko_portfolio_navigation' ) ) {
	function rovoko_portfolio_navigation( $args = array() ) {
		$args = wp_parse_args( $args, array( 'layout' => '1' ) );
		extract( $args );
		$prevthumbnail = $nextthumbnail = '';
		$prevPost      = get_previous_post();
		$nextPost      = get_next_post();
		if ( ! $prevPost && ! $nextPost ) {
			return;
		}

		$portfolio_archive_page = rovoko_get_opts( 'portfolio_page', '-1' );

		if ( $portfolio_archive_page === '-1' ) {
			$portfolio_archive_link = get_post_type_archive_link( 'ef5_portfolio' );
		} else {
			$portfolio_archive_link = rovoko_get_link_by_slug( $portfolio_archive_page, 'page' );
		}

		switch ( $layout ) {
			case '2':
				if ( $prevPost ) { ?>
                    <a href="<?php the_permalink( $prevPost->ID ); ?>" class="hint--top"
                       data-hint="<?php echo get_the_title( $prevPost->ID ); ?>"><span
                                class="flaticon-left-arrow-1"></span></a>
				<?php } ?>
                <a href="<?php echo esc_url( $portfolio_archive_link ); ?>" class="archive-link hint--top"
                   data-hint="<?php esc_html_e( 'View All Projects', 'rovoko' ); ?>"><span class="flaticon-menu"></span></a>
				<?php if ( $nextPost ) { ?>
                <a href="<?php the_permalink( $nextPost->ID ); ?>" class="hint--top"
                   data-hint="<?php echo get_the_title( $nextPost->ID ); ?>">
                    <span class="flaticon-right-arrow-1"></span></a>
			<?php }
				break;
			default:
				?>
                <nav class="post-navigation portfolio-navigation">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-2 order-md-2 text-center">
                            <a href="<?php echo esc_url( $portfolio_archive_link ); ?>" class="archive-link"><span
                                        class="fa fa-th-large"></span></a>
                        </div>
                        <div class="nav-box previous col-sm-auto col-md-5 order-md-1 text-<?php echo rovoko_align(); ?>">
							<?php if ( $prevPost ) { ?>
                                <a class="nav-link" href="<?php the_permalink( $prevPost->ID ); ?>">
                                    <div class="meta-nav"><?php esc_html_e( 'Previous Post', 'rovoko' ); ?></div>
                                    <div class="post-title h6"><?php echo get_the_title( $prevPost->ID ); ?></div>
                                </a>
							<?php } ?>
                        </div>
                        <div class="nav-box next col-sm-auto col-md-5 order-md-3 text-<?php echo rovoko_align2(); ?>">
							<?php if ( $nextPost ) { ?>
                                <a class="nav-link" href="<?php the_permalink( $nextPost->ID ); ?>">
                                    <div class="meta-nav"><?php esc_html_e( 'Next Post', 'rovoko' ); ?></div>
                                    <div class="post-title h6"><?php echo get_the_title( $nextPost->ID ); ?></div>
                                </a>
							<?php } ?>
                        </div>
                    </div>
                </nav>
				<?php
				break;
		}
	}
}
/*
 * Before single post content 
 */
function rovoko_single_post_meta_top() {
	$move_title = rovoko_get_opts('post_single_set_title_is_page_title','0');
	if( $move_title == '0'){
		rovoko_post_header( [ 'class' => 'ef5-single-header', 'title_link' => false ] );
	}
	rovoko_post_media();
}

add_action( 'rovoko_before_single_content_post', 'rovoko_single_post_meta_top', 10 );

function rovoko_single_post_category( $args = [] ) {
	$cats_on = ! empty( $args['show_cat'] ) ? $args['show_cat'] : rovoko_get_theme_opt( 'post_categories_on', '1' );
	$args    = wp_parse_args( $args, [
		'show_cat' => $cats_on,
	] );
	if ( $args['show_cat'] && is_single() ) {
		$metas[] = rovoko_posted_in( [ 'show_cat' => $args['show_cat'], 'icon' => '', 'sep' => '', 'echo' => true ] );
	}
}

add_action( 'rovoko_post_media_content', 'rovoko_single_post_category', 10 );
/*
 * Meta post for related post 
 */
if ( ! function_exists( 'rovoko_related_post_meta' ) ) {
	add_action( 'rovoko_after_loop_title', 'rovoko_related_post_meta' );
	function rovoko_related_post_meta( $args = [] ) {
		rovoko_post_meta( [
			'show_author' => false,
			'show_date'   => true,
			'show_cat'    => false,
			'show_cmt'    => true,
			'cmt_text'    => '',
			'show_like'   => true
		] );
	}
}