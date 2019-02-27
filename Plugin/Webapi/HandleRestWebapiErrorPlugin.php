<?php

namespace Oyst\OneClick\Plugin\Webapi;

class HandleRestWebapiErrorPlugin
{
    protected $coreRegistry;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->coreRegistry = $coreRegistry;
    }

    public function aroundSendResponse(
        \Magento\Framework\Webapi\Rest\Response $subject,
        \Closure $proceed
    )
    {
        $webapiError = $this->coreRegistry->registry(\Oyst\OneClick\Helper\Constants::WEBAPI_ERROR_REGISTRY_KEY);
        if ($webapiError) {
            $subject->setBody(json_encode($webapiError));
            $subject->setHttpResponseCode(\Magento\Framework\Webapi\Exception::HTTP_BAD_REQUEST);
        }

        return $proceed();
    }
}