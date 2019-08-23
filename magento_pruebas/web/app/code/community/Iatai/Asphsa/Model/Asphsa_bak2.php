<?php
/**
 * Modulo de integracion de sistema Asph y Secure Acceptance
 *
 * @category   Iatai
 * @package    Iatai_Asphsa
 * @author     Harold Villota
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Iatai_Asphsa_Model_Asphsa extends Mage_Payment_Model_Method_Abstract
{
    
    protected $_code = 'asphsa';
    protected $_formBlockType 	= 'asphsa/form';
    protected $_infoBlockType 	= 'asphsa/info';
	protected $_canCapture                  = true;

    public function capture(Varien_Object $payment, $amount)
    {
        $payment->setStatus(self::STATUS_APPROVED)
            	->setLastTransId($this->getTransactionId());

        return $this;
    }

	public function getAsphsaUrl()
	{
		
	      if($this->getConfigData('mode')=='live'){
				return $this->getConfigData('live_url');
	      }else{
				return $this->getConfigData('test_url');
	      }
	}
    
    public function getOrderPlaceRedirectUrl()
    {
          return Mage::getUrl('asphsa/process/redirect');
    }

	public function getCustomer()
    {
        if (empty($this->_customer)) {
            $this->_customer = Mage::getSingleton('customer/session')->getCustomer();
        }
        return $this->_customer;
    }

    public function getCheckout()
    {
        if (empty($this->_checkout)) {
            $this->_checkout = Mage::getSingleton('checkout/session');
        }
        return $this->_checkout;
    }

    public function getQuote()
    {
        if (empty($this->_quote)) {
            $this->_quote = $this->getCheckout()->getQuote();
        }
        return $this->_quote;
    }

    public function getOrder()
    {
        if (empty($this->_order)) {
            $order = Mage::getModel('sales/order');
            $order->loadByIncrementId($this->getCheckout()->getLastRealOrderId());
            $this->_order = $order;
        }
        return $this->_order;
    }

	public function getEmail()
	{
		$email = $this->getOrder()->getCustomerEmail();
		if (!$email) {
            $email = $this->getQuote()->getBillingAddress()->getEmail();
        }
		if (!$email) {
            $email = Mage::getStoreConfig('trans_email/ident_general/email');
        }
		return $email;
	}

	public function getOrderAmount()
	{
    	$amount = sprintf('%.2f', $this->getOrder()->getGrandTotal());
    	return $amount;
	}

	public function getOrderCurrency()
	{
		$currency = $this->getOrder()->getOrderCurrency();
        if (is_object($currency)) {
            $currency = $currency->getCurrencyCode();
        }
		return $currency;
	}

	public function getIva(){
		if($this->getOrder()->getTaxAmount()){
			return sprintf('%.2f', $this->getOrder()->getTaxAmount());
		}else{
			return 0;
		}
		
	}
	public function getBase(){
		if($this->getOrder()->getBaseSubtotal()){
			return sprintf('%.2f', $this->getOrder()->getBaseSubtotal());
		}else{
			return 0;
		}
		
	}

	public function getFormFields()
	{
		$payment = $this->getQuote()->getPayment();
		$order = $this->getOrder();
		$formFields = array();

		$formFields['access_key'] = $this->getConfigData('access_key'); //SIGNED
		$formFields['profile_id'] = $this->getConfigData('profile_id'); //SIGNED
		$formFields['transaction_uuid'] = Mage::helper('core')->uniqHash(); //SIGNED
		$formFields['signed_field_names'] = 'access_key,profile_id,reference_number,amount,currency,locale,transaction_type,transaction_uuid, signed_date_time,unsigned_field_names';
		$formFields['unsigned_field_names'] = ''; //SIGNED
		$formFields['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z"); //SIGNED
		$formFields['locale'] = 'es-CO'; //SIGNED
		$formFields['transaction_type'] = 'authorization'; //SIGNED
		$formFields['reference_number'] = 'test123';
		//$formFields['reference_number'] = $order->getRealOrderId(); //SIGNED
		$formFields['description'] = 'Compra realizada en ROPA DE DORMIR ADRIANA ARANGO S.A.S.';
		$formFields['amount'] = $this->getOrderAmount(); //SIGNED
		$formFields['currency'] = $this->getOrderCurrency(); //SIGNED
	
		$formFields['payment_method'] = 'card';
		
		$formFields['signature']					= $this->sign($formFields);
		
		$formFields['bill_to_address_city'] = $this->getOrder()->getBillingAddress()->getCity();
		$formFields['bill_to_address_country'] = $this->getOrder()->getBillingAddress()->getCountryId();
		$formFields['bill_to_address_postal_code'] = $this->getOrder()->getBillingAddress()->getPostcode();
		$formFields['bill_to_address_state'] = $this->getOrder()->getBillingAddress()->getRegion();
		$formFields['bill_to_address_line1'] = $this->getOrder()->getBillingAddress()->getStreet();
		$formFields['bill_to_email'] = $this->getEmail();
		$formFields['bill_to_forename'] = $this->getOrder()->getBillingAddress()->getFirstname();
		$formFields['bill_to_surname'] = $this->getOrder()->getBillingAddress()->getLastname();
		$formFields['bill_to_phone'] = $this->getOrder()->getBillingAddress()->getTelephone();
		$formFields['merchant_defined_data6'] = $this->getBase();
		$formFields['merchant_defined_data5'] = $this->getIva();
	
        
		Mage::helper('asphsa')->log(__METHOD__.' REQUEST:');
		Mage::helper('asphsa')->log($formFields);
           
		return $formFields;
	}
	
	
	public function sign ($params) {
	  return $this->signData($this->buildDataToSign($params), Mage::getStoreConfig('payment/asphsa/secret_key'));
	}

	public function signData($data, $secretKey) {
	    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
	}

	public function buildDataToSign($params) {
		$signedFieldNames = explode(",",$params["signed_field_names"]);
		foreach ($signedFieldNames as &$field) {
		  $dataToSign[] = $field . "=" . $params[$field];
		}
		return $this->commaSeparate($dataToSign);
	}

	public function commaSeparate ($dataToSign) {
	    return implode(",",$dataToSign);
	}

}