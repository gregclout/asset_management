<?php
class RelatedfilesController extends AppController {

	var $name = 'Relatedfiles';

	function index() {
		$this->Relatedfile->recursive = 0;
		$this->set('Relatedfiles', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Relatedfile', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Relatedfile', $this->Relatedfile->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Relatedfile->create();
			if ($this->Relatedfile->save($this->data)) {
				$this->Session->setFlash(__('The Relatedfile has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Relatedfile could not be saved. Please, try again.', true));
			}
		}
		$items = $this->Relatedfile->Item->find('list');
		$this->set(compact('items'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Relatedfile', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Relatedfile->save($this->data)) {
				$this->Session->setFlash(__('The Relatedfile has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Relatedfile could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Relatedfile->read(null, $id);
		}
		$items = $this->Relatedfile->Item->find('list');
		$this->set(compact('items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Relatedfile', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Relatedfile->delete($id)) {
			$this->Session->setFlash(__('Relatedfile deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Relatedfile was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
