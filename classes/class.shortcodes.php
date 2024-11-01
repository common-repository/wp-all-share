<?php
class WP_ALLSHARE_SHORTCODES{
	protected static $instance = null;
	
	public function __construct(){
		add_shortcode('wp_allshare', array($this,'social_shortcode') );
	}

	function social_shortcode($atts, $content){
		
		$atts = shortcode_atts( array(
			'theme'=>'default',
			'networks' => 'facebook,twitter,gplus,linkedin,digg,pinterest,email'
		), $atts, 'wp_allshare' );
		
		$output = $this->get_template($atts['theme'],$atts['networks']);
		return $output;
	}

	private function get_template($template='default',$networks = 'facebook,linkedin' ){
		$output = '';
		
		$url = get_permalink();
		$title = get_the_title();
		$count = array();
		$post_thumbnail = 'https://placehold.it/800x400/000000/ffffff?text=No%20Image';
		$description = strip_tags(get_the_excerpt());

		if(has_post_thumbnail()){
			$post_thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );
		}
		
		$wp_all_share = WP_ALLSHARE::get_instance();
		
		if($url):
			$wrapper_class = 'wpallshare';
			$inner_wrapper = '<ul>';

			$all_nw_array = explode(',',$networks);
			$all_nw = array_fill_keys($all_nw_array, true);

			$count = array_fill_keys($all_nw_array, 0);			

			foreach($count as $key => $value){
				$count[$key] = $wp_all_share->get_share_count($key,$url);
			}
			
			wp_enqueue_script('wpallshare-trigger');

			$mail = "mailto:?subject=Hey look at it&amp;body=Check out this site ".$url;

