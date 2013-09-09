<?php 

require_once __DIR__ . '/bootstrap.php';

if( isset($_GET['url']) && !empty($_GET['url']) ) {

	$url = $_GET['url'];

	$entries = ShaarliApiClient::callApi('discussion?url=' . urlencode($url));

	if( !empty($entries) ) {

		foreach( $entries as $entry ) {

			include __DIR__ . '/includes/entry.php';
		}
	}
}
