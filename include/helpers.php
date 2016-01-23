<?php
/*-----------------------------------------------------------------------------------*/
/*	Helpers and utils functions for theme use
/*-----------------------------------------------------------------------------------*/

/* Is one of out theme or plugin? */
function is_featured_item() {
	$post_type = get_post_type();
	if( in_array( $post_type, array( 'wordpress-themes', 'wordpress-plugins' ) ) ) {
		return true;
	}
	else {
		return false;
	}
}

/* Custom function to limit post content words */
if (!function_exists('kkthemes_get_excerpt')):
    function kkthemes_get_excerpt($content)
    {
        $excerpt = '';
        if (has_excerpt()) {
            $excerpt = get_the_excerpt();
        } else {
            $excerpt = strip_tags($content);
            if (!empty($excerpt)) {
                $excerpt = strtok($excerpt, "\n"); //first para

								if(strlen($excerpt) > 155) {
									  $excerpt = preg_replace('/\s+?(\S+)?$/', '', substr($excerpt, 0, 156)) . '…';
								}
            }
        }
        return $excerpt;
    }
endif;

/* Placeholder div */
if (!function_exists('kkthemes_placeholder_img')):
    function kkthemes_placeholder_img()
    {
        $image = '<span class="tm-placeholder-img uk-float-left uk-margin-right"><i class="uk-icon-circle-thin uk-icon-large"></i></span>';
        $name = beans_output( 'beans_site_title_text', get_bloginfo( 'name' ) );
        if ( $logo = get_theme_mod( 'beans_logo_image', false ) )
      		$image = beans_selfclose_markup( 'beans_post_logo_image', 'img', array(
      			'class' => 'tm-post-widget-img uk-border-rounded uk-float-left',
      			'src' => esc_url( $logo ),
      			'alt' => esc_attr( $name ),
      		) );
        return $image;
    }
endif;

/* Custom function to get meta data for specific layout */
if (!function_exists('kkthemes_get_meta_data')):
    function kkthemes_get_meta_data($force_meta = false)
    {
        $output = '';
        //Check for sticky
        if (is_sticky()) {
            $output = $output .= '<div class="meta-item"><i class="fa fa-thumb-tack"></i>' . __('Sticky', 'kkthemes') . '</div>';
        }
        //Check meta options
        if (!$force_meta) {
            if (is_single()) {
                $metas = kkthemes_get_option('single_meta');
            } else {
                $metas = kkthemes_get_option('meta');
            }
        } else {
            $metas = array(
                $force_meta
            );
        }
        if (!empty($metas)) {
            foreach ($metas as $meta_id) {
                $meta = '';
                switch ($meta_id) {
                    case 'date':
                        $meta = '<i class="fa fa-calendar"></i><span class="updated">' . get_the_date() . '</span>';
                        break;
                    case 'author':
                        $author_id = get_post_field('post_author', get_the_ID());
                        $meta      = '<i class="fa fa-user"></i><span class="vcard author"><span class="fn">' . __('by', 'kkthemes') . ' <a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID', $author_id))) . '">' . get_the_author_meta('display_name', $author_id) . '</a></span></span>';
                        break;
                    case 'rtime':
                        $meta = kkthemes_read_time(get_post_field('post_content', get_the_ID()));
                        if (!empty($meta)) {
                            $meta = '<i class="fa fa-clock-o"></i>' . $meta . ' ' . __('min read', 'kkthemes');
                        }
                        break;
                    case 'comments':
                        if (comments_open() || get_comments_number()) {
                            ob_start();
                            comments_popup_link(__('Add Comment', 'kkthemes'), __('1 Comment', 'kkthemes'), __('% Comments', 'kkthemes'));
                            $meta = '<i class="fa fa-comments-o"></i>' . ob_get_contents();
                            ob_end_clean();
                        } else {
                            $meta = '';
                        }
                        break;
                    default:
                        break;
                }
                if (!empty($meta)) {
                    $output .= '<div class="meta-item">' . $meta . '</div>';
                }
            }
        }
        return $output;
    }
endif;


/* 	Calculate reading time by content length */
if ( !function_exists( 'kkthemes_read_time' ) ):
	function kkthemes_read_time( $text ) {
		$words = str_word_count( strip_tags( $text ) );
		if ( !empty( $words ) ) {
			$time_in_minutes = ceil( $words / 200 );
			return $time_in_minutes;
		}
		return false;
	}
endif;
