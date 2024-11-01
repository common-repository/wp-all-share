<?php
class WP_ALLSHARE{
	protected static $instance = null;
	
	public function __construct(){
		
	}

	public function get_share_count($network,$url){
		$count = 0;
		switch($network){
			case 'facebook':
				$response = wp_remote_get('https://api.facebook.com/method/links.getStats?urls=' . $url . '&format=json');
				if( isset($response) && !isset($response->errors) ){
					$response_data = json_decode($response['body'],true);
					$count = isset( $response_data[0]['total_count'] ) ? intval( $response_data[0]['total_count'] ) : 0;
				}
			break;

			case 'twitter':
				/* No share count for twitter */
				$count = 0;
			break;

			case 'linkedin':
				$response = wp_remote_get('http://www.linkedin.com/countserv/count/share?url='.$url.'&format=json');
				if( isset($response) && !isset($response->errors) ){
					$response_data = json_decode($response['body']);
					$count = isset($response_data->count)?$response_data->count:0;
				}
			break;

			case 'gplus':
				$args = array(
				    'method'    => 'POST',
				    'body'      => '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]',
				    'headers' => array('Content-Type' => 'application/json')
				);
				$response = wp_remote_request('https://clients6.google.com/rpc', $args );
				if( isset($response) && !isset($response->errors) ){
					$response_data = json_decode($response['body'],true);
					$count = isset( $response_data[0]['result']['metadata']['globalCounts']['count'] ) ? intval( $response_data[0]['result']['metadata']['globalCounts']['count'] ) : 0;
					
				}
			break;

			case 'digg':
				/* No share count for digg */
				$count = 0;
			break;

			case 'pinterest':
				$response = wp_remote_get('http://widgets.pinterest.com/v1/urls/count.json?source=6&url='.$url);
				if( isset($response) && !isset($response->errors) ){
					$json_string 	= $response['body'];
					$json_string	= preg_replace( '/^receiveCount\((.*)\)$/', "\\1", $json_string );
					$response_data  = json_decode( $json_string );
					$count = isset($response_data->count)?$response_data->count:0;
				}	
			break;

			default:
				$count = 0;
		}

		return $count;
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}