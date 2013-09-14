<?php

/**
 * Create RSS Feed
 * @param entries
 * @param config
 */
function create_rss( $entries, $config ) {

	// Inspired from http://www.phpntips.com/xmlwriter-2009-06/
	$xml = new XMLWriter();

	// Output directly to the user
	$xml->openURI('php://output');
	$xml->startDocument('1.0');
	$xml->setIndent(2);
	//rss
	$xml->startElement('rss');
	$xml->writeAttribute('version', '2.0');
	$xml->writeAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');

	//channel
	$xml->startElement('channel');

	// title, desc, link, date
	$xml->writeElement('title', $config['title']);
	// $xml->writeElement('description', $config['description']);
	// $xml->writeElement('link', 'http://www.example.com/rss.hml');
	$xml->writeElement('pubDate', date('r'));

	if( !empty($entries) ) {

		foreach( $entries as $entry ) {

			// item
			$xml->startElement('item');
			$xml->writeElement('title', $entry->title);

			if( isset($entry->permalink) )
				$xml->writeElement('link', $entry->permalink);

			$xml->startElement('description');
			$xml->writeCData($entry->content);
			$xml->endElement();
			$xml->writeElement('pubDate', date('r', strtotime($entry->date)));

			// category
			// $xml->startElement('category');
			// $xml->writeAttribute('domain', 'http://www.example.com/cat1.htm');
			// $xml->text('News');
			// $xml->endElement();

			// end item
			$xml->endElement();
		}	
	}

	// end channel
	$xml->endElement();

	// end rss
	$xml->endElement();

	// end doc
	$xml->endDocument();

	// flush
	$xml->flush();
}