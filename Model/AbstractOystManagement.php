<?php

namespace Oyst\OneClick\Model;

abstract class AbstractOystManagement
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var \Magento\Customer\Api\Data\CustomerInterfaceFactory
     */
    protected $customerDataFactory;

    /**
     * @var \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory
     */
    protected $quoteCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerDataFactory,
        \Magento\Quote\Model\ResourceModel\Quote\CollectionFactory $quoteCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerDataFactory = $customerDataFactory;
        $this->quoteCollectionFactory = $quoteCollectionFactory;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    protected function getMagentoCustomer($email)
    {
        try {
            return $this->customerRepository->get($email);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return $this->customerDataFactory->create();
        }
    }

    protected function getMagentoQuoteByOystId($oystId)
    {
        return $this->quoteCollectionFactory->create()
            ->addFieldToFilter('oyst_id', $oystId)
            ->addFieldToFilter('is_active', 1)
            ->setOrder('entity_id', \Magento\Framework\Data\Collection::SORT_ORDER_DESC)
            ->getFirstItem();
    }
    
    protected function getMagenteProductsById($ids)
    {
        return $this->productCollectionFactory->create()
            ->addAttributeToFilter('entity_id', ['in' => $ids])
            ->addAttributeToSelect('*')
            ->addFinalPrice();
    }
}

