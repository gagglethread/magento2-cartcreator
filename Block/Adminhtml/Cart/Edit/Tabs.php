<?php
namespace Gaggle\Cartcreator\Block\Adminhtml\Cart\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_cart_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Cart Information'));
    }
}