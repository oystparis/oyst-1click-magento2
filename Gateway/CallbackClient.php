<?php

namespace Oyst\OneClick\Gateway;

/**
 * This class has for purpose to expose callback API :
 * 2 services are currently handled :
 *  - capture (this is supposed to be called only if merchant config is on manual capture)
 *  - refund
 */

class CallbackClient
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function callGatewayCallbackApi($endpointType, array $oystOrderAmounts)
    {
        $endpoint = $this->getEndpoint($endpointType);

        $httpHeaders = new \Zend\Http\Headers();
        $httpHeaders->addHeaders([
            'Authorization' => 'Bearer ' . $endpoint['api_key'],
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $client = new \Zend\Http\Client();
        $options = [
            'adapter'   => 'Zend\Http\Client\Adapter\Curl',
            'curloptions' => [CURLOPT_FOLLOWLOCATION => true],
            'maxredirects' => 0,
            'timeout' => 100
        ];
        $client->setOptions($options);
        $client->setRawBody(json_encode([
            'orderAmounts' => $oystOrderAmounts
        ]));
        $client->setHeaders($httpHeaders);
        $client->setUri($this->getEndpointUrl($endpoint['url']));
        $client->setMethod(\Zend\Http\Request::METHOD_POST);

        $response = $client->send();

        return $response->getBody();
    }

    protected function getEndpoint($endpointType)
    {
        $endpoints = json_decode($this->scopeConfig->getValue('oyst_oneclick/general/endpoints'), true);
        foreach ($endpoints as $endpoint) {
            if ($endpoint['type'] == $endpointType) {
                return $endpoint;
            }
        }

        throw new \Exception('Invalid endpoint type : '.$endpointType);
    }

    protected function getEndpointUrl($endpointUrl)
    {
        return str_replace(
            \Oyst\OneClick\Helper\Constants::MERCHANT_ID_PLACEHOLDER,
            $this->scopeConfig->getValue('oyst_oneclick/general/merchant_id'),
            $endpointUrl
        );
    }
}