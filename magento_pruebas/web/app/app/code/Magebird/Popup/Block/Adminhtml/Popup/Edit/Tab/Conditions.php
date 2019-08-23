<?php
namespace Magebird\Popup\Block\Adminhtml\Popup\Edit\Tab;

class Conditions extends \Magento\Backend\Block\Widget\Form\Generic implements
\Magento\Backend\Block\Widget\Tab\TabInterface{
	protected $customerGroups;
    
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\Data\FormFactory $formFactory,
		\Magento\Customer\Model\ResourceModel\Group\Collection $customerGroups,
		array $data = []
	){
		$this->customerGroups = $customerGroups;
		parent::__construct($context, $registry, $formFactory, $data);
	}

	protected function _prepareForm(){
		$model = $this->_coreRegistry->registry('popup');

		$form = $this->_formFactory->create();
		$form->setHtmlIdPrefix('popup_conditions_');
		if($this->_isAllowedAction('Magebird_Popup::popup_manager')){
			$isElementDisabled = false;
		} else{
			$isElementDisabled = true;
		}
        
		$fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Conditions')]);

		$fieldset->addField('day', 'multiselect', array(
				'name' => 'day',
				'label' => __('Day of the week'),
				'required' => false,
				'values' => array(1=>array('label'=>__('Monday'),'value'=>1),
					2=>array('label'=>__('Tuesday'),'value'=>2),
					3=>array('label'=>__('Wednesday'),'value'=>3),
					4=>array('label'=>__('Thursday'),'value'=>4),
					5=>array('label'=>__('Friday'),'value'=>5),
					6=>array('label'=>__('Saturday'),'value'=>6),
					7=>array('label'=>__('Sunday'),'value'=>0),
				),
				'style' => 'height:150px',
			));

		$note = "<p class='nm'><small>".__('You can show popup only on product pages if product attribute matches your value (e.g. if product price is higher than 100$, if color is green, ...). See instructions <a target="_blank" href="http://www.magebird.com/magento-extensions/popup.html?tab=faq#productAttributeCond">here</a>.')."</small></p>";
		$fieldset->addField('product_attribute', 'text', array(
				'label'     => __('Product Attribute'),
				'name'      => 'product_attribute',
				'note' => $note 
			)); 
        
		$note = "<p class='nm'><small>".__('Use if you want to show popup only on product pages and if product belongs to selected categories. Write categories ids separated with comma (e.g.:1,12,31)')."</small></p>";
		$fieldset->addField('product_categories', 'text', array(
				'label'     => __('Product Categories'),
				'name'      => 'product_categories',
				'note' => $note 
			));         
      
		$note = "<p class='nm'><small>".__('You can show popup only to visitors from specific countries. Use <a href="http://data.okfn.org/data/core/country-list" target="_blank">iso codes</a>. You can add more countries by separating codes with comma (e.g. US, DE, IT). This product includes GeoLite2 data created by MaxMind, available from <a target="_blank" href="http://www.maxmind.com">http://www.maxmind.com</a>. To download the latest IP database, please follow instructions from <a target="_blank" href="http://www.magebird.com/magento-extensions/popup.html?tab=faq#geoIP">our FAQ</a>.')."</small></p>";


		$fieldset->addField('country_ids', 'text', array(
				'label'     => __('Country'),
				'name'      => 'country_ids',
				'note' => $note 
			)); 
        
		$note = "<p class='nm'><small>".__('You can exclude popup to visitors from specific countries. Use <a href="http://data.okfn.org/data/core/country-list" target="_blank">iso codes</a>. You can add more countries by separating codes with comma (e.g. US, DE, IT). This product includes GeoLite2 data created by MaxMind, available from <a target="_blank" href="http://www.maxmind.com">http://www.maxmind.com</a>. To download the latest IP database, please follow instructions from <a target="_blank" href="http://www.magebird.com/magento-extensions/popup.html?tab=faq#geoIP">our FAQ</a>.')."</small></p>";
		$fieldset->addField('not_country_ids', 'text', array(
				'label'     => __('Exclude country'),
				'name'      => 'not_country_ids',
				'note' => $note 
			));         
                
		$fieldset->addField('devices', 'select', array(
				'label'     => __('Devices'),
				'name'      => 'devices',
				'values'    => array(
					array(
						'value'     => 1,
						'label'     => __('All devices'),
					),
					array(
						'value'     => 2,
						'label'     => __('Desktop'),
					),    
					array(
						'value'     => 3,
						'label'     => __('Mobile'),
					),
					array(
						'value'     => 4,
						'label'     => __('Tablet'),
					),
					array(
						'value'     => 5,
						'label'     => __('Mobile & Tablet'),
					),
					array(
						'value'     => 6,
						'label'     => __('Desktop & Tablet'),
					),
					array(
						'value'     => 7,
						'label'     => __('Desktop & Mobile'),
					)                                                        
				)  
			));  

		$fieldset->addField('cookies_enabled', 'select', array(
				'label'     => __('Cookies enabled'),
				'name'      => 'cookies_enabled',
				'values'    => array(
					array(
						'value'     => 1,
						'label'     => __('Show to All users'),
					),
					array(
						'value'     => 2,
						'label'     => __('Show only if user has cookies enabled'),
					),    
					array(
						'value'     => 3,
						'label'     => __('Show only if user has cookies disabled'),
					)                                                     
				)  
			));
                
		$fieldset->addField('user_login', 'select', array(
				'label'     => __('User Login'),
				'name'      => 'user_login',
				'values'    => array(
					array(
						'value'     => 1,
						'label'     => __('Show to All users'),
					),
					array(
						'value'     => 2,
						'label'     => __('Show to logged in/registered users'),
					),    
					array(
						'value'     => 3,
						'label'     => __('Show to unlogged/unregistered users'),
					)                                                     
				)  
			));
                    
		$note = "<p class='nm'><small>".__('Works only for logged in users. For guest visitors works only if they subscribed after you installed the Popup extension version 1.2.0+')."</small></p>";
        
		$fieldset->addField('user_not_subscribed', 'select', array(
				'name'      => 'user_not_subscribed',
				'label'     => __('If not subscribed yet'),
				'note' => $note,
				'values'    => array(
					array(
						'value'     => 1,
						'label'     => __('Show only if user is not subscribed yet'),
					),
					array(
						'value'     => 2,
						'label'     => __('Skip this condition')
					)                                                    
				)  
			));
        
		$note = "<p class='nm'><small>".__('If you use this option, popup will be shown only if user came to your page from specific site. Use "%" if you need to use a pattern (e.g. <span style="color:#747474; font-style:italic;">%domainname%</span> to show popup if user came to your page from any page having \'domainname\' in url). Use double comma (e.g. <span style="color:#747474; font-style:italic;">%domainname%,,%another-url%</span>) to separate multiple urls. Leave empty if you want to skip this condition. Referal url persists for entire session. IMPORTANT: This won\'t work if user came from https site and your site doesn\'t use https connection.')."</small></p>";
        
		$fieldset->addField('if_referral', 'text', array(
				'label'     => __('Show if referral url (write referral url)'),
				'name'      => 'if_referral',
				'note' => $note 
			)); 
        
		$note = "<p class='nm'><small>".__('Show popup only if user DIDN\'T come from specific site. Referal url persists for entire session. Use the same structure as for field "If referral url" (see previous field comment).')."</small></p>";
		$fieldset->addField('if_not_referral', 'text', array(
				'label'     => __('If not referral url (write referral url)'),
				'name'      => 'if_not_referral',
				'note' => $note 
			));         
        
		$note = "<p class='nm'><small>".__("Any visitor came to your site with expired session in the past will be recognized as returning. Returning visitors can be recognized from the day you have installed this extension. Any visitor that came to your site before you installed this extension will be recognized as new visitor until he/she doesn't visit your site again.")."</small></p>";
		$fieldset->addField('if_returning', 'select', array(
				'label'     => __('Returning or new visitor'),
				'name'      => 'if_returning',
				'values'    => array(
					array(
						'value'     => 1,
						'label'     => __('Show to all visitors'),
					),
					array(
						'value'     => 2,
						'label'     => __('Show only to returning visitors'),
					),    
					array(
						'value'     => 3,
						'label'     => __('Show only to new visitors'),
					)
				),           
				'note' => $note 
			));   
        
		$note = "<p class='nm'><small>".__('You can choose to display popup only if visitor opened at least defined number of pages. Leave empty or 1 to skip this condition.')."</small></p>";
		$fieldset->addField('num_visited_pages', 'text', array(
				'label'     => __('Number of visited pages'),
				'name'      => 'num_visited_pages',
				'note' => $note
			));       
		/*
		$note = "<p class='nm'><small>".__('IMPORTANT: This works only if user is logged in. Unlogged user will be recognized as unsubscribed.')."</small></p>";
		$fieldset->addField('if_is_subscribed', 'text', array(
		'label'     => __('Show only if user is not subscribed'),
		'name'      => 'if_is_subscribed',
		'note' => $note
		));
		*/                      
        

		$groupOptions = $this->customerGroups->toOptionArray();
		$note = "<p class='nm'><small>".__('Leave unselected (empty) to skip this condition and show to all groups.')."</small></p>";
        
		$fieldset->addField('customer_group', 'multiselect', array(
				'label'     => __('Customer groups'),
				'name'      => 'customer_group',
				'values'    => $groupOptions,
				'note' => $note
			));  

		$note = "<p class='nm'><small>".__('For testing purposes. Leave empty to show to all users. Write ip address if you want to show popup to user with only specific ip address')."</small></p>";
		$fieldset->addField('user_ip', 'text', array(
				'label'     => __('User ip address'),
				'name'      => 'user_ip',
				'note' => $note 
			));  
		$this->_eventManager->dispatch('adminhtml_popup_edit_tab_conditions_prepare_form', ['form' => $form]);

		$form->setValues($model->getData());

		$this->setForm($form);

		return parent::_prepareForm();
	}

	/**
	* Prepare label for tab
	*
	* @return string
	*/
	public function getTabLabel(){
		return __('Conditions');
	}

	/**
	* Prepare title for tab
	*
	* @return string
	*/
	public function getTabTitle(){
		return __('Conditions');
	}

	/**
	* {@inheritdoc}
	*/
	public function canShowTab(){
		return true;
	}

	/**
	* {@inheritdoc}
	*/
	public function isHidden(){
		return false;
	}

	/**
	* Check permission for passed action
	*
	* @param string $resourceId
	* @return bool
	*/
	protected function _isAllowedAction($resourceId){
		return $this->_authorization->isAllowed($resourceId);
	}
    
	/**
	* Return predefined additional element types
	*
	* @return array
	*/
	protected function _getAdditionalElementTypes(){
		return ['image' => 'Magebird\Popup\Block\Adminhtml\Form\Element\Image'];
	}
}
