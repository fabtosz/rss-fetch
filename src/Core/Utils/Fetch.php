<?php 

namespace BartoszFabianski\Core\Utils;

use DOMDocument;
use DateTime;
use BartoszFabianski\Exceptions\EmptyFeedExceptions;

class Fetch {

	public static function fetch(string $url) : array {

		$rss = new DOMDocument();
		$rss->load($url);

		$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {
			$item = array ( 
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'desc' => html_entity_decode($node->getElementsByTagName('description')->item(0)->nodeValue),
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				//'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
			);
			//pubDate
			$dateString = $node->getElementsByTagName('pubDate')->item(0)->nodeValue;
			$item['pubDate'] = Fetch::formatDate($dateString);
			//creator
			$content = $node->getElementsByTagName('creator');
			if ($content->length > 0) {
            	$item['creator'] = $content->item(0)->nodeValue;
        	}
			array_push($feed, $item);
		}

		return $feed;
	} 

	private static function formatDate(string $dateString) : string {
		$date = DateTime::createFromFormat('D, d M Y H:i:s e', $dateString);
		$pubDate = $date->format('Y-m-d H:i:s');
		return $pubDate;
	}
}