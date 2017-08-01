<?php
/**
 *
 * Copyright © 2017 Gaggle. All rights reserved.
 */
namespace Gaggle\Cartcreator\Controller\Adminhtml\Cart;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Links extends Action
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

    public function execute()
    {
        
        $this->resultPage = $this->resultPageFactory->create();  
        $this->resultPage->setActiveMenu('Gaggle_Links::gaggle_cartcreator_links');
        $this->resultPage ->getConfig()->getTitle()->set((__('Cart Links')));
        return $this->resultPage;
    }
}