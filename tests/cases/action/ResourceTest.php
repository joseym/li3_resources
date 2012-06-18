<?php
/**
 * li3_resources: Friendly resource definitions for Lithium.
 *
 * @copyright     Copyright 2012, Union of RAD, LLC (http://union-of-rad.com)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_resources\tests\cases\action;

use lithium\action\Request;
use li3_resources\tests\mocks\MockResource;

class ResourceTest extends \lithium\test\Unit {

	public function testHttpMethodMapping() {
		$resource = new MockResource();

		$map = array(
			array('action' => 'view', 'method' => 'GET', 'params' => array('id' => 1)),
			array('action' => 'index', 'method' => 'GET', 'params' => array()),
			array('action' => 'add', 'method' => 'POST', 'params' => array()),
			array('action' => 'edit', 'method' => 'POST', 'params' => array('id' => 1))
		);

		foreach ($map as $request) {
			$result = $resource(new Request(array(
				'env' => array('REQUEST_METHOD' => $request['method']),
				'params' => $request['params']
			)));
			$this->assertEqual($request['action'], $result);
		}

		$result = $resource(new Request(array(
			'env' => array('REQUEST_METHOD' => 'GET'),
			'params' => array('action' => 'arbitrary')
		)));
		$this->assertEqual('arbitrary', $result);
	}
}

?>