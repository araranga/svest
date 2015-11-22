<?php

class Mind_Rate_Block_Adminhtml_Rate_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('rate_form', array('legend'=>Mage::helper('rate')->__('Item information')));
     
      $fieldset->addField('rate_name', 'text', array(
          'label'     => Mage::helper('rate')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'rate_name',
      ));
      $fieldset->addField('rate_start', 'text', array(
          'label'     => Mage::helper('rate')->__('Payin'),
          'class'     => 'required-entry validate-number',
          'required'  => true,
          'name'      => 'rate_start',
      ));

      $fieldset->addField('rate_end', 'text', array(
          'label'     => Mage::helper('rate')->__('Payout Main'),
          'class'     => 'required-entry validate-number',
          'required'  => true,
          'name'      => 'rate_end',
      ));
      $fieldset->addField('rate_referbonus', 'text', array(
          'label'     => Mage::helper('rate')->__('Referrer Bonus'),
          'class'     => 'required-entry validate-number',
          'required'  => true,
          'name'      => 'rate_referbonus',
      ));	  
      $fieldset->addField('rate_bonus', 'text', array(
          'label'     => Mage::helper('rate')->__('Payout Bonus'),
          'class'     => 'required-entry validate-number',
          'required'  => true,
          'name'      => 'rate_bonus',
      ));
      $fieldset->addField('rate_req', 'select', array(
          'label'     => Mage::helper('rate')->__('Level'),
          'name'      => 'rate_req',
          'values'    => array(
              array(
                  'value'     => 2,
                  'label'     => Mage::helper('rate')->__('Level 2'),
              ),

              array(
                  'value'     => 3,
                  'label'     => Mage::helper('rate')->__('Level 3'),
              ),
              array(
                  'value'     => 4,
                  'label'     => Mage::helper('rate')->__('Level 4'),
              ),              
          ),
      ));
     
      $fieldset->addField('bonus', 'select', array(
          'label'     => Mage::helper('rate')->__('With bonus table?'),
          'name'      => 'bonus',
          'values'    => array(
              array(
                  'value'     => 'yes',
                  'label'     => Mage::helper('rate')->__('Yes'),
              ),

              array(
                  'value'     => 'no',
                  'label'     => Mage::helper('rate')->__('No'),
              ),           
          ),
      ));

     
      $fieldset->addField('bonus_limit', 'select', array(
          'label'     => Mage::helper('rate')->__('Bonus table limit? If bonus table is set to "Yes"'),
          'name'      => 'bonus_limit',
          'values'    => array(
              array(
                  'value'     => '2',
                  'label'     => Mage::helper('rate')->__('2 Bonus Table'),
              ),

              array(
                  'value'     => '3',
                  'label'     => Mage::helper('rate')->__('3 Bonus Table'),
              ), 
              array(
                  'value'     => '4',
                  'label'     => Mage::helper('rate')->__('4 Bonus Table'),
              ),
              array(
                  'value'     => '5',
                  'label'     => Mage::helper('rate')->__('5 Bonus Table'),
              ),			  
              array(
                  'value'     => '100',
                  'label'     => Mage::helper('rate')->__('Unli Bonus'),
              ),                        
          ),
      ));




      $fieldset->addField('activated', 'select', array(
          'label'     => Mage::helper('rate')->__('Status'),
          'name'      => 'activated',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('rate')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('rate')->__('Disabled'),
              ),
          ),
      ));
     
     
      if ( Mage::getSingleton('adminhtml/session')->getRateData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getRateData());
          Mage::getSingleton('adminhtml/session')->setRateData(null);
      } elseif ( Mage::registry('rate_data') ) {
          $form->setValues(Mage::registry('rate_data')->getData());
      }
      return parent::_prepareForm();
  }
}