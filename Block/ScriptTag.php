<?php

namespace Oyst\OneClick\Block;

class ScriptTag extends \Magento\Framework\View\Element\Template
{
    public function getScriptTag()
    {
        return $this->_scopeConfig->getValue('oyst_oneclick/general/script_tag');
    }
}

