<?php

$options['nestSeparator'] = '.';
$config = new Zend_Config_Ini(APPLICATION_PATH . '/data/application.ini', 'development', $options);

$db = Zend_Db::factory($config->resources->db->adapter, $config->resources->db->params);
Zend_Db_Table_Abstract::setDefaultAdapter($db);