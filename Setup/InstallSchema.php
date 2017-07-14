<?php
/**
 * Copyright © 2017 Gaggle. All rights reserved.
 */

namespace Gaggle\Cartcreator\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
	
        $installer = $setup;

        $installer->startSetup();

		/**
         * Create table 'connector_connector'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('admin_cart')
        )
		->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'connector_connector'
        )
		->addColumn(
            'details',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'Details'
        )
		
        ->setComment(
            'Gaggle Cart'
        );
		
		$installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
