<?php
/**
 * li3_resources: Friendly resource definitions for Lithium.
 *
 * @copyright     Copyright 2012, Union of RAD, LLC (http://union-of-rad.com)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace li3_resources\action;

use lithium\core\Libraries;
use lithium\util\Inflector;

/**
 * The `Resource` class allows you to define a REST-oriented resource 
 */
abstract class Resource extends \lithium\core\Object {

	protected $_binding;

	protected $_requestBinding;

	protected $_methods = array(
		'GET'    => array('view'   => 'id', 'index' => null),
		'POST'   => array('edit'   => 'id', 'add'   => null),
		'PUT'    => array('edit'   => 'id'),
		'PATCH'  => array('edit'   => 'id'),
		'DELETE' => array('delete' => 'id')
	);

	public function index($resources) {
		
	}

	public function add($resource) {
		
	}

	public function view($resource) {
		
	}

	public function edit($resource) {
		
	}

	public function delete($resource) {
		
	}

	protected function _binding() {
		if ($this->_binding) {
			return $this->_binding;
		}
		return ($this->_binding = Libraries::locate('resource', $this->_name()));
	}

	protected function _name() {
		return basename(str_replace('\\', '/', get_class($this)));
	}

	protected function _request() {
		$call = $this->_requestBinding;
		return $call();
	}

	protected function _method($request) {
		if ($request->action) {
			$methods = array_diff(get_class_methods($this), get_class_methods(__CLASS__));

			if (!in_array($request->action, $methods) || strpos($request->action, '_') === 0) {
				throw new BadRequestException();
			}
			return $request->action;
		}

		if (!isset($this->_methods[$request->method])) {
			throw new BadRequestException();
		}

		foreach ($this->_methods[$request->method] as $action => $params) {
			$params = (array) $params;

			if (array_intersect($params, array_keys($request->params)) !== $params) {
				continue;
			}
			return $action;
		}
		throw new BadRequestException();
	}

	public function __invoke($request) {
		$this->_requestBinding = function() use (&$request) {
			return $request;
		};
		$method = $this->_method($request);
	}
}

?>