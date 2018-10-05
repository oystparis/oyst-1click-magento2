<?php

namespace Oyst\OneClick\Model\Payment\Method;

class OneClick extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_OYST_ONECLICK_CODE = 'oyst_oneclick';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_OYST_ONECLICK_CODE;

    public function isActive($storeId = null)
    {
        $path = 'oyst_oneclick/general/enabled';
        $result = $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
        return (bool)(int)$result;
    }

    public function capture(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        if ($payment instanceof \Magento\Sales\Model\Order\Payment) {

        }
    }

    public function refund(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        if ($payment instanceof \Magento\Sales\Model\Order\Payment) {

        }
    }

    protected function callGatewayApi(array $endpoint, $oystOrderId)
    {
        $httpHeaders = new \Zend\Http\Headers();
        $httpHeaders->addHeaders([
            'Authorization' => 'Bearer ' . $endpoint['api_key'],
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $request = new \Zend\Http\Request();
        $request->setHeaders($httpHeaders);
        $request->setUri($endpoint['url']);
        $request->setMethod(\Zend\Http\Request::METHOD_POST);
        $request->setPost(new \Zend\Stdlib\Parameters([
            'oystOrder' => json_encode(['oyst_id' => $oystOrderId])
        ]));

        $client = new \Zend\Http\Client();
        $options = [
            'adapter'   => 'Zend\Http\Client\Adapter\Curl',
            'curloptions' => [CURLOPT_FOLLOWLOCATION => true],
            'maxredirects' => 0,
            'timeout' => 100
        ];
        $client->setOptions($options);

        $response = $client->send($request);

        return $response->getBody();
    }
}