<?php

namespace BartoszFabianski\Exceptions;

use Exception;

class EmptyFeedException extends Exception {

	public function __construct($message = null) {
		$message = $message ?: 'Returned empty feed or given URL is invalid.';
		parent::__construct($message);
	}
}