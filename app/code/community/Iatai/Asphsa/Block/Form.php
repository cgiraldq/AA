<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * Informacion mostrada sobre el metodo de pago en el checkout
 */
class Iatai_Asphsa_Block_Form extends Mage_Payment_Block_Form
{
	protected function _construct()
    {
        $this->setTemplate('asphsa/form.phtml');
        parent::_construct();
    }
}
