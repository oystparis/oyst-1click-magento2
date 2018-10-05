<?php

namespace Oyst\OneClick\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.3', '<')) {
            $data = [];
            $statuses = [
                \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_CANCELED => __('Oyst OneClick Canceled'),
                \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_WAITING_VALIDATION => __('Oyst OneClick Payment Waiting Validation'),
                \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_CAPTURED => __('Oyst OneClick Payment Captured'),
                \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_WAITING_TO_CAPTURE => __('Oyst OneClick Payment Waiting to Capture'),
                \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_TO_CAPTURE => __('Oyst OneClick Payment to Capture'),
            ];
            foreach ($statuses as $code => $info) {
                $data[] = ['status' => $code, 'label' => $info];
            }

            $setup->getConnection()->insertArray(
                $setup->getTable('sales_order_status'),
                ['status', 'label'],
                $data
            );

            $data = [];
            foreach ($statuses as $code => $info) {
                if ($code == \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_CANCELED) {
                    $state = \Magento\Sales\Model\Order::STATE_CANCELED;
                } elseif ($code == \Oyst\OneClick\Helper\Constants::OYST_ORDER_STATUS_PAYMENT_WAITING_VALIDATION) {
                    $state = \Magento\Sales\Model\Order::STATE_NEW;
                } else {
                    $state = \Magento\Sales\Model\Order::STATE_PROCESSING;
                }

                $data[] = ['status' => $code, 'state' => $state, 'default' => 0, 'visible_on_front' => 1];
            }

            $setup->getConnection()->insertArray(
                $setup->getTable('sales_order_status_state'),
                ['status', 'state', 'is_default', 'visible_on_front'],
                $data
            );
        }

        $setup->endSetup();
    }
}
