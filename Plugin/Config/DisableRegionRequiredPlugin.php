<?php

namespace Oyst\OneClick\Plugin\Config;

class DisableRegionRequiredPlugin
{
    protected $coreRegistry;
    
    public function __construct(
        \Magento\Framework\Registry $coreRegistry        
    )
    {
        $this->coreRegistry = $coreRegistry;
    }
    
    public function aroundGetValue(
        \Magento\Framework\App\Config\ScopeConfigInterface $subject, 
        \Closure $proceed, 
        $path,
        $scopeType = \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeCode = null
    )
    {
        if ($path == \Magento\Directory\Helper\Data::XML_PATH_STATES_REQUIRED
         && $this->coreRegistry->registry(\Oyst\OneClick\Helper\Constants::DISABLE_REGION_REQUIRED_REGISTRY_KEY)) {
            return '';
        } else {
            return $proceed($path, $scopeType, $scopeCode);
        }
    }
}

