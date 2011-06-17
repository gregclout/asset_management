<?php
/* Template Fixture generated on: 2011-06-08 16:53:50 : 1307516030 */
class TemplateFixture extends CakeTestFixture {
	var $name = 'Template';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'fields' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2048, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 512, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'fields' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet'
		),
	);
}
