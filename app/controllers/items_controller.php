<?php
class ItemsController extends AppController {

	var $name = 'Items';
	var $helpers = array('Javascript' => array('jquery'));

	function index() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			unset($this->Item->Field->validate['item_id']);
			if ($this->Item->saveAll($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		
		$this->loadModel('Template');
		$results = $this->Template->find('all');
		
		$templates = array();
		$templateselect = array();
		foreach($results as $template_key => $template) {
			$templates[$template_key]['id'] = $template['Template']['id'];
			$templates[$template_key]['name'] = $template['Template']['name'];
			$templateselect[$template_key] = $template['Template']['name'];
			$fields = explode(',', $template['Template']['fields']);
			foreach ($fields as $field_key => $field) {
				$field_values = explode(':', $field);
				$templates[$template_key]['fields'][$field_key] = $field_values;
			}
		}
		
		
		
		$this->set('templateselect', $templateselect);
		
		$this->set('templates', $templates);
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Item->saveAll($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Item->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Item->delete($id)) {
			$this->Session->setFlash(__('Item deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Item was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
