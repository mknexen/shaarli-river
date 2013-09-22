<?php

/**
 * ShaarliApiClient
 */
class ShaarliApiClient {

	public $url = null;

	/** 
	 * Constructor
	 */
	public function __construct( $url ) {

		$this->url = $url;
	}

	/**
	 * Call API
	 * @param string action
	 * @param array arguments
	 */
	public function callApi( $action, $arguments = null ) {

		$url = rtrim($this->url, '/') . '/' . $action;

		if( $arguments != null && !empty($arguments) ) {

			$url .= ('?' . http_build_query($arguments) );
		}

		$options = array(
		  'http' => array(
		    'method' => "GET",
		    'header' => "Accept-language: fr\r\n" .
		              "User-Agent: shaarli-api-client\r\n"
		  )
		);

		$context = stream_context_create($options);

		$content = @file_get_contents($url, false, $context);

		if( !empty($content) ) {

			$content = json_decode($content);

			return $content;		
		}
		else {

			throw new Exception('Unable to call API');
		}
	}

	/**
	 * feeds
	 * La liste des shaarlis
	 */
	public function feeds( $arguments = null ) {
		return $this->callApi('feeds', $arguments);
	}

	/**
	 * latest
	 * Les derniers billets
	 */
	public function latest( $arguments = null ) {
		return $this->callApi('latest', $arguments);
	}
	/**
	 * top
	 * Les liens les plus partagés
	 */
	public function top( $arguments = null ) {
		return $this->callApi('top', $arguments);
	}

	/**
	 * search
	 * Rechercher dans les billets
	 */
	public function search( $term, $arguments = array() ) {

		$arguments['q'] = $term;

		return $this->callApi('search', $arguments);
	}

	/**
	 * discussion
	 * Rechercher une discussion
	 */
	public function discussion( $url, $arguments = array() ) {

		$arguments['url'] = $url;

		return $this->callApi('discussion', $arguments);
	}
}
