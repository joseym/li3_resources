<?php

namespace li3_resources\tests\mocks;

class MockResource extends \li3_resources\action\Resource {

	public function __invoke($request) {
		return $this->_method($request);
	}

	public function arbitrary() {}
}

?>