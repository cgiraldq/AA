<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Iatai_Asphsa_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getConfig($field, $default = null)
	{
        $value = Mage::getStoreConfig('payment/asphsa/' . $field);
        if(!isset($value) or trim($value) == ''){
            return $default;
        }else{
            return $value;
        }
    }

    public function log($data)
	{
		if(!$this->getConfig('isdebug')){
			return;
		}
        Mage::log($data, 7, 'asphsa.log', true);
    }

}