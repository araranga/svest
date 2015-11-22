<?php

class Mind_Exitbonushistory_Block_Adminhtml_Exitbonushistory_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('exitbonushistoryGrid');
      $this->setDefaultSort('exitbonushistory_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('exitbonushistory/exitbonushistory')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('exitbonushistory_id', array(
          'header'    => Mage::helper('exitbonushistory')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'exitbonushistory_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('exitbonushistory')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('exitbonushistory')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      $this->addColumn('status', array(
          'header'    => Mage::helper('exitbonushistory')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'On Going',
              2 => 'Claimed',
			  3 => 'Declined',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('exitbonushistory')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('exitbonushistory')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('exitbonushistory')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('exitbonushistory')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('exitbonushistory_id');
        $this->getMassactionBlock()->setFormFieldName('exitbonushistory');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('exitbonushistory')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('exitbonushistory')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('exitbonushistory/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('exitbonushistory')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('exitbonushistory')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}