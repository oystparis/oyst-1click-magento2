<?php

namespace Oyst\OneClick\Controller\Checkout;

class Redirect extends \Magento\Framework\App\Action\Action
{
    protected $customerSession;

    protected $checkoutSession;

    protected $oystOrderManagement;

    protected $quoteRepository;

    protected $orderCustomerService;

    protected $logger;

    protected $scopeConfig;

    protected $customerRepository;

    protected $orderEmailSender;

    protected $helperData;

    protected $newsletterSubscriberFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Api\OrderCustomerManagementInterface $orderCustomerService,
        \Oyst\OneClick\Model\OystOrderManagement $oystOrderManagement,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderEmailSender,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Oyst\OneClick\Helper\Data $helperData,
        \Magento\Newsletter\Model\SubscriberFactory $newsletterSubscriberFactory
    )
    {
        parent::__construct($context);
        $this->checkoutSession = $checkoutSession;
        $this->oystOrderManagement = $oystOrderManagement;
        $this->quoteRepository = $quoteRepository;
        $this->customerSession = $customerSession;
        $this->orderCustomerService = $orderCustomerService;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->customerRepository = $customerRepository;
        $this->orderEmailSender = $orderEmailSender;
        $this->helperData = $helperData;
        $this->newsletterSubscriberFactory = $newsletterSubscriberFactory;
    }

    public function execute()
    {
        $quoteId = $this->checkoutSession->getOystOneClickQuoteId(true);
        $quote = $this->quoteRepository->getActive($quoteId);
        $order = $this->oystOrderManagement->getMagentoOrderByQuoteId($quote->getId());

        $this->checkoutSession->setLastQuoteId($quoteId);
        $this->checkoutSession->setLastSuccessQuoteId($quoteId);
        $this->checkoutSession->setLastOrderId($order->getId());
        $this->checkoutSession->setLastRealOrderId($order->getIncrementId());
        $this->checkoutSession->setLastOrderStatus($order->getStatus());

        $this->handleDeactivateQuote($quote);
        $this->handleCustomerRedirectFromOrder($order);
        $this->handleSendNewOrderEmail($order);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('checkout/onepage/success');
        return $resultRedirect;
    }

    protected function handleCustomerRedirectFromOrder($order)
    {
        try {
            if ($order->getCustomerId()) {
                if (!$this->customerSession->isLoggedIn()) {
                    $this->customerSession->loginById($order->getCustomerId());
                }
            } else {
                if ($this->scopeConfig->isSetFlag(\Oyst\OneClick\Helper\Constants::CONFIG_PATH_OYST_CONFIG_CREATE_CUSTOMER_ON_OYST_ORDER)) {
                    $account = $this->orderCustomerService->create($order->getId());

                    if ($account->getFirstname() != $order->getCustomerFirstname()
                     || $account->getLastname() != $order->getCustomerLastname()) {
                        $account->setLastname($order->getCustomerLastname());
                        $account->setFirstname($order->getCustomerFirstname());
                        $this->customerRepository->save($account);
                    }

                    $this->customerSession->loginById($account->getId());
                }
            }

            $customer = $this->customerSession->getCustomer();
            if ($customer->getId()) {
                $newsletterOptin = $this->helperData->getSalesObjectExtraData($order, 'newsletter_optin');
                if ($newsletterOptin != $this->newsletterSubscriberFactory->create()->loadByCustomerId($customer->getId())->isSubscribed()) {
                    $account = $this->customerRepository->getById($customer->getId());
                    $account->getExtensionAttributes()->setIsSubscribed($newsletterOptin);
                    $this->customerRepository->save($account);
                }
            }
        } catch (\Exception $e) {
            // Handle non blocking behaviour
            $this->logger->critical($e);
        }
    }

    protected function handleDeactivateQuote($quote)
    {
        $quote->setIsActive(false);
        $this->quoteRepository->save($quote);

        return $this;
    }

    protected function handleSendNewOrderEmail($order)
    {
        if ($order->getCanSendNewEmailFlag()) {
            try {
                $this->orderSender->send($order);
            } catch (\Exception $e) {
                // Handle non blocking behaviour
                $this->logger->critical($e);
            }
        }

        return $this;
    }
}