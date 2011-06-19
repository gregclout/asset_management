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
	
	function search() {
		$keywords = $_GET['keywords'];
		$this->Item->recursive = 0;
		$results = array();
		
		if (!empty($keywords)) {
			
			$this->loadModel('Field');
			$search_items = $this->Field->find('all', array('order' => array('Item.name ASC')));
			$keywords = explode(' ', $keywords);
			
			$results = array();
			foreach($keywords as $keyword) {
				foreach ($search_items as $item_key => $item) {
					if (!empty($item['Item']['id'])) {
						foreach($item['Field'] as $field) {
							// if the keyword is in the field
							if (strpos(strtolower($field), strtolower($keyword)) !== false) {
								if (!isset($results[$item['Item']['id']])) {
									$results[$item['Item']['id']]['id'] = $item['Item']['id'];
									$results[$item['Item']['id']]['name'] = $item['Item']['name'];
									$results[$item['Item']['id']]['count'] = 1;
								} else {
									$results[$item['Item']['id']]['count'] = $results[$item['Item']['id']]['count']+1;
								}
							}
						}
						foreach ($item['Item'] as $field) {
						// if the keyword is in the item
							if (strpos(strtolower($field), strtolower($keyword)) !== false) {
								if (!isset($results[$item['Item']['id']])) {
									$results[$item['Item']['id']]['id'] = $item['Item']['id'];
									$results[$item['Item']['id']]['name'] = $item['Item']['name'];
									$results[$item['Item']['id']]['count'] = 1;
								} else {
									$results[$item['Item']['id']]['count'] = $results[$item['Item']['id']]['count']+1;
								}
							}
						}
					}
				}
			}
			
			// Comparison function
			function cmp($a, $b) {
			    if ($a['count'] == $b['count']) {
			    	if (strcmp($a['name'], $b['name']) > 0) {
			    		return 1;
			    	}
			    	else if (strcmp($a['name'], $b['name']) < 0) {
			    		return -1;
			    	}
			    	else if (strcmp($a['name'], $b['name']) == 0) {
			        	return 0;
			        }
			    }
			    else if ($a['count'] < $b['count']) {
			    	return 1;
			    }
			    else {
			    	return -1;
			    }
			}
			
			uasort($results, 'cmp');
		}
		$this->set('items', $results);
	}

	function add() {
		if (!empty($this->data)) {
			unset($this->Item->Field->validate['item_id']);
			unset($this->Item->Relatedfile->validate['item_id']);
			
			foreach ($this->data['Relatedfile'] as $related_key => $file) {
				$fileOK = $this->uploadFile('img/files', $file['file_url']);
				debug($fileOK);
				if (!empty($fileOK['url'][0])) {
					$this->data['Relatedfile'][$related_key]['file_url'] = $fileOK['url'][0];
					$this->data['Relatedfile'][$related_key]['thumb_file_url'] = $fileOK['url'][0];
				}
			}
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
