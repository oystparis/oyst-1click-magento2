<?php

namespace Oyst\OneClick\Block\Adminhtml\System\Config\Form;

class ModuleVersion extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $moduleList;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Module\ModuleListInterface $moduleList,
        array $data = []
    ) {
        $this->moduleList = $moduleList;
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
        $version = $this->moduleList->getOne(\Oyst\OneClick\Helper\Constants::MODULE_NAME)['setup_version'];
        $output = '<div style="background-color:#eee;padding:1em;border:1px solid #ddd;">';
        $output .= __('Module Version') . ': ' . $version;
        $output .= "</div>";
        return $output;
    }
}