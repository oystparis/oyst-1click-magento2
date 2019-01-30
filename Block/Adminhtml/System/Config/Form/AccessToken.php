<?php

namespace Oyst\OneClick\Block\Adminhtml\System\Config\Form;

class AccessToken extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $integrationFactory;
    
    protected $oauthService;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Integration\Model\IntegrationFactory $integrationFactory,
        \Magento\Integration\Model\OauthService $oauthService,
        array $data = []
    ) {
        $this->integrationFactory = $integrationFactory;
        $this->oauthService = $oauthService;
        parent::__construct($context, $data);
    }
    
    /**
     * Render element value
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $integration = $this->integrationFactory->create()
            ->load(\Oyst\OneClick\Helper\Constants::INTEGRATION_NAME, 'name');
        $token = $this->oauthService
            ->getAccessToken($integration->getConsumerId())->getToken();
        if (!$token) {
            $token = __('--');
        }
        $output = '<div style="background-color:#eee;padding:1em;border:1px solid #ddd;">';
        $output .= __('Access Token') . ': ' . $token;
        $output .= "</div>";
        return $output;
    }
}