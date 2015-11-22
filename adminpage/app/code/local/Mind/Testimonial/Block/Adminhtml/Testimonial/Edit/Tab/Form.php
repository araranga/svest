<?php



class Mind_Testimonial_Block_Adminhtml_Testimonial_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form

{

  protected function _prepareForm()

  {

      $form = new Varien_Data_Form();

      $this->setForm($form);

      $fieldset = $form->addFieldset('testimonial_form', array('legend'=>Mage::helper('testimonial')->__('Item information')));

     

      $fieldset->addField('title', 'text', array(

          'label'     => Mage::helper('testimonial')->__('Title'),

          'class'     => 'required-entry',

          'required'  => true,

          'name'      => 'title',

      ));



      $fieldset->addField('filename', 'image', array(

          'label'     => Mage::helper('testimonial')->__('File'),

          'required'  => false,

          'name'      => 'filename',

	  ));

		$fieldset->addField('created_time', 'date', array(

		'label'     => Mage::helper('testimonial')->__('Purchase Date'),                    

		'name'      => 'created_time',

		'image'     => $this->getSkinUrl('images/grid-cal.gif'),

		'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)

		));	  

      $fieldset->addField('status', 'select', array(

          'label'     => Mage::helper('testimonial')->__('Status'),

          'name'      => 'status',

          'values'    => array(

              array(

                  'value'     => 1,

                  'label'     => Mage::helper('testimonial')->__('Enabled'),

              ),



              array(

                  'value'     => 2,

                  'label'     => Mage::helper('testimonial')->__('Disabled'),

              ),

          ),

      ));

     

      $fieldset->addField('contentarea', 'editor', array(

          'name'      => 'contentarea',

          'label'     => Mage::helper('testimonial')->__('Content'),

          'title'     => Mage::helper('testimonial')->__('Content'),

          'wysiwyg'   => true,

          'required'  => true,

      ));

      $fieldset->addField('teaser', 'textarea', array(

          'name'      => 'teaser',

          'label'     => Mage::helper('testimonial')->__('Teaser'),

          'wysiwyg'   => false,

          'required'  => true,

      ));     

      if ( Mage::getSingleton('adminhtml/session')->getTestimonialData() )

      {

          $form->setValues(Mage::getSingleton('adminhtml/session')->getTestimonialData());

          Mage::getSingleton('adminhtml/session')->setTestimonialData(null);

      } elseif ( Mage::registry('testimonial_data') ) {

          $form->setValues(Mage::registry('testimonial_data')->getData());

      }

      return parent::_prepareForm();

  }

}