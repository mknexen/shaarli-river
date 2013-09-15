<?php

/**
 * ShaarliApiClient
 */
class ShaarliApiClient {

	/**
	 * Call API
	 * @param string action
	 */
	public function callApi( $action ) {

		$localApi = false;

		if( $localApi && $action == 'latest' ) {

			$action = __DIR__ . '/../cache/latest.json';
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
		return self::callApi('latest?limit=30');
	}

	public static function getTopToday() {
		return self::callApi('top?interval=48h');
	}

	public static function getTopMonth() {
		return self::callApi('top?interval=1month');
	}
}
