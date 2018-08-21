<?php

namespace Oyst\OneClick\Controller\Checkout;

class Redirect extends \Magento\Framework\App\Action\Action
{
    protected $customerSession;

    protected $checkoutSession;

    protected $orderFactory;

    protected $orderCustomerService;

    protected $logger;

    protected $scopeConfig;

    protected $customerRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Api\OrderCustomerManagementInterface $orderCustomerService,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
        $this->customerSession = $customerSession;
        $this->orderCustomerService = $orderCustomerService;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->customerRepository = $customerRepository;
    }

    public function execute()
    {
        $quoteId = $this->checkoutSession->getOystOneClickQuoteId(true);
        $order = $this->orderFactory->create()->load($quoteId, 'quote_id');

        $this->checkoutSession->setLastQuoteId($quoteId);
        $this->checkoutSession->setLastSuccessQuoteId($quoteId);
        $this->checkoutSession->setLastOrderId($order->getId());
        $this->checkoutSession->setLastRealOrderId($order->getIncrementId());
        $this->checkoutSession->setLastOrderStatus($order->getStatus());

        try {
            if ($order->getCustomerId()) {
                if (!$this->customerSession->isLoggedIn()) {
                    $this->customerSession->loginById($order->getCustomerId());
                }
            } else {
                if ($this->scopeConfig->isSetFlag(\Oyst\OneClick\Helper\Constants::CONFIG_PATH_OYST_CONFIG_CREATE_CUSTOMER_ON_OYST_ORDER)) {
                    $account = $this->handleCustomerAccountCreationFromOrder($order);
                    $this->customerSession->loginById($account->getId());
                }
            }
        } catch (\Exception $e) {
            // Handle non blocking behaviour
            $this->logger->critical($e);
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('checkout/onepage/success');
        return $resultRedirect;
    }

    protected function handleCustomerAccountCreationFromOrder($order)
    {
        $account = $this->orderCustomerService->create($order->getId());

        if ($account->getFirstname() != $order->getCustomerFirstname()
         || $account->getLastname() != $order->getCustomerLastname()) {
            $account->setLastname($order->getCustomerLastname());
            $account->setFirstname($order->getCustomerFirstname());
            $this->customerRepository->save($account);
        }

        return $account;
    }
}