<?php
namespace Magebird\Popup\Block\Adminhtml\Popup\Edit\Tab;

class Cartconditions extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('popup');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('popup_cartconditions_');
        if ($this->_isAllowedAction('Magebird_Popup::popup_manager')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }
        
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Cart conditions')]);
                
        $productsInCart = $fieldset->addField('product_in_cart', 'select', array(
    		  'label'     => __('If product in cart'),
    		  'name'      => 'product_in_cart',
    		  'values'    => array(
    			  array(
    				  'value'     => 0,
    				  'label'     => __("Skip this condition"),
    			  ),
    			  array(
    				  'value'     => 1,
    				  'label'     => __('Show only if there is any product in cart'),
    			  ),    
    			  array(
    				  'value'     => 2,
    				  'label'     => __('Show only if product cart is empty'),
    			  )
           ),                               
    		));
    		
    		  $note = "<p class='nm'><small>".__("Show if total cart qty (number of products in cart) is more than x. Leave empty or 0 to skip this condition.")."</small></p>";
        $cartSubtotalMin = $fieldset->addField('cart_qty_max', 'text', array(
    		  'label'     => __('Cart qty more than'),
    		  'name'      => 'cart_qty_max',
          'note' => $note 
    		));  
    		
        $cartSubtotalMin = $fieldset->addField('cart_qty_min', 'text', array(
    		  'label'     => __('Cart qty less than'),
    		  'name'      => 'cart_qty_min'
    		));  
        
        $note = "<p class='nm'><small>".__("Leave empty or write 0 if you don't want to apply this condition.")."</small></p>";
        $cartSubtotalMin = $fieldset->addField('cart_subtotal_min', 'text', array(
    		  'label'     => __('Cart subtotal less than'),
    		  'name'      => 'cart_subtotal_min',
          'note' => $note 
    		));    
        
        $note = "<p class='nm'><small>".__("Leave empty or write 0 if you don't want to apply this condition.")."</small></p>";
        $cartSubtotalMax = $fieldset->addField('cart_subtotal_max', 'text', array(
    		  'label'     => __('Cart subtotal more than'),
    		  'name'      => 'cart_subtotal_max',
          'note' => $note 
    		));  
        
        $note = "<p class='nm'><small>".__('Show popup only if there is at least 1 product with attribute value that matches your value (e.g. if color is green, ...). See instructions <a target="_blank" href="http://www.magebird.com/magento-extensions/popup.html?tab=faq#productAttributeCond">here</a>. Leave empty to skip this condition.')."</small></p>";
        $cartSubtotalMin = $fieldset->addField('product_cart_attr', 'text', array(
    		  'label'     => __('Product attribute in cart'),
    		  'name'      => 'product_cart_attr',
          'note' => $note 
    		));   
        
        $note = "<p class='nm'><small>".__('Show popup only if there is NO product with attribute value in cart (e.g. if NO products with green color in cart). See instructions <a target="_blank" href="http://www.magebird.com/magento-extensions/popup.html?tab=faq#productAttributeCond">here</a>. Leave empty to skip this condition.')."</small></p>";
        $cartSubtotalMin = $fieldset->addField('not_product_cart_attr', 'text', array(
    		  'label'     => __('Not product attribute in cart'),
    		  'name'      => 'not_product_cart_attr',
          'note' => $note 
    		));    
        
        $note = "<p class='nm'><small>".__('Show popup only if there is any product in cart that belongs to selected categories. Write categories ids separated with comma (e.g.:1,12,31). Leave empty to skip this condition.')."</small></p>";
        $cartSubtotalMin = $fieldset->addField('cart_product_categories', 'text', array(
    		  'label'     => __('Product categories in cart'),
    		  'name'      => 'cart_product_categories',
          'note' => $note 
    		)); 


        $this->_eventManager->dispatch('adminhtml_popup_edit_tab_cartconditions_prepare_form', ['form' => $form]);

        $form->setValues($model->getData());

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Cart conditions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Cart conditions');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    /**
     * Return predefined additional element types
     *
     * @return array
     */
    protected function _getAdditionalElementTypes()
    {
        return ['image' => 'Magebird\Popup\Block\Adminhtml\Form\Element\Image'];
    }
}
