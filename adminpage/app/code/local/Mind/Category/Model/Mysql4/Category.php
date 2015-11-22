<?php

class Mind_Category_Model_Mysql4_Category extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the category_id refers to the key field in your database table.
        $this->_init('category/category', 'category_id');
    }
}