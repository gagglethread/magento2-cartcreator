<?php
namespace Gaggle\Cartcreator\Block\Adminhtml;
class Cart extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
       
        $this->_controller = 'adminhtml_cart';/*block grid.php directory*/
        $this->_blockGroup = 'Gaggle_Cartcreator';
        $this->_headerText = __('Cart');
        parent::_construct();
		$this->removeButton('add');
    }
}
