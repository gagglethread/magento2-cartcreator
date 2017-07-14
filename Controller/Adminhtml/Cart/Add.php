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
class Add extends \Magento\Catalog\Controller\Adminhtml\Product
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
        $data = $this->authSession->getCart()?:[];
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $productDeleted = 0;
        $productAdded = 0;
        foreach ($collection->getItems() as $product) {
            $productAdded++;
            $data[] = ['code'=>$product->getTypeId(),'id'=>$product->getId(),'qty'=>1];
        }

        $this->authSession->setCart($data);
        $this->messageManager->addSuccess(
            __('A total of %1 record(s) have been added.', $productAdded)
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('catalog/product/index');
       
    }
}
