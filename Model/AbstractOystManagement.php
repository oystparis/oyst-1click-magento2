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

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerDataFactory
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerDataFactory = $customerDataFactory;
    }

    protected function getCustomer($email)
    {
        try {
            return $this->customerRepository->get($email);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return $this->customerDataFactory->create();
        }
    }
}

