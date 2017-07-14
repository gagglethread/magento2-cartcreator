<?php
/**
 * Copyright © 2017 Gaggle . All rights reserved.
 */
namespace Gaggle\Cartcreator\Block\Adminhtml\Index;
class Index extends \Magento\Backend\Block\Template
{

	/**
     * @var authSession
     */
    protected $authSession;
	
    protected $_objectManager;
	public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = [],
        \Magento\Backend\Model\Auth\Session $authSession,
         \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
    	$this->authSession = $authSession;
        $this->_objectManager = $objectManager;
        parent::__construct($context, $data);
        
    }

    public function getCart(){
    	return $this->authSession->getCart()?:[];
    }

    public function getProduct($id){
        $product = $this->_objectManager->create('Magento\Catalog\Model\Product');
        return $product->load($id);
    }

    public function getChildProducts($product){
        return $product->getTypeInstance()->getUsedProducts($product);
    }

    public function getFormKey(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
        $formKey = $objectManager->get('Magento\Framework\Data\Form\FormKey'); 
        return $formKey->getFormKey();
    }
}
