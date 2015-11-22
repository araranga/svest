<?php

class Mind_Exitbonushistory_Block_Adminhtml_Exitbonushistory_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('exitbonushistory_form', array('legend'=>Mage::helper('exitbonushistory')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('exitbonushistory')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('exitbonushistory')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('exitbonushistory')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('exitbonushistory')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('exitbonushistory')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('exitbonushistory')->__('Content'),
          'title'     => Mage::helper('exitbonushistory')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getExitbonushistoryData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getExitbonushistoryData());
          Mage::getSingleton('adminhtml/session')->setExitbonushistoryData(null);
      } elseif ( Mage::registry('exitbonushistory_data') ) {
          $form->setValues(Mage::registry('exitbonushistory_data')->getData());
      }
      return parent::_prepareForm();
  }
}