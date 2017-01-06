<?php

class TSimple208000 extends TObjetStd {

	function __construct() {
		
		parent::set_table(MAIN_DB_PREFIX.'relation208000');

		parent::add_champs('comment',array('type'=>'string','index'=>true,'length'=>80));
		parent::add_champs('fk_soc,fk_soc_related',array('type'=>'integer','index'=>true));

		parent::_init_vars();

		parent::start();

	}

}

