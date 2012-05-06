namespace {:namespace};

use lithium\action\DispatchException;

class {:class} extends {:parent} {

	// public function index(${:plural}) {
	// 	return compact('{:plural}');
	// }

	// public function view(${:singular}) {
	// 	return compact('{:singular}');
	// }

	public function add(${:singular}) {
		if (($this->request->data) && ${:singular}->save($this->request->data)) {
			return $this->redirect(array('{:name}::view', 'args' => array(${:singular}->id)));
		}
		return compact('{:singular}');
	}

	public function edit() {
		${:singular} = {:model}::find($this->request->id);

		if (!${:singular}) {
			return $this->redirect('{:name}::index');
		}
		if (($this->request->data) && ${:singular}->save($this->request->data)) {
			return $this->redirect(array('{:name}::view', 'args' => array(${:singular}->id)));
		}
		return compact('{:singular}');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "{:name}::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		{:model}::find($this->request->id)->delete();
		return $this->redirect('{:name}::index');
	}
}