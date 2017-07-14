<?php
/**
 *
 * Copyright © 2017 Gaggle. All rights reserved.
 */
namespace Gaggle\Cartcreator\Controller\Adminhtml\Cart;
use Magento\Framework\Controller\ResultFactory;
use Magento\Catalog\Controller\Adminhtml\Product\Builder;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
class Getlink extends \Magento\Catalog\Controller\Adminhtml\Product
{

    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

     /**
     * @var authSession
     */
    protected $authSession;


    /**
     * @param Context $context
     * @param Builder $productBuilder
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Builder $productBuilder,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Magento\Backend\Model\Auth\Session $authSession
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->authSession = $authSession;
        parent::__construct($context, $productBuilder);
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
    	$cartDetails = [];
    	$data = $this->getRequest()->getParam('cart');
    	//$data = $this->authSession->getCart()?:[];
       
        $data = json_encode($data);
        $cartModel = $this->_objectManager->get('Gaggle\Cartcreator\Model\Cart');
        $urlManager = $this->_objectManager->get('Magento\Framework\Url');
        $cartModel->setDetails($data)->save();
       	$this->authSession->setCart(false);
        $this->messageManager->addSuccess(
            __('Cart Link :'.$urlManager->getUrl('cartcreator/index/index',['id'=>$cartModel->getId(),'_nosid' => true ]))
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('catalog/product/index');
       
    }
}
