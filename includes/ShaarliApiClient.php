<?php

define('LOCAL_API', false);
define('SHAARLI_API_URL', 'http://nexen.mkdir.fr/shaarli-api/');

class ShaarliApiClient {

	/**
	 * Call API
	 * @param string action
	 */
	protected function callApi( $action ) {

		if( LOCAL_API ) {

			$action = __DIR__ . '/../api/' . $action;

		}
		else {

			$action = SHAARLI_API_URL . $action;
		}

		$options = array(
		  'http' => array(
		    'method' => "GET",
		    'header' => "Accept-language: fr\r\n" .
		              "User-Agent: shaarli-api-client\r\n"
		  )
		);

		$context = stream_context_create($options);

		$content = @file_get_contents($action, false, $context);

		if( !empty($content) ) {

			$content = json_decode($content);

			return $content;		
		}
		else {
			die('Unable to call API');
		}
	}

	public static function getLatest() {
		return self::callApi('latest');
	}

	public static function getTopToday() {
		return self::callApi('top?interval=48h');
	}

	public static function getTopMonth() {
		return self::callApi('top?interval=1month');
	}
}