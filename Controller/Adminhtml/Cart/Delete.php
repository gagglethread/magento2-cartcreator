<?php
namespace Gaggle\Cartcreator\Controller\Adminhtml\Cart;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        
		$id = $this->getRequest()->getParam('id');
		try {
				$cart = $this->_objectManager->get('Gaggle\Cartcreator\Model\Cart')->load($id);
				$cart->delete();
                $this->messageManager->addSuccess(
                    __('Cart Link Delete successfully !')
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
	    $this->_redirect('*/*/links');
    }
}
