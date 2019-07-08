<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Iatai_Asphsa_Model_Transaction_Modes
{
    public function toOptionArray()
    {
        
        $options =  array();
        $options[] = array(
            	   'value' => 'test',
            	   'label' => 'Test'
         );
	$options[] = array(
            	   'value' => 'live',
            	   'label' => 'Live'
         );

        return $options;
    }
}