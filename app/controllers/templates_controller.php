<?php
class TemplatesController extends AppController {

	var $name = 'Templates';

	function index() {
		$this->Template->recursive = 0;
		$this->set('templates', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid template', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('template', $this->Template->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Template->create();
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(__('The template has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid template', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(__('The template has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Template->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for template', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Template->delete($id)) {
			$this->Session->setFlash(__('Template deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Template was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
