<?php

namespace Oyst\OneClick\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        
        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            $setup->getConnection()->addColumn(
                $setup->getTable('quote'), 
                'oyst_id', 
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Oyst Id',
                    'nullable' => true,
                ]
            );
            
            $setup->getConnection()->addColumn(
                $setup->getTable('sales_order'), 
                'oyst_id', 
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' => 'Oyst Id',
                    'nullable' => true,
                ]
            );
        }
        
        $setup->endSetup();
    }
}
