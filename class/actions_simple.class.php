<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    class/actions_simple.class.php
 * \ingroup simple
 * \brief   This file is an example hook overload class file
 *          Put some comments here
 */

/**
 * Class Actionssimple
 */
class Actionssimple
{
	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();

	/**
	 * Constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Overloading the doActions function : replacing the parent's function with the one below
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	function formObjectOptions($parameters, &$object, &$action, $hookmanager)
	{
//TODO méthode à copier

		$error = 0; // Error counter
		$myvalue = ''; // A result value
                
               
                

		if (in_array('thirdpartycard', explode(':', $parameters['context']))){
                    
                    global $db,$langs;
                    $societe = new Societe($db);
                    $capital = $object->capital;
                    $zip = $this->cutZip($object->zip);
                    
                    
                    
                
                
                    $rang = $this->calculerRang($capital,$zip);
                
                    echo '<tr>
                                <td>'.$langs->trans('Grade').'</td><td colspan="'.$parameters['colspan'].'">'.$rang.'</td>
                          </tr>';
		}

		if (! $error)
		{
			
			return 0; // or return 1 to replace standard code
		}
		else
		{
			$this->errors[] = 'Error message';
			return -1;
		}
	}
        
        function calculerRang($capital,$zip){
            
            global $db,$langs,$mysoc;
            
            
            $mySocZip = $this->cutZip($mysoc->zip);

            $tGrade = array('E','D','C','B','A');
            
            $pt = 0;
            
            if($$zip==$mySocZip){
                
                $pt++;
            }
            
            if($capital>20000) $pt++;
            if($capital>50000) $pt++;
            if($capital>150000) $pt++;
            
            return $tGrade[$pt];

          
        }
        
        function cutZip($zip){
            
            $cut = substr($zip, 0,2);
            
            return $cut;
            
        }
}