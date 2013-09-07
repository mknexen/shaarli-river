<?php

define('LOCAL_API', false);
define('SHAARLI_API_URL', 'http://nexen.mkdir.fr/shaarli-river/api/');

class ShaarliApiClient {

	protected function callApi( $filename ) {

		if( LOCAL_API ) {

			$filename = __DIR__ . '/../api/' . $filename . '.json';

		}
		else {

			$filename = SHAARLI_API_URL . $filename . '.json';
		}

		$options = array(
		  'http' => array(
		    'method' => "GET",
		    'header' => "Accept-language: fr\r\n" .
		              "User-Agent: shaarli-api-client\r\n"
		  )
		);

		$context = stream_context_create($options);

		$content = @file_get_contents($filename, false, $context);

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
		return self::callApi('top_today');
	}

	public static function getTopMonth() {
		return self::callApi('top_month');
	}
}