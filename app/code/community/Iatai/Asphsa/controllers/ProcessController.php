<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Iatai_Asphsa_ProcessController extends Mage_Core_Controller_Front_Action
{
    
	
	public function redirectAction(){
		Mage::helper('asphsa')->log(__METHOD__);
		$session = Mage::getSingleton('checkout/session');
		$order = Mage::getModel('sales/order');
		$order->loadByIncrementId($session->getLastRealOrderId());
		if (!$order->getId()) {
			$this->norouteAction();
			return;
		}

		$order->addStatusToHistory($order->getStatus(),'El cliente fue enviado a ASPH Cybersource.');
		$order->save();

		$this->getResponse()
			->setBody($this->getLayout()->createBlock('asphsa/redirect')->setOrder($order)->toHtml());
    }
	
	protected function _processResponse($urlType){
		Mage::helper('asphsa')->log(__METHOD__);
		$responseParams     = $this->getRequest()->getParams();
		
		Mage::helper('asphsa')->log("RESPONSE:");
		Mage::helper('asphsa')->log($responseParams);
		
		//foreach($responseParams as $key=>$value){
		//	Mage::helper('asphsa')->log("$key:$value");
		//}
		
		$orderId = isset($responseParams['req_reference_number']) ? $responseParams['req_reference_number'] : null;
		$reasonCode = isset($responseParams['reason_code']) ? $responseParams['reason_code'] : '';
		$order	 = Mage::getModel('sales/order')->loadByIncrementId($orderId);
		$checkout = Mage::getSingleton('checkout/session');
		
		if ( !$order->getId() ) {
			$this->_redirect('checkout/cart');
			return false;
		}
		
		if(isset($responseParams['decision'])){
			if($responseParams['decision'] == 'ACCEPT' && ($reasonCode=='100' || $reasonCode=='110')){
				$asph = Mage::getSingleton('asphsa/asphsa');
				$local_signature  = $asph->sign($responseParams);
				
				$signature = isset($responseParams['signature']) ? $responseParams['signature'] : null;
				if($local_signature == $signature){
					if($order->getStatus()!="processing"){
						$order->setStatus("processing");
						$order->addStatusToHistory($order->getStatus(),$this->__('ASPH Cybersource aprobo el pago. Código:'.$reasonCode));
						$order->save();
						$payment = $order->getPayment();
						$payment->setAdditionalData($responseParams['transaction_id']);
						$payment->save();
						$order->sendNewOrderEmail();
					}else{
						$order->addStatusToHistory($order->getStatus(),$this->__('ASPH Proceso aprobatorio omitido en la url '.$urlType));
						$order->save();
					}
					$this->_redirect('checkout/onepage/success');
				}else{
					$order->cancel();
					$order->addStatusToHistory($order->getStatus(),$this->__('La firma es inválida.'));
					$order->save();
					$checkout->addError($this->__('Ocurrio un error con la transacción'));
					$this->_redirect('checkout/cart');
				}
			}else{
				
				if($responseParams['decision'] == 'REVIEW'){
					$order->setStatus("asphsa_review");
					$order->addStatusToHistory($order->getStatus(),$this->__('Transaction was declined. Please review payment details. Código :'.$reasonCode));
				}elseif($responseParams['decision'] == 'DECLINE'){
					$order->setStatus("asphsa_declined");
					$order->addStatusToHistory($order->getStatus(),$this->__('Transaction was declined. Código :'.$reasonCode));
				}elseif($responseParams['decision'] == 'ERROR'){
					$order->cancel();
					$order->addStatusToHistory($order->getStatus(),$this->__('Access denied, page not found, or internal server error. Código :'.$reasonCode));
				}elseif($responseParams['decision'] == 'CANCEL'){
					$order->cancel();
					$order->addStatusToHistory($order->getStatus(),$this->__('The consumer did not accept the service fee conditions. Código :'.$reasonCode));
				}
				$order->save();
				$checkout->addError($this->__('La transaccion no fue aceptada. Código :'.$reasonCode));
				$this->_redirect('checkout/cart');
				
				
			}
		}else{
			$order->cancel();
			$order->addStatusToHistory($order->getStatus(),$this->__('La transaccion no fue aceptada. Código :'.$reasonCode));
			$order->save();
			$checkout->addError($this->__('La transaccion no fue aceptada.'));
			$this->_redirect('checkout/cart');
		}
	}
	
    public function returnAction()
    {
		Mage::helper('asphsa')->log(__METHOD__);
		$this->_processResponse('de retorno');
    }
	  
	  
	public function silentAction(){
		Mage::helper('asphsa')->log(__METHOD__);
		$this->_processResponse('silenciosa');
	}
	
    public function cancelAction()
	{
		Mage::helper('asphsa')->log(__METHOD__);
		
		$session = Mage::getSingleton('checkout/session');
		$order = Mage::getModel('sales/order');
		$order->loadByIncrementId($session->getLastRealOrderId());
		
		if ( !$order->getId() ) {
			$this->_redirect('checkout/cart');
			return false;
		}

        $order->cancel();
        $order->addStatusToHistory(
			$order->getStatus(),
			$this->__('El proceso de pago en ASPH CyberSource fue cancelado.')
		);
        $order->save();
		$checkout = Mage::getSingleton('checkout/session');
		$checkout->addError($this->__('El proceso de pago en ASPH CyberSource fue cancelado.'));
		$this->_redirect('checkout/cart');
			
		//$order->sendNewOrderEmail();
	}

  
}