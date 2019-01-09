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
    protected $integrationService;
    
    protected $oauthService;
    
    public function __construct(
        \Magento\Integration\Model\IntegrationService $integrationService,
        \Magento\Integration\Model\OauthService $oauthService
    )
    {
        $this->integrationService = $integrationService;
        $this->oauthService = $oauthService;
    }
    
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.1') < 0) {
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

        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            $integrationData = [
                'name' => \Oyst\OneClick\Helper\Constants::INTEGRATION_NAME,
                'resource' => [
                    'Oyst_OneClick::apis',
                    'Oyst_OneClick::config',
                    'Oyst_OneClick::checkout',
                    'Oyst_OneClick::order',
                ],
            ];

            $integration = $this->integrationService->create($integrationData);
            $this->oauthService->createAccessToken($integration->getConsumerId());
            $integration->setStatus(\Magento\Integration\Model\Integration::STATUS_ACTIVE)->save();
        }

        if (version_compare($context->getVersion(), '2.0.0') < 0) {
            $setup->getConnection()->addColumn(
                $setup->getTable('quote'),
                'oyst_extra_data',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 256,
                    'comment' => 'Oyst Id',
                    'nullable' => true,
                ]
            );

            $setup->getConnection()->addColumn(
                $setup->getTable('sales_order'),
                'oyst_extra_data',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 256,
                    'comment' => 'Oyst Id',
                    'nullable' => true,
                ]
            );
        }
        
        $setup->endSetup();
    }
}