			switch($template){
				case 'theme4':
					wp_enqueue_style('wpallshare-theme4');

					$wrapper_class .=' wpallshare-theme4';
					if(isset($all_nw['facebook'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" alt="social button"></a><div class="tooltip"><span class="sharetitle">SHARE</span> <span class="count">'.$count['facebook'].'</span></div></li>';
					}if(isset($all_nw['twitter'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-twitter" href="https://twitter.com/home?status='.$url.'" alt="social button"></a>
						<div class="tooltip"><span class="sharetitle">TWEET</span></div></li>';
					}if(isset($all_nw['gplus'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-google-plus" href="https://plus.google.com/share?url='.$url.'" alt="social button"></a>
						<div class="tooltip"><span class="sharetitle">SHARE</span> <span class="count">'.$count['gplus'].'</span></div>
						</li>';
					}if(isset($all_nw['linkedin'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title.'" alt="social button"></a>
						<div class="tooltip"><span class="sharetitle">SHARE</span> <span class="count">'.$count['linkedin'].'</span></div>
						</li>';
					}if(isset($all_nw['digg'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-digg" href="https://digg.com/submit?url='.$url.'&title='.$title.'" alt="social button"> </a>
						<div class="tooltip"><span class="sharetitle">SHARE</span></div></li>';
					}if(isset($all_nw['pinterest'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-pinterest" href="https://pinterest.com/pin/create/button/?url='.$url.'&media='.$post_thumbnail.'&description='.$description.'" alt="social button"></a>
						<div class="tooltip"><span class="sharetitle">SHARE</span> <span class="count">'.$count['pinterest'].'</span></div>
						</li>';
					}
					if(isset($all_nw['email'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-mail" href="'.$mail.'" alt="social button"></a>
						<div class="tooltip"><span class="sharetitle">Email</span></div>
						</li>';
					}	
				break;

				case 'theme3':
					wp_enqueue_style('wpallshare-theme3');

					$wrapper_class .=' wpallshare-theme3';
					if( isset($all_nw['facebook'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['facebook'].'</span> </a></li>';
					}if(isset($all_nw['twitter'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-twitter" href="https://twitter.com/home?status='.$url.'" alt="social button"> <span class="sharetitle">TWEET</span></a></li>';
					}if(isset($all_nw['gplus'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-google-plus" href="https://plus.google.com/share?url='.$url.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['gplus'].'</span> </a></li>';
					}if(isset($all_nw['linkedin'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['linkedin'].'</span> </a></li>';
					}if(isset($all_nw['digg'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-digg" href="https://digg.com/submit?url='.$url.'&title='.$title.'" alt="social button"> <span class="sharetitle">SHARE</span></a></li>';
					}if(isset($all_nw['pinterest'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-pinterest" href="https://pinterest.com/pin/create/button/?url='.$url.'&media='.$post_thumbnail.'&description='.$description.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['pinterest'].'</span> </a></li>';
					}
					if(isset($all_nw['email'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-mail" href="'.$mail.'" alt="social button"><span class="sharetitle">Email</span></a></li>';
					}	
				break;

				case 'theme2':
					wp_enqueue_style('wpallshare-theme2');

					$wrapper_class .=' wpallshare-theme2';
					if(isset($all_nw['facebook'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['facebook'].'</span> </a></li>';
					}if(isset($all_nw['twitter'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-twitter" href="https://twitter.com/home?status='.$url.'" alt="social button"> <span class="sharetitle">TWEET</span></a></li>';
					}if(isset($all_nw['gplus'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-google-plus" href="https://plus.google.com/share?url='.$url.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['gplus'].'</span> </a></li>';
					}if(isset($all_nw['linkedin'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['linkedin'].'</span> </a></li>';
					}if(isset($all_nw['digg'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-digg" href="https://digg.com/submit?url='.$url.'&title='.$title.'" alt="social button"> <span class="sharetitle">SHARE</span></a></li>';
					}if(isset($all_nw['pinterest'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-pinterest" href="https://pinterest.com/pin/create/button/?url='.$url.'&media='.$post_thumbnail.'&description='.$description.'" alt="social button"> <span class="sharetitle">SHARE</span> <span class="count">'.$count['pinterest'].'</span> </a></li>';
					}
					if(isset($all_nw['email'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-mail" href="'.$mail.'" alt="social button"><span class="sharetitle">Email</span></a></li>';
					}

				break;
				case 'theme1':				
				default:
					wp_enqueue_style('wpallshare-theme1');

					$wrapper_class .=' wpallshare-theme1';
					if(isset($all_nw['facebook'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-facebook" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" alt="social button"> <span class="count">'.$count['facebook'].'</span> <span class="sharetitle">SHARE</span></a></li>';
					}if(isset($all_nw['twitter'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-twitter" href="https://twitter.com/home?status='.$url.'" alt="social button"><span class="sharetitle">TWEET</span></a></li>';
					}if(isset($all_nw['gplus'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-google-plus" href="https://plus.google.com/share?url='.$url.'" alt="social button"> <span class="count">'.$count['gplus'].'</span> <span class="sharetitle">SHARE</span></a></li>';
					}if(isset($all_nw['linkedin'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title.'" alt="social button"> <span class="count">'.$count['linkedin'].'</span> <span class="sharetitle">SHARE</span></a></li>';
					}if(isset($all_nw['digg'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-digg" href="https://digg.com/submit?url='.$url.'&title='.$title.'" alt="social button"><span class="sharetitle">SHARE</span>  </a></li>';
					}if(isset($all_nw['pinterest'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-pinterest" href="https://pinterest.com/pin/create/button/?url='.$url.'&media='.$post_thumbnail.'&description='.$description.'" alt="social button"> <span class="count">'.$count['pinterest'].'</span> <span class="sharetitle">SHARE</span></a></li>';
					}
					if(isset($all_nw['email'])){
						$inner_wrapper .='<li><a class="wpas-social wpas-mail" href="'.$mail.'" alt="social button"><span class="sharetitle">Email</span></a></li>';
					}			
			}
			$inner_wrapper .= '</ul>';
			
			$output .= '<div class="'.$wrapper_class.'">'.$inner_wrapper.'</div>';
		endif;
		
		unset($all_nw_array);
		
		return $output;
	}


	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}