<?php
class Mind_Category_Block_Category extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getCategory()     
     { 
        if (!$this->hasData('category')) {
            $this->setData('category', Mage::registry('category'));
        }
        return $this->getData('category');
        
    }
}