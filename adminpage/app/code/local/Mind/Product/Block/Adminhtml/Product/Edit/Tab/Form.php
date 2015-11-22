<?php



class Mind_Product_Block_Adminhtml_Product_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form

{

  function getcategory()

  {

      $codeq = mysql_query("SELECT category_id,title FROM tbl_category WHERE status='1'");

      while($ccc=mysql_fetch_array($codeq))

      {

      $crate[$ccc['category_id']] = $ccc['title'];

      }    

      return $crate;

  }	

  protected function _prepareForm()

  {

      $form = new Varien_Data_Form();

      $this->setForm($form);

      $fieldset = $form->addFieldset('product_form', array('legend'=>Mage::helper('product')->__('Item information')));

     

      $fieldset->addField('title', 'text', array(

          'label'     => Mage::helper('product')->__('Title'),

          'class'     => 'required-entry',

          'required'  => true,

          'name'      => 'title',

      ));

      $fieldset->addField('points', 'text', array(

          'label'     => Mage::helper('product')->__('Points'),

          'class'     => 'required-entry validate-number',

          'required'  => true,

          'name'      => 'points',

      ));

      $fieldset->addField('price', 'text', array(

          'label'     => Mage::helper('product')->__('Price'),

          'class'     => 'required-entry validate-number',

          'required'  => true,

          'name'      => 'price',

      ));

      $fieldset->addField('overall_points', 'text', array(

          'label'     => Mage::helper('product')->__('Overall Points'),

          'class'     => 'required-entry validate-number',

          'required'  => true,

          'name'      => 'overall_points',

      ));

      $fieldset->addField('filename', 'image', array(

          'label'     => Mage::helper('product')->__('File'),

          'required'  => false,

          'name'      => 'filename',

	  ));

      $fieldset->addField('category_id', 'select', array(

          'label'     => Mage::helper('product')->__('Category'),

          'name'      => 'category_id',

          'values'    => $this->getcategory(),

      ));		

      $fieldset->addField('status', 'select', array(

          'label'     => Mage::helper('product')->__('Status'),

          'name'      => 'status',

          'values'    => array(

              array(

                  'value'     => 1,

                  'label'     => Mage::helper('product')->__('Enabled'),

              ),



              array(

                  'value'     => 2,

                  'label'     => Mage::helper('product')->__('Disabled'),

              ),

          ),

      ));

     

      $fieldset->addField('contentarea', 'editor', array(

          'name'      => 'contentarea',

          'label'     => Mage::helper('product')->__('Content'),

          'title'     => Mage::helper('product')->__('Content'),

          'style'     => 'width:700px; height:500px;',

          'wysiwyg'   => true,

          'required'  => true,

      ));

     

      if ( Mage::getSingleton('adminhtml/session')->getProductData() )

      {

          $form->setValues(Mage::getSingleton('adminhtml/session')->getProductData());

          Mage::getSingleton('adminhtml/session')->setProductData(null);

      } elseif ( Mage::registry('product_data') ) {

          $form->setValues(Mage::registry('product_data')->getData());

      }

      return parent::_prepareForm();

  }

}