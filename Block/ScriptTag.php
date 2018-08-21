<?php

namespace Oyst\OneClick\Block;

class ScriptTag extends \Magento\Framework\View\Element\Template
{
    public function getScriptTag()
    {
        $scriptTag = $this->_scopeConfig->getValue('oyst_oneclick/general/script_tag');

        return str_replace(
            \Oyst\OneClick\Helper\Constants::MERCHANT_ID_PLACEHOLDER,
            $this->_scopeConfig->getValue('oyst_oneclick/general/merchant_id'),
            $scriptTag
        );
    }
}

