<?php
/**
 *
 * Copyright © 2017 Gaggle. All rights reserved.
 */
namespace Gaggle\Cartcreator\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{

	/**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;

    /**
     * @var \Magento\Framework\App\Cache\StateInterface
     */
    protected $_cacheState;

    /**
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    protected $_cacheFrontendPool;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        ResultFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheState = $cacheState;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Flush cache storage
     *
     */
    public function execute()
    {
        $cart = $this->_objectManager->get('Magento\Checkout\Model\Cart');
        
        if($id = $this->getRequest()->getParam('id')){
            $cartModel = $this->_objectManager->get('Gaggle\Cartcreator\Model\Cart');
            $cartModel->load($id);
            $data = $cartModel->getDetails();
            $data = json_decode($data,true);
            foreach($data as $item){
               try{
                    if($item['code']=='simple'){
                         $product = $this->_objectManager->create('Magento\Catalog\Model\ProductFactory')->create()->load($item['id']);
                        $params = [];
                        $params['qty'] = $item['qty'];
                        $cart->addProduct($product, $params);
                        $cart->save();
                        //'super_attribute' => $options
                    }
                    if($item['code']=='configurable'){
                        $product = $this->_objectManager->create('Magento\Catalog\Model\ProductFactory')->create()->load($item['id']);
                        $productAttributeOptions = $product->getTypeInstance(true)->getConfigurableAttributesAsArray($product);
                        $simpleProduct = $this->_objectManager->create('Magento\Catalog\Model\ProductFactory')->create()->load($item['child']);
                      
                        $params = [];
                        $params['product'] = $product->getId();
                        $params['qty'] = $item['qty'];
                        $options = [];
                        foreach($productAttributeOptions as $option){
                            $options[$option['attribute_id']] =  $simpleProduct->getData($option['attribute_code']);
                        }
                        $params['super_attribute'] = $options;
                        $cart->addProduct($product, $params);
                        $cart->save();
                        //$cart->addProductsByIds($item['child']);
                    }
                }
                catch(\Exception $e){
                    $this->messageManager->addError($e->getMessage());
                }
            }

        }
        //$cart->save();

        return $this->resultPageFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('checkout');
        
    }
}
