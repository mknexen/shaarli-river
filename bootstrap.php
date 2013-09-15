<?php

/**
 * Shaarli Flux River
 * @version 1.1 beta
 * @author: nexen (nexen@dukgo.com, nexen@irc.freenode.net#debian, https://nexen.mkdir.fr/shaarli)
 */

// Shaarli API url
// You can host your own API, see: https://github.com/mknexen/shaarli-api
define('SHAARLI_RIVER_URL', 'https://nexen.mkdir.fr/shaarli-river/');
define('SHAARLI_API_URL', 'https://nexen.mkdir.fr/shaarli-api/');



require_once __DIR__ . '/includes/ShaarliApiClient.php';

function get_favicon_url( $feed_id ) {

	if( $feed_id > 0 ) {

		return SHAARLI_API_URL . 'getfavicon?id=' . $feed_id;
	}
}