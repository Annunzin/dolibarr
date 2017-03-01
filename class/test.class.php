<?php

class TSimple208000 extends TObjetStd {

	function __construct() {
		
		parent::set_table(MAIN_DB_PREFIX.'simple208000');

		parent::add_champs('fk_soc',array('type'=>'integer','index'=>true));

		parent::_init_vars();

		parent::start();

	}

}

