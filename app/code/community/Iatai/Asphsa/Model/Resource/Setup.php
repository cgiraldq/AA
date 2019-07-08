<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Iatai_Asphsa_Model_Resource_Setup extends Mage_Core_Model_Resource_Setup
{

	protected function orderStatusSetup(){
		$status = Mage::getModel('sales/order_status');
		$status->setStatus('asphsa_declined');
		$status->setLabel('Declinada');
		$status->save();
		$status->assignState('canceled');
		$status->save();
		
		$status = Mage::getModel('sales/order_status');
		$status->setStatus('asphsa_review');
		$status->setLabel('En Validacion');
		$status->save();
		$status->assignState('payment_review');
		$status->save();
	}
}

    