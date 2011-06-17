<?php
/* Template Test cases generated on: 2011-06-08 16:53:50 : 1307516030*/
App::import('Model', 'Template');

class TemplateTestCase extends CakeTestCase {
	var $fixtures = array('app.template');

	function startTest() {
		$this->Template =& ClassRegistry::init('Template');
	}

	function endTest() {
		unset($this->Template);
		ClassRegistry::flush();
	}

}
