<?php

namespace li3_resources\extensions\commands\create;

class Resource extends \lithium\console\command\create\Controller {

	protected function _parent($request) {
		return '\li3_resources\action\Resource';
	}
}

?>