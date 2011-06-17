<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Australia/ACT' for 'EST/10.0/no DST' instead in /Users/Greg/Sites/test/asset_management/cake/console/templates/default/classes/test.ctp on line 22
/* Fields Test cases generated on: 2011-06-07 18:19:52 : 1307434792*/
App::import('Controller', 'Fields');

class TestFieldsController extends FieldsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FieldsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.field', 'app.item');

	function startTest() {
		$this->Fields =& new TestFieldsController();
		$this->Fields->constructClasses();
	}

	function endTest() {
		unset($this->Fields);
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
