<?php
class WP_ALLSHARE_WIDGETS{
	protected static $instance = null;
	
	public function __construct(){
		add_action( 'widgets_init', array($this,'wpallshare_load_widget') );		
	}

	function wpallshare_load_widget() {
		register_widget( 'ALLSHARE_WIDGETS' );
	}


	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}


class ALLSHARE_WIDGETS extends WP_Widget {
	function __construct() {
		parent::__construct(
			'wpas_widget', 
			__('WP All Share', 'wp_all_share'), 
			array( 'description' => __( 'A widget for adding a social sharing functionality in your site', 'wp_all_share' ), ) 
		);
	}
	
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$template = isset($instance[ 'template' ])?$instance[ 'template' ]:'default';
		$social = isset($instance[ 'social' ])?$instance[ 'social' ]:'facebook,twitter';

		echo $args['before_widget'];
		
		if ( ! empty( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo do_shortcode( "[wp_allshare theme=".$template." networks=".$social." /]" );
		echo $args['after_widget'];
	}
			

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else {
			$title = __( 'Share this post', 'wp_all_share' );
		}

		$template = isset($instance[ 'template' ])?$instance[ 'template' ]:'';
		$str_social = isset($instance[ 'social' ])?$instance[ 'social' ]:'';
		$social = array();
		if(!empty($str_social)){
			$social = explode(',',$str_social);
		}
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'Template:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" >
				<option value="theme1" <?php echo  ( $template == 'theme1')?'selected':''; ?> ><?php _e('Theme 1 (Default)','wp_all_share'); ?></option>
				<option value="theme2" <?php echo ( $template == 'theme2')?'selected':''; ?> ><?php _e('Theme 2','wp_all_share'); ?></option>
				<option value="theme3" <?php echo ( $template == 'theme3')?'selected':''; ?> ><?php _e('Theme 3','wp_all_share'); ?></option>
				<option value="theme4" <?php echo ( $template == 'theme4')?'selected':''; ?> ><?php _e('Theme 4','wp_all_share'); ?></option>
			</select>
		</p>


		<p><label><label for="<?php echo $this->get_field_id( 'social' ); ?>"><?php _e( 'Social Network:' ); ?></label></p>
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'social' ); ?>[]" value="facebook" <?php echo ( !empty($social) && in_array('facebook', $social) )?'checked':''; ?> /> <?php _e('Facebook','wp_all_share') ?></label></p>
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'social' ); ?>[]" value="twitter" <?php echo ( !empty($social) && in_array('twitter', $social) )?'checked':''; ?> /> <?php _e('Twitter','wp_all_share') ?></label></p>
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'social' ); ?>[]" value="linkedin" <?php echo ( !empty($social) && in_array('linkedin', $social) )?'checked':''; ?> /> <?php _e('LinkedIn','wp_all_share') ?></label></p>
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'social' ); ?>[]" value="gplus" <?php echo ( !empty($social) && in_array('gplus', $social) )?'checked':''; ?> /> <?php _e('Google Plus','wp_all_share') ?></label></p>
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'social' ); ?>[]" value="pinterest" <?php echo ( !empty($social) && in_array('pinterest', $social) )?'checked':''; ?> /> <?php _e('Pinterest','wp_all_share') ?></label></p>
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'social' ); ?>[]" value="digg" <?php echo ( !empty($social) && in_array('digg', $social) )?'checked':''; ?> /> <?php _e('Digg','wp_all_share') ?></label></p>
	<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['template'] = ( ! empty( $new_instance['template'] ) ) ? strip_tags( $new_instance['template'] ) : '';
		$social = ( ! empty( $new_instance['social'] ) ) ? $new_instance['social'] : '';
		if(!empty($social)){
			$instance['social'] = implode(',', $social);
		}else{
			$instance['social'] = '';
		}

		return $instance;
	}
}