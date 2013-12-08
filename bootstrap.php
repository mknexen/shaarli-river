<?php

$configFile = __DIR__.'/config.php';

if( !file_exists('config.php') )
	exit('Please setup your config.php');

require_once __DIR__ . '/includes/ShaarliApiClient.php';
require_once $configFile;

function get_favicon_url( $feed_id ) {

	if( $feed_id > 0 ) {

		return SHAARLI_API_URL . 'getfavicon?id=' . $feed_id;
	}
}
