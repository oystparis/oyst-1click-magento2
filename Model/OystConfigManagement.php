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

    /**
     * @var \Oyst\OneClick\Model\OystConfig\Ecommerce\Builder
     */
    protected $oystConfigEcommerceBuilder;

    /**
     * @var \Magento\Shipping\Model\Config\Source\Allmethods
     */
    protected $configShippingMethods;

    /**
     * @var \Magento\Directory\Model\AllowedCountries
     */
    protected $configAllowedCountries;

    /**
     * @var \Magento\Directory\Model\ResourceModel\Country\CollectionFactory
     */
    protected $countryCollectionFactory;

    /**
     * @var \Magento\Sales\Model\Order\Config
     */
    protected $orderConfig;

    public function __construct(
        \Magento\Config\Model\PreparedValueFactory $preparedValueFactory,
        \Magento\Framework\App\Cache\Manager $cacheManager,
        \Oyst\OneClick\Model\OystConfig\Ecommerce\Builder $oystConfigEcommerceBuilder,
        \Magento\Shipping\Model\Config\Source\Allmethods $configShippingMethods,
        \Magento\Directory\Model\AllowedCountries $configAllowedCountries,
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        \Magento\Sales\Model\Order\Config $orderConfig
    )
    {
        $this->preparedValueFactory = $preparedValueFactory;
        $this->cacheManager = $cacheManager;
        $this->oystConfigEcommerceBuilder = $oystConfigEcommerceBuilder;
        $this->configShippingMethods = $configShippingMethods;
        $this->configAllowedCountries = $configAllowedCountries;
        $this->countryCollectionFactory = $countryCollectionFactory;
        $this->orderConfig = $orderConfig;
    }

    public function saveOystConfig(\Oyst\OneClick\Api\Data\OystConfig\OystInterface $oystConfig)
    {
        /* @var \Magento\Framework\App\Config\Value $backendModel */
        $backendModel = $this->preparedValueFactory->create(
            HelperConstants::CONFIG_PATH_OYST_CONFIG_SCRIPT_TAG, $oystConfig->getScriptTag(), 'default'
        );
        if ($backendModel instanceof \Magento\Framework\App\Config\Value) {
            $resourceModel = $backendModel->getResource();
            $resourceModel->save($backendModel);
        }

        $backendModel = $this->preparedValueFactory->create(
            HelperConstants::CONFIG_PATH_OYST_CONFIG_MERCHANT_ID, $oystConfig->getMerchantId(), 'default'
        );
        if ($backendModel instanceof \Magento\Framework\App\Config\Value) {
            $resourceModel = $backendModel->getResource();
            $resourceModel->save($backendModel);
        }

        $endpoints = [];
        foreach($oystConfig->getEndpoints() as $endpoint) {
            $endpoints[] = [
                'url' => $endpoint->getUrl(),
                'type' => $endpoint->getType(),
                'api_key' => $endpoint->getApiKey(),
            ];
        }

        $backendModel = $this->preparedValueFactory->create(
            HelperConstants::CONFIG_PATH_OYST_CONFIG_ENDPOINTS, json_encode($endpoints), 'default'
        );
        if ($backendModel instanceof \Magento\Framework\App\Config\Value) {
            $resourceModel = $backendModel->getResource();
            $resourceModel->save($backendModel);
        }

        $this->cacheManager->clean([\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER]);

        return true;
    }

    public function getEcommerceConfig()
    {
        $carriers = $this->configShippingMethods->toOptionArray(true);
        array_shift($carriers);

        $allowedCountryCodes = $this->configAllowedCountries->getAllowedCountries();
        $countries = $this->countryCollectionFactory->create()->addCountryCodeFilter($allowedCountryCodes)->toOptionArray();
        array_shift($countries);

        $orderStatuses = $this->orderConfig->getStatuses();

        return $this->oystConfigEcommerceBuilder->buildOystConfigEcommerce(
            $carriers,
            $countries,
            $orderStatuses
        );
    }
}

