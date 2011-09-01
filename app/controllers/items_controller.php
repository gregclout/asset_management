<?php
class ItemsController extends AppController {

	var $name = 'Items';
	var $helpers = array('Javascript' => array('jquery'), 'html');

	function index() {
		$this->Item->recursive = 0;
		$this->paginate = array('order' => 'Item.name ASC');
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
			$search_items_fields = $this->Field->find('all', array('order' => array('Item.name ASC')));
			$this->loadModel('Relatedfile');
			$search_items_files = $this->Relatedfile->find('all', array('order' => array('Item.name ASC')));
			$items = $this->Item->find('all', array('order' => array('Item.name ASC')));
			//debug($items);
			$keywords = explode(' ', $keywords);
			
			$results = array();
			foreach($keywords as $keyword) {
				foreach ($items as $item_items) {
					foreach ($item_items['Item'] as $item) {
						// if the keyword is in the item
						if (strpos(strtolower($item), strtolower($keyword)) !== false) {
							if (!isset($results[$item_items['Item']['id']])) {
								$results[$item_items['Item']['id']]['id'] = $item_items['Item']['id'];
								$results[$item_items['Item']['id']]['name'] = $item_items['Item']['name'];
								$results[$item_items['Item']['id']]['count'] = 1;
							} else {
								$results[$item_items['Item']['id']]['count'] = $results[$item_items['Item']['id']]['count']+1;
							}
						}
					}
				}
				foreach ($search_items_fields as $search_item) {
					if (!empty($search_item['Item']['id'])) {
						foreach($search_item['Field'] as $item_key => $field) {
							// dont count field id or item id
							if ($item_key != 'id' && $item_key != 'item_id') {
								// if the keyword is in the field
								if (strpos(strtolower($field), strtolower($keyword)) !== false) {
									if (!isset($results[$search_item['Item']['id']])) {
										$results[$search_item['Item']['id']]['id'] = $search_item['Item']['id'];
										$results[$search_item['Item']['id']]['name'] = $search_item['Item']['name'];
										$results[$search_item['Item']['id']]['count'] = 1;
									} else {
										$results[$search_item['Item']['id']]['count'] = $results[$search_item['Item']['id']]['count']+1;
									}
								}
							}
						}
					}
				}
				foreach ($search_items_files as $files_item) {
					if (!empty($files_item['Item']['id'])) {
						// if the keyword is in the file description
						if (strpos(strtolower($files_item['Relatedfile']['description']), strtolower($keyword)) !== false) {
							if (!isset($results[$files_item['Item']['id']])) {
								$results[$files_item['Item']['id']]['id'] = $files_item['Item']['id'];
								$results[$files_item['Item']['id']]['name'] = $files_item['Item']['name'];
								$results[$files_item['Item']['id']]['count'] = 1;
							} else {
								$results[$files_item['Item']['id']]['count'] = $results[$files_item['Item']['id']]['count']+1;
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
		// if only one result redirect
		if (count($results) == 1) {
			debug($results);
			$item = array_pop($results);
			$id = $item['id'];
			$this->redirect(array('action' => 'view', $id));
		} else {
			$this->set('items', $results);
		}
	}

	function add() {
		if (!empty($this->data)) {
			unset($this->Item->Field->validate['item_id']);
			unset($this->Item->Relatedfile->validate['item_id']);
			
			foreach ($this->data['Relatedfile'] as $related_key => $file) {
				$fileOK = $this->uploadFile('files', $file['file_url']);
				
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
			unset($this->Item->Field->validate['item_id']);
			unset($this->Item->Relatedfile->validate['item_id']);
			
			// do file upload
			if (!empty($this->data['Relatedfile'])) {
				foreach ($this->data['Relatedfile'] as $related_key => $file) {
					if (!empty($file['file_url'])) {
						$fileOK = $this->uploadFile('files', $file['file_url']);
						if (!empty($fileOK['url'][0])) {
							$this->data['Relatedfile'][$related_key]['file_url'] = $fileOK['url'][0];
							$this->data['Relatedfile'][$related_key]['thumb_file_url'] = $fileOK['url'][0];
						}
					} else {
						unset($this->data['Relatedfile'][$related_key]);
					}
				}
			}
			
			if ($this->Item->saveAll($this->data)) {
				// if files are marked to be removed, remove them
				if (!empty($this->data['removeFile'])) {
					foreach($this->data['removeFile'] as $file) {
						if (!empty($file['id'])) {
							$this->Item->Relatedfile->delete($file['id']);
						}
					}
				}
				
				// if fields are marked to be removed, remove them
				if (!empty($this->data['removeField'])) {
					foreach($this->data['removeField'] as $field) {
						if (!empty($field['id'])) {
							$this->Item->Field->delete($field['id']);
						}
					}
				}
				
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
