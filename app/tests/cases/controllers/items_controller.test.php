<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Australia/ACT' for 'EST/10.0/no DST' instead in /Users/Greg/Sites/test/asset_management/cake/console/templates/default/classes/test.ctp on line 22
/* Items Test cases generated on: 2011-06-07 18:19:37 : 1307434777*/
App::import('Controller', 'Items');

class TestItemsController extends ItemsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ItemsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.item', 'app.field');

	function startTest() {
		$this->Items =& new TestItemsController();
		$this->Items->constructClasses();
	}

	function endTest() {
		unset($this->Items);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
