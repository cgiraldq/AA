<?php
namespace Magebird\Popup\Block\Adminhtml\Popup\Edit\Tab;

class Settings extends \Magento\Backend\Block\Widget\Form\Generic implements
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
        $form->setHtmlIdPrefix('popup_settings_');
        if ($this->_isAllowedAction('Magebird_Popup::popup_manager')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }
        
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Settings')]);

        $note = "<p class='nm'><small>" . __("If 'Show only once', popup with the same id won't be shown again until cookie lifetime expires.") . "</small></p>";
    		$fieldset->addField('showing_frequency', 'select', array(
    		  'label'     => __("Showing Frequency"),
    		  'name'      => 'showing_frequency',
    		  'values'    => array(
    			  array(
    				  'value'     => 1,
    				  'label'     => __("Show until the popup is closed"),
    			  ),
            
    			  array(
    				  'value'     => 2,
    				  'label'     => __("Show only once"),
    			  ),            
    
    			  array(
    				  'value'     => 3,
    				  'label'     => __('Show every time'),
    			  ),
            
    			  array(
    				  'value'     => 4,
    				  'label'     => __("Show until user clicks inside popup"),
    			  ),
            
    			  array(
    				  'value'     => 5,
    				  'label'     => __("Show until user close it or clicks inside popup"),
    			  ),  
    			  array(
    				  'value'     => 6,
    				  'label'     => __("Show until goal completed (e.g.: Subscribed newsletter)"),
    			  ), 
    			  array(
    				  'value'     => 7,
    				  'label'     => __("Show once per session"),
    			  ),                                                
    		  ),
          'note' => $note,
    		));              
        
        $note = "<p class='nm'><small>" . __("You can use also decimal dotted number (e.g.: To expire cookie in 1 hour put 0.04 which means 1 day divided with 24 hours.)") . "</small></p>";		
        $fieldset->addField('cookie_time', 'text', array(
    		  'label'     => __('Cookie lifetime in days'),
    		  'name'      => 'cookie_time',
    		  'class'	  => 'validate-number',
    		  'required'  => true,
          'note' => $note,
    		));   
        
        $note = "<p class='nm'><small>" . __("Only alphabet and numbers are allowed. Recommended to leave auto generated value. If you are doing A B testing with duplicate popups with similar content, it is recommended to use the same cookie id. So once user close pop up, it wont show neither this popup or neither any duplicate again") . "</small></p>";
    		$fieldset->addField('cookie_id', 'text', array(
    		  'label'     => __('Cookie/popup id'),
    		  'class'     => 'required-entry',
    		  'required'  => true,
    		  'name'      => 'cookie_id',
          'note' => $note,
    		));   
        
        $note = "<p class='nm'><small>" . __("If visitor leaves window open without beeing active (for example if the user have a phone call), this can confuse the statistic. That is why it is recommended to set max time per view.") . "</small></p>";
        $fieldset->addField('max_count_time', 'text', array(
    		  'label'     => __('Max time per view to track statistics (in seconds)'),
    		  'name'      => 'max_count_time',
    		  'class'	  => 'validate-number',
    		  'required'  => true,
          'note' => $note,
    		));             
        
        $note = "<p class='nm'><small>" . __("Available for popups with background overlay.") . "</small></p>";
        $fieldset->addField('close_on_overlayclick','select',array(
                    'label' => __('Close when click outside popup'),
                    'name' =>  'close_on_overlayclick',
              		  'values'    => array(
              			  array(
              				  'value'     => 0,
              				  'label'     => __('No'),
              			  ),
              
              			  array(
              				  'value'     => 1,
              				  'label'     => __('Yes'),
              			  ),
              		  ),
                    'note' => $note,                          
        )); 
        
        $note = "<p class='nm'><small>".__("Leave 0 or empty if you don't want popup to be closed automatically")."</small></p>";
        $fieldset->addField('close_on_timeout', 'text', array(
    		  'label'     => __('Close automatically after x seconds'),
    		  'name'      => 'close_on_timeout',
          'note' => $note,
    		)); 
        
        $note = "<p class='nm'><small>".__("If you added more popups for the same pages, you can stop further popups with less priority to be shown on the same page.")."</small></p>";
        $fieldset->addField('stop_further', 'select', array(
    		  'label'     => __('Stop further popups'),
    		  'name'      => 'stop_further',
    		  'values'    => array(
    			  array(
    				  'value'     => 1,
    				  'label'     => __('Yes'),
    			  ),
    
    			  array(
    				  'value'     => 2,
    				  'label'     => __('No'),
    			  ),
    		  ),
          'note' => $note,   
    		));
        
        $note = "<p class='nm'><small>".__("If you added more popups for the same pages, select display priority")."</small></p>";
        $fieldset->addField('priority', 'text', array(
    		  'label'     => __('Priority'),
    		  'name'      => 'priority',
          'note' => $note,
    		));                         

        $this->_eventManager->dispatch('adminhtml_popup_edit_tab_settings_prepare_form', ['form' => $form]);

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
        return __('Settings');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Settings');
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
