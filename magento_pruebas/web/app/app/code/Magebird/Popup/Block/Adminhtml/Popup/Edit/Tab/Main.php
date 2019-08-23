<?php
namespace Magebird\Popup\Block\Adminhtml\Popup\Edit\Tab;


class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{

    protected $_systemStore;
    protected $wysiwygConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_assetRepo = $context->getAssetRepository();
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('popup');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Magebird_Popup::popup_manager')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('popup_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Popup Information')]);

        if ($model->getId()) {
            $fieldset->addField('popup_id', 'hidden', ['name' => 'popup_id']);
        }

        $fieldset->addField('title','text',array(
                'name' => 'title',
                'label' => __('Popup Title'),
                'title' => __('Popup Title'),
                'required' => true,
                'disabled' => $isElementDisabled
        ));
        
  		$popupType = $fieldset->addField('popup_type', 'select', array(
  		  'label'     => __('Popup Content Type'),
  		  'name'      => 'popup_type',
  		  'values'    => array(
  			  array(
  				  'value'     => 2,
  				  'label'     => __('Custom Content (editor)'),
  			  ),
  			  array(
  				  'value'     => 1,
  				  'label'     => __('Image'),
  			  ),                                                                       
  		  ),
  		));
      
      $image=$fieldset->addField('image','image',array(
                  'label' => __('Image'),
                  'name' =>  'image',
                  'class'     => 'required-entry required-file',
                  'required'=>true,
      ));  

    
      $afterElementHtml = "<p class='nm'><small>".__('Tip: If you see widget icon %1 inside editor, double click to the icon to get extra configuration options. You can also display dynamic product data inside popup (<a target="_blank" href="%2">see instructions</a>).','<img style="vertical-align:middle;margin-top:3px; margin-bottom:-5px;" src="'.$this->getViewFileUrl('Magebird_Popup::images/widget.png').'" />','http://www.magebird.com/magento-extensions/popup.html?tab=faq#productInsidePopup').'<br>'.__('<a target="_blank" href="%s">For design instructions click here.</a>','http://www.magebird.com/magento-extensions/popup.html?tab=faq#designTips').'</small></p>';
      $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);
      $popupContent = $fieldset->addField('popup_content','editor',array(
              'name' => 'popup_content',
              'label' => __('Custom content'),
              'title' => __('Custom content'),
              'required' => false,
              'config'    => $wysiwygConfig,              
              'wysiwyg' => true,
              'style'=>'width:500px;height:350px;',
              'note' => $afterElementHtml                            
          )
      ); 
                   
      $note = '<p class="nm"><small>' . __('Leave empty if no link') . '</small></p>'; 
      $url = $fieldset->addField('url','text',array(
              'name' => 'url',
              'label' => __('Url of image link'),
              'title' => __('Url of image link'),
              'note' => $note
      ));
                           
      $note = '<p class="nm"><small> ' . __('How many px or %. Use just number and select unit in the next field. Border and padding size will be added to total width.') . '</small></p>'; 
      $fieldset->addField('width','text',array(
              'name' => 'width',
                'label' => __('Popup content width'),
                'title' => __('Popup content width'),
                'note' => $note
      ));
      
      $note = '<p class="nm"><small>'.__('Use px if you want fixed width. Use % if you want dynamic (responsive design for mobile).').'</small></p>';
  		$widthUnit = $fieldset->addField('width_unit', 'select', array(
  		  'label'     => __('Popup width unit'),
  		  'name'      => 'width_unit',
  		  'values'    => array(
  			  array(
  				  'value'     => 1,
  				  'label'     => __('Px'),
  			  ),
  			  array(
  				  'value'     => 2,
  				  'label'     => __('Percentage (%)'),
  			  ),                                                                       
  		  ),
        'note' => $note
  		));      

      $note = '<p class="nm"><small>'.__('You can limit width to max width px if % width is wider than max px.').'</small></p>'; 
      $maxWidth = $fieldset->addField('max_width','text',array(
                'name' => 'max_width',
                'label' => __('Popup content max width (in px)'),
                'title' => __('Popup content max width (in px)'),
                'note' => $note
      ));
      
  		$fieldset->addField('status', 'select', array(
  		  'label'     => __('Status'),
  		  'name'      => 'status',
  		  'values'    => array(
  			  array(
  				  'value'     => 1,
  				  'label'     => __('Enabled'),
  			  ),
  			  array(
  				  'value'     => 2,
  				  'label'     => __('Disabled'),
  			  ),                                                                       
  		  )
  		)); 
      
    if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                    'disabled' => $isElementDisabled,
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
      }
      
      $note = "<p class='nm'><small>".__("Leave unselected (empty) if you want to show popup at all pages. Hold 'ctrl' to select more options or to unselect.")."  </small></p>";
  		$targetPage = $fieldset->addField('page_id', 'multiselect', array(
  		  'label'     => __('Show at'),
  		  'name'      => 'pages',
        'style'=>'height:175px;',
  		  'values'    => array(
  			  array(
  				  'value'     => 1,
  				  'label'     => __('Home page'),
  			  ),
  			  array(
  				  'value'     => 2,
  				  'label'     => __('Product pages'),
  			  ),
  			  array(
  				  'value'     => 3,
  				  'label'     => __('Category pages'),
  			  ),
  			  array(
  				  'value'     => 4,
  				  'label'     => __('Checkout Onepage'),
  			  ),
  			  array(
  				  'value'     => 5,
  				  'label'     => __('Cart'),
  			  ),   
  			  array(
  				  'value'     => 6,
  				  'label'     => __('Specified Url (Define custom url)'),
  			  ),
  			  array(
  				  'value'     => 7,
  				  'label'     => __('Other pages (any other page)'),
  			  )                                     
  		  ),
        'note' => $note,
  		));  
      
      $note = '<p class="nm"><small>' . __("Leave empty if it applies to all categories. Write category id if you want to show popup only for specific category. Write category ids separated with comma if you want to apply to more categories.") . '</small></p>';
      $fieldset->addField('category_ids','text',array(
                  'label' => __('Category ids'),
                  'name' =>  'category_ids',
                  'required'=>false,
                  'note' => $note,                  
      ));  
      $note = "<p class='nm'><small>".__('Write page url (e.g. %1). Use \'&#37;\' if you need to use a pattern (e.g. <span style="color:#747474; font-style:italic;">&#37;contact&#37;</span> to show at every page that has \'contact\' in url). Use double comma (e.g. %2) to separate multiple urls.',"<span style='color:#747474; font-style:italic;'>".$_SERVER['HTTP_HOST']."/contacts/</span>","<span style='color:#747474; font-style:italic;'>&#37;domainname&#37;,,&#37;another-url&#37;</span>")."</small></p>";
      $fieldset->addField('specified_url','text',array(
                  'label' => __('Specified Url'),
                  'name' =>  'specified_url',
                  'required'=>false,
                  'note' => $note,                  
      ));          

      $note = "<p class='nm'><small>".__("Use if you want to exclude page or url pattern. Write page url (e.g. %1). Use '&#37;' if you need to use a pattern (e.g. %2 to exclude all pages that have 'quickview' in url). Use double comma (e.g. %3) to separate multiple urls.","<span style='color:#747474; font-style:italic;'>".$_SERVER["HTTP_HOST"]."/contacts/</span>","<span style='color:#747474; font-style:italic;'>%quickview%</span>","<span style='color:#747474; font-style:italic;'>&#37;domainname&#37;,,&#37;another-url&#37;</span>")."</small></p>";                                                                                                                                             
      $fieldset->addField('specified_not_url','text',array(
                  'label' => __('Exclude Url'),
                  'name' =>  'specified_not_url',
                  'required'=>false,
                  'note' => $note,                  
      ));    
            
      $note = '<p class="nm"><small>' . __("Leave empty if it applies to all products. Write product id if you want to show popup only for specific product. Write product ids separated with comma if you want to apply to more products.") . '</small></p>';
      $fieldset->addField('product_ids','text',array(
                  'label' => __('Product ids'),
                  'name' =>  'product_ids',
                  'required'=>false,
                  'note' => $note,
      )); 
      
  		$showWhen = $fieldset->addField('show_when', 'select', array(
  		  'label'     => __('Show when'),
  		  'name'      => 'show_when',
  		  'values'    => array(
  			  array(
  				  'value'     => 1,
  				  'label'     => __('After page is loaded'),
  			  ),
  			  array(
  				  'value'     => 2,
  				  'label'     => __('Define seconds after page is loaded'),
  			  ),
  			  array(
  				  'value'     => 7,
  				  'label'     => __('Define seconds user spent on entire site'),
  			  ),     
  			  array(
  				  'value'     => 8,
  				  'label'     => __('Define seconds after 1st item added to cart'),
  			  ),                   
  			  array(
  				  'value'     => 3,
  				  'label'     => __('After user uses scroller'),
  			  ),
  			  array(
  				  'value'     => 4,
  				  'label'     => __('On click'),
  			  ),
  			  array(
  				  'value'     => 5,
  				  'label'     => __('On hover'),
  			  ),
  			  array(
  				  'value'     => 6,
  				  'label'     => __('Exit intent (When mouse leaves browser window)'),
  			  )                                                                      
  		  )
  		));                

      $note = '<p class="nm"><small>' . __("Close popup automatically when hover out.") . '</small></p>';
      $hoverOut = $fieldset->addField('close_on_hoverout','select',array(
                  'label' => __('Close on hover out'),
                  'name' =>  'close_on_hoverout',
                  'required'=>false,
            		  'values'    => array(
            			  array(
            				  'value'     => 1,
            				  'label'     => __('Yes'),
            			  ),
            
            			  array(
            				  'value'     => 2,
            				  'label'     => __('No'),
            			  )
                   ),                  
                  'note' => $note                
      )); 
            
      $note = '<p class="nm"><small>' . __("Write how many seconds after page loads the popup should appear.") . '</small></p>';
      $secondsDelay = $fieldset->addField('seconds_delay','text',array(
                  'label' => __('Seconds'),
                  'name' =>  'seconds_delay',
                  'required'=>false,
                  'note' => $note,                
      )); 
      
      $note = '<p class="nm"><small>' . __("Max 7200. After 2 hours timer automatically resets to 0 again.") . '</small></p>';
      $totalSecondsDelay = $fieldset->addField('total_seconds_delay','text',array(
                  'label' => __('Seconds'),
                  'name' =>  'total_seconds_delay',
                  'required'=>false,
                  'note' => $note,                
      ));    
      
      $note = '<p class="nm"><small>' . __("Popup will show up only if user adds product to cart. You can define how many seconds after that popup should show up.") . '</small></p>';
      $cartSecondsDelay = $fieldset->addField('cart_seconds_delay','text',array(
                  'label' => __('Seconds'),
                  'name' =>  'cart_seconds_delay',
                  'required'=>false,
                  'note' => $note,                
      ));          
      
      $note = '<p class="nm"><small>' . __("Show popup after scrolling how many px from the top of the page.") . '</small></p>';
      $scrollPx = $fieldset->addField('scroll_px','text',array(
                  'label' => __('Scrolling px'),
                  'name' =>  'scroll_px',
                  'required'=>false,
                  'note' => $note,                 
      ));  
      
      $note = '<p class="nm"><small>' . __('Write click selector e.g. #idName, .className, div input#idName. Read more about selectors <a href="http://www.w3schools.com/jquery/jquery_ref_selectors.asp" target="_blank">here</a>.') . '</small></p>';
      $clickSelector = $fieldset->addField('click_selector','text',array(
                  'label' => __('Click selector'),
                  'name' =>  'click_selector',
                  'required'=>false,
                  'note' => $note,                 
      )); 
      
      $note = '<p class="nm"><small>' . __('Write hover selector e.g. #idName, .className, div input#idName. Read more about selectors <a href="http://www.w3schools.com/jquery/jquery_ref_selectors.asp" target="_blank">here</a>.') . '</small></p>';
      $hoverSelector = $fieldset->addField('hover_selector','text',array(
                  'label' => __('Hover selector'),
                  'name' =>  'hover_selector',
                  'required'=>false,
                  'note' => $note,                 
      ));                           
              
      $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
      $timeFormat = $this->_localeDate->getTimeFormat(\IntlDateFormatter::SHORT);
      $dateFormatIso = $this->_localeDate->getDateTimeFormat(\IntlDateFormatter::SHORT);
            
  		$note = '<p class="nm"><small>' . __('Date is in local store view time.') . '</small></p>';      
      $fieldset->addField('from_date', 'date', array(
          'name' => 'from_date',
          'time' => true,
          'label' => __('From Date'),
          'title' => __('From Date'),
          'image' => $this->getViewFileUrl('images/grid-cal.gif'), 
          'format'       => $dateFormatIso,
          'date_format' => $dateFormat,
          'time_format' => $timeFormat,
          'note' => $note,
      ));
      
  		$note = '<p class="nm"><small>' . __('Date is in local store view time.') . '</small></p>';      
      $fieldset->addField('to_date', 'date', array(
          'name' => 'to_date',
          'time' => true,
          'label' => __('To Date'),
          'title' => __('To Date'),
          'image' => $this->getViewFileUrl('images/grid-cal.gif'), 
          'date_format' => $dateFormat,
          'time_format' => $timeFormat,
          'note' => $note,
      ));
            
      $this->setChild('form_after',$this->getLayout()->createBlock('Magento\Backend\Block\Widget\Form\Element\Dependence')
                      ->addFieldMap($popupType->getHtmlId(),$popupType->getName())
                      ->addFieldMap($image->getHtmlId(),$image->getName())
                      ->addFieldMap($popupContent->getHtmlId(),$popupContent->getName())                
                      ->addFieldMap($url->getHtmlId(),$url->getName())
                      ->addFieldMap($targetPage->getHtmlId(),$targetPage->getName())
                      ->addFieldMap($showWhen->getHtmlId(),$showWhen->getName())
                      ->addFieldMap($secondsDelay->getHtmlId(),$secondsDelay->getName())
                      ->addFieldMap($totalSecondsDelay->getHtmlId(),$totalSecondsDelay->getName())
                      ->addFieldMap($cartSecondsDelay->getHtmlId(),$cartSecondsDelay->getName())                      
                      ->addFieldMap($scrollPx->getHtmlId(),$scrollPx->getName())
                      ->addFieldMap($clickSelector->getHtmlId(),$clickSelector->getName())
                      ->addFieldMap($hoverSelector->getHtmlId(),$hoverSelector->getName())
                      ->addFieldMap($hoverOut->getHtmlId(),$hoverOut->getName())
                      ->addFieldMap($maxWidth->getHtmlId(),$maxWidth->getName())
                      ->addFieldMap($widthUnit->getHtmlId(),$widthUnit->getName())                                               
                      ->addFieldDependence($image->getName(),$popupType->getName(),1)
                      ->addFieldDependence($popupContent->getName(),$popupType->getName(),2)
                      ->addFieldDependence($url->getName(),$popupType->getName(),1)
                      ->addFieldDependence($totalSecondsDelay->getName(),$showWhen->getName(),7)
                      ->addFieldDependence($cartSecondsDelay->getName(),$showWhen->getName(),8)                      
                      ->addFieldDependence($secondsDelay->getName(),$showWhen->getName(),2)
                      ->addFieldDependence($scrollPx->getName(),$showWhen->getName(),3)
                      ->addFieldDependence($clickSelector->getName(),$showWhen->getName(),4)
                      ->addFieldDependence($hoverSelector->getName(),$showWhen->getName(),5)
                      ->addFieldDependence($hoverOut->getName(),$showWhen->getName(),5)
                      ->addFieldDependence($maxWidth->getName(),$widthUnit->getName(),2)                                        
      );       

              
        $this->_eventManager->dispatch('adminhtml_popup_edit_tab_main_prepare_form', ['form' => $form]);

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
        return __('Popup Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Popup Information');
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
}
