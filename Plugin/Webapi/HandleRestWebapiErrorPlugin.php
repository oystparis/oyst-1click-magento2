<?php

namespace Oyst\OneClick\Plugin\Webapi;

class HandleRestWebapiErrorPlugin
{
    protected $coreRegistry;

    protected $request;

    protected $helperData;

    protected $responseFactory;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Webapi\Rest\Request $request,
        \Oyst\OneClick\Helper\Data $helperData,
        \Magento\Framework\HTTP\PhpEnvironment\ResponseFactory $responseFactory
    )
    {
        $this->coreRegistry = $coreRegistry;
        $this->request = $request;
        $this->helperData = $helperData;
        $this->responseFactory = $responseFactory;
    }

    public function aroundSendResponse(
        \Magento\Framework\Webapi\Rest\Response $subject,
        \Closure $proceed
    )
    {
        if ($this->helperData->isWebApiRequestConcernOystOneClick($this->request)) {
            $response = $this->responseFactory->create();

            if ($subject->isException()) {
                $e = $subject->getException()[0];
                $response->setBody(json_encode([
                    'platform' => \Oyst\OneClick\Helper\Constants::WEBAPI_ERROR_PLATFORM,
                    'code' => $this->helperData->mapMagentoExceptionCodeToOystErrorCode($e->getCode()),
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]));
                $response->setHttpResponseCode(\Magento\Framework\Webapi\Exception::HTTP_BAD_REQUEST);
            } else {
                $response->setBody($subject->getBody());
                $response->setHttpResponseCode($subject->getHttpResponseCode());
            }

            $response->setHeaders($subject->getHeaders());
            $response->sendResponse();
        } else {
            return $proceed();
        }
    }
}