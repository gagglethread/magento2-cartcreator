<?php
/**
 *
 * Copyright © 2017 Gaggle. All rights reserved.
 */
namespace Gaggle\Cartcreator\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{


    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $resultPage;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        
    
        /** @var \Magento\Framework\Controller\Result\Raw $result */
       /* $this->_initAction()->_setActiveMenu(
            'Gaggle_Cartcreator::index_index'
        )->_addBreadcrumb(
            __('Cart'),
            __('Cart')
        );*/
        $this->resultPage = $this->resultPageFactory->create();  
        $this->resultPage->setActiveMenu('Gaggle_Cartcreator::index_index');
        $this->resultPage ->getConfig()->getTitle()->set((__('Cart')));
        return $this->resultPage;
       
    }
}
