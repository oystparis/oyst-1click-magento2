<?php

namespace Oyst\OneClick\Model;

use Oyst\OneClick\Helper\Constants as HelperConstants;

class OystConfigManagement implements \Oyst\OneClick\Api\OystConfigManagementInterface
{
    /**
     * @var \Magento\Config\Model\PreparedValueFactory
     */
    protected $preparedValueFactory;

    /**
     * @var \Magento\Framework\App\Cache\Manager
     */
    protected $cacheManager;

    public function __construct(
        \Magento\Config\Model\PreparedValueFactory $preparedValueFactory,
        \Magento\Framework\App\Cache\Manager $cacheManager
    )
    {
        $this->preparedValueFactory = $preparedValueFactory;
        $this->cacheManager = $cacheManager;
    }

    public function saveOystConfigScriptTag($scriptTag)
    {
        /* @var \Magento\Framework\App\Config\Value $backendModel */
        $backendModel = $this->preparedValueFactory->create(
            HelperConstants::CONFIG_PATH_OYST_CONFIG_SCRIPT_TAG, $scriptTag, 'default'
        );
        if ($backendModel instanceof \Magento\Framework\App\Config\Value) {
            $resourceModel = $backendModel->getResource();
            $resourceModel->save($backendModel);
        }

        $this->cacheManager->clean([\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER]);

        return true;
    }
}

