<?php

namespace Oyst\OneClick\Model\MagentoQuote;

class Synchronizer
{
    /**
     * @var \Magento\Checkout\Model\Cart
     */
    protected $cart;

    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * @var \Magento\Quote\Api\Data\PaymentInterfaceFactory
     */
    protected $paymentFactory;

    public function __construct(
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Quote\Api\Data\PaymentInterfaceFactory $paymentFactory
    )
    {
        $this->cart = $cart;
        $this->eventManager = $eventManager;
        $this->paymentFactory = $paymentFactory;
    }

    public function syncMagentoQuote(
        \Oyst\OneClick\Api\Data\OystCheckoutInterface $oystCheckout,
        \Magento\Quote\Model\Quote $quote,
        \Magento\Customer\Api\Data\CustomerInterface $customer,
        \Magento\SalesRule\Model\Coupon $coupon
    )
    {
        $this->cart->setQuote($quote);
        $quote->setOystId($oystCheckout->getOystId());

        $this->syncMagentoAddresses($quote, $oystCheckout->getBilling(), $oystCheckout->getShipping());
        $this->syncMagentoCustomer($quote, $customer, $oystCheckout->getUser());
        $this->syncMagentoQuoteItems($quote, $oystCheckout->getItems());
        $this->syncMagentoCoupon($quote, $coupon);
        $this->syncMagentoPaymentMethod($quote);

        return true;
    }

    protected function syncMagentoQuoteItems(
        \Magento\Quote\Model\Quote $quote,
        array $oystCheckoutItems
    )
    {
        $cartData = [];

        foreach ($quote->getAllItems() as $item) {
            if ($item->getParentItemId()) {
                continue;
            }

            foreach ($oystCheckoutItems as $oystCheckoutItem) {
                if ($item->getId() == $oystCheckoutItem->getInternalReference()) {
                    $cartData[$item->getId()]['qty'] = $oystCheckoutItem->getQuantity();
                    break;
                }
            }

            if (!isset($cartData[$item->getId()]['qty'])) {
                $cartData[$item->getId()]['qty'] = 0;
            }
        }

        $cartData = $this->cart->suggestItemsQty($cartData);
        $this->cart->updateItems($cartData);

        return true;
    }

    protected function syncMagentoCustomer(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Customer\Api\Data\CustomerInterface $customer,
        \Oyst\OneClick\Api\Data\Common\UserInterface $oystCheckoutUser
    )
    {
        if($customer->getId()) {
            $quote->setCustomer($customer);
        } else {
            $quote->setCustomerEmail($oystCheckoutUser->getEmail());
            $quote->setCustomerFirstname($oystCheckoutUser->getFirstname());
            $quote->setCustomerLastname($oystCheckoutUser->getLastname());
            $quote->setCheckoutMethod(\Magento\Quote\Api\CartManagementInterface::METHOD_GUEST);
        }

        return true;
    }

    protected function syncMagentoCoupon(
        \Magento\Quote\Model\Quote $quote,
        \Magento\SalesRule\Model\Coupon $coupon
    )
    {
        if ($coupon->getId()) {
            $quote->setCouponCode($coupon->getCode());
        }

        return true;
    }

    protected function syncMagentoAddresses(
        \Magento\Quote\Model\Quote $quote,
        \Oyst\OneClick\Api\Data\Common\BillingInterface $oystCheckoutBilling,
        \Oyst\OneClick\Api\Data\OystCheckout\ShippingInterface $oystCheckoutShipping
    )
    {
        /* @var Magento\Quote\Model\Quote\Address $billingAddress */
        $billingAddress = $quote->getBillingAddress();
        $billingAddressData = $this->getAddressData($oystCheckoutBilling->getAddress());
        $billingAddress->addData($billingAddressData);

        $billingAddress->setSaveInAddressBook(false);
        $billingAddress->setShouldIgnoreValidation(true);

        /* @var Magento\Quote\Model\Quote\Address $shippingAddress */
        $shippingAddress = $quote->getShippingAddress();
        $shippingAddressData = $this->getAddressData($oystCheckoutShipping->getAddress());
        $shippingAddress->setSameAsBilling(0);
        $shippingAddress->addData($shippingAddressData);

        $shippingAddress->setSaveInAddressBook(false);
        $shippingAddress->setShouldIgnoreValidation(true);

        return true;
    }

    protected function getAddressData(
        \Oyst\OneClick\Api\Data\Common\AddressInterface $oystCheckoutAddress
    )
    {
        $addressData = [];

        $addressData['firstname'] = $oystCheckoutAddress->getFirstname();
        $addressData['lastname'] = $oystCheckoutAddress->getLastname();
        $addressData['city'] = $oystCheckoutAddress->getCity();
        $addressData['postcode'] = $oystCheckoutAddress->getPostcode();
        $addressData['street'] = [$oystCheckoutAddress->getStreet1(), $oystCheckoutAddress->getStreet2()];
        $addressData['country_id'] = $oystCheckoutAddress->getCountry()->getCode();
        $addressData['telephone'] = $oystCheckoutAddress->getPhoneMobile();
        $addressData['email'] = $oystCheckoutAddress->getEmail();
        $addressData['company'] = $oystCheckoutAddress->getCompany();

        return $addressData;
    }

    protected function syncMagentoPaymentMethod(
        \Magento\Quote\Model\Quote $quote
    )
    {
        $payment = $this->paymentFactory->create();
        $payment->setMethod(\Oyst\OneClick\Model\Payment\Method\OneClick::PAYMENT_METHOD_OYST_ONECLICK_CODE);

        $quote->getPayment()->importData($payment->getData());

        if ($quote->isVirtual()) {
            $quote->getBillingAddress()->setPaymentMethod($quote->getPayment()->getMethod());
        } else {
            $quote->getShippingAddress()->setPaymentMethod($quote->getPayment()->getMethod());
        }

        return true;
    }
}

