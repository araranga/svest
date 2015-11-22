<?php

class Mind_Logo_Block_Adminhtml_Logo_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('logo_form', array('legend'=>Mage::helper('logo')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('logo')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('image', 'image', array(
          'label'     => Mage::helper('logo')->__('Logo'),
          'required'  => false,
          'name'      => 'image',
	  ));

     
      $fieldset->addField('header', 'editor', array(
          'name'      => 'header',
          'label'     => Mage::helper('logo')->__('Header'),
          'title'     => Mage::helper('logo')->__('Header'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => true,
          'required'  => true,
      ));
      $fieldset->addField('footer', 'editor', array(
          'name'      => 'footer',
          'label'     => Mage::helper('logo')->__('Footer'),
          'title'     => Mage::helper('logo')->__('Footer'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => true,
          'required'  => true,
      ));
     


     
      if ( Mage::getSingleton('adminhtml/session')->getLogoData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getLogoData());
          Mage::getSingleton('adminhtml/session')->setLogoData(null);
      } elseif ( Mage::registry('logo_data') ) {
          $form->setValues(Mage::registry('logo_data')->getData());
      }
      return parent::_prepareForm();
  }
}