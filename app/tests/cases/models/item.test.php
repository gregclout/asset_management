<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Australia/ACT' for 'EST/10.0/no DST' instead in /Users/Greg/Sites/test/asset_management/cake/console/templates/default/classes/test.ctp on line 22
/* Item Test cases generated on: 2011-06-07 18:17:08 : 1307434628*/
App::import('Model', 'Item');

class ItemTestCase extends CakeTestCase {
	var $fixtures = array('app.item', 'app.field');

	function startTest() {
		$this->Item =& ClassRegistry::init('Item');
	}

	function endTest() {
		unset($this->Item);
		ClassRegistry::flush();
	}

}
