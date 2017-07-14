<?php
/**
 * Copyright © 2017 Gaggle. All rights reserved.
 */
namespace Gaggle\Cartcreator\Model\ResourceModel;

/**
 * Connector resource
 */
class Cart extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('admin_cart', 'id');
    }

  
}
