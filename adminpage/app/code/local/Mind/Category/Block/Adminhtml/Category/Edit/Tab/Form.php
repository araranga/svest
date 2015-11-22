<?php



class Mind_Category_Block_Adminhtml_Category_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form

{

  protected function _prepareForm()

  {

      $form = new Varien_Data_Form();

      $this->setForm($form);

      $fieldset = $form->addFieldset('category_form', array('legend'=>Mage::helper('category')->__('Item information')));

     

      $fieldset->addField('title', 'text', array(

          'label'     => Mage::helper('category')->__('Title'),

          'class'     => 'required-entry',

          'required'  => true,

          'name'      => 'title',

      ));



      $fieldset->addField('filename', 'image', array(

          'label'     => Mage::helper('category')->__('File'),

          'required'  => false,

          'name'      => 'filename',

	  ));

		

      $fieldset->addField('status', 'select', array(

          'label'     => Mage::helper('category')->__('Status'),

          'name'      => 'status',

          'values'    => array(

              array(

                  'value'     => 1,

                  'label'     => Mage::helper('category')->__('Enabled'),

              ),



              array(

                  'value'     => 2,

                  'label'     => Mage::helper('category')->__('Disabled'),

              ),

          ),

      ));

     

      $fieldset->addField('contentarea', 'editor', array(

          'name'      => 'contentarea',

          'label'     => Mage::helper('category')->__('Content'),

          'title'     => Mage::helper('category')->__('Content'),

          'style'     => 'width:700px; height:500px;',

          'wysiwyg'   => true,

          'required'  => true,

      ));

     

      if ( Mage::getSingleton('adminhtml/session')->getCategoryData() )

      {

          $form->setValues(Mage::getSingleton('adminhtml/session')->getCategoryData());

          Mage::getSingleton('adminhtml/session')->setCategoryData(null);

      } elseif ( Mage::registry('category_data') ) {

          $form->setValues(Mage::registry('category_data')->getData());

      }

      return parent::_prepareForm();

  }

}