<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Gaggle\Cartcreator\Model\ResourceModel\Cart;

/**
 * Connectors Collection
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Gaggle\Cartcreator\Model\Cart', 'Gaggle\Cartcreator\Model\ResourceModel\Cart');
    }
}
