<?php 

namespace BartoszFabianski\Core\Utils;

use DOMDocument;
use DateTime;
use BartoszFabianski\Exceptions\InvalidRSSChannelException;

class Fetch {

	public static function fetch(string $url) : array {

		$rss = new DOMDocument();

		if (!@$rss->load($url)) {
			throw new InvalidRSSChannelException('Given RSS channel URL is invalid.');
		}

		$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {

			$item = array();

			//title
			$title = $node->getElementsByTagName('title')->item(0)->nodeValue;
			$item['title'] = $title;
			//description
			$description = $node->getElementsByTagName('description')->item(0)->nodeValue;
			$item['description'] = self::parseDescription($description);
			//link
			$link = $node->getElementsByTagName('link')->item(0)->nodeValue;
			$item['link'] = $node->getElementsByTagName('link')->item(0)->nodeValue;
			//pubDate
			$dateString = $node->getElementsByTagName('pubDate')->item(0)->nodeValue;
			$item['pubDate'] = self::formatDate($dateString);
			//creator
			$creator = $node->getElementsByTagName('creator');
			if ($creator->length > 0) {
            	$item['creator'] = $creator->item(0)->nodeValue;
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

	private static function parseDescription(string $contentToParse) : string {
		//delete html tags from node string content
		$pattern = '@\<.*?\>@';
		$description = preg_replace($pattern, '', $contentToParse);
		return $description;
	}
}