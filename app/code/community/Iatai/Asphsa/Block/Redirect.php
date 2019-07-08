<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Iatai_Asphsa_Block_Redirect extends Mage_Core_Block_Abstract
{
	protected function _toHtml()
	{
	
		$standard 	= $this->getOrder()->getPayment()->getMethodInstance();
        $form 		= new Varien_Data_Form();
        $form->setAction($standard->getAsphsaUrl())
            ->setId('asphsa_payment_checkout')
            ->setName('asphsa_payment_checkout')
            ->setMethod('POST')
            ->setUseContainer(true);

		foreach ($standard->getFormFields() as $field => $value) {
            $form->addField($field, 'hidden', array('name'=>$field, 'value'=>$value));
        }

        $html = '<html><body>';
        $html.= $this->__('Enviando a CyberSource Secure Acceptance ....');
		$html.= $form->toHtml();
		
        $html.= '<script type="text/javascript">document.getElementById("asphsa_payment_checkout").submit();</script>';
        $html.= '</body></html>';

		return $html;
    }
}