<?php

	require 'config.php';
	
	dol_include_once('/societe/class/societe.class.php');
	dol_include_once('/simple/class/test.class.php');
	
	$object = new Societe($db);
	$object->fetch(GETPOST('fk_soc'));
	
	$action = GETPOST('action');
	
	$PDOdb = new TPDOdb;
	
	$simple = new TSimple208000;
	$simple->loadBy($PDOdb, $object->id, 'fk_contact');
	
	
	switch ($action) {
		case 'save':
			
			$simple->set_values($_POST);
			$simple->save($PDOdb);
			
			setEventMessage('Element simple sauvegardé');
			
			_card($object,$simple);
			break;
		default:
			_card($object,$simple);
			break;
	}
	
	
	
function _card(&$object,&$simple) {
	
	dol_include_once('/core/lib/company.lib.php');
	
	llxHeader();
	$head = societe_prepare_head($object);
	dol_fiche_head($head, 'tab208000', '', 0, '');
	
	
	echo '<h2>Ceci est supposé être une map mais la clé API en on décidé autrement</h2>';
        echo ''
        . '<iframe
  width="600"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDsFKfGdlms-s9KHfdC4ciUwXYGl5vh5jE
    &q='.$object->town.'+'.$object->adress.'" allowfullscreen>
</iframe>';
	
	
	dol_fiche_end();
	llxFooter();	  
		 	
}

