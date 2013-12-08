<?php

/**
 * Shaarli Flux River
 * @version 1.1 beta
 * @author: nexen (nexen@dukgo.com, nexen@irc.freenode.net#debian, https://nexen.mkdir.fr/shaarli)
 */

/**
 * DO NOT TOUCH AFTER THIS LINE
 */
require_once __DIR__ . '/includes/ShaarliApiClient.php';
require_once __DIR__ . '/config.php';

function get_favicon_url( $feed_id ) {

	if( $feed_id > 0 ) {

		return SHAARLI_API_URL . 'getfavicon?id=' . $feed_id;
	}
}
