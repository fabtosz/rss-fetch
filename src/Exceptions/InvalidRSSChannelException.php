<?php

namespace BartoszFabianski\Exceptions;

use Exception;

class InvalidRSSChannelException extends Exception {

	public function __construct($message = null) {
		$message = $message ?: 'Given RSS channel URL is invalid.';
		parent::__construct($message);
	}
}