<?php

namespace Oyst\OneClick\Model\Data\OystOrder;

class Item extends \Magento\Framework\Api\AbstractSimpleObject implements \Oyst\OneClick\Api\Data\OystOrder\ItemInterface
{
    public function getReference()
    {
        return $this->_get(self::REFERENCE);
    }

    public function setReference($reference)
    {
        return $this->setData(self::REFERENCE , $reference);
    }

    public function getInternalReference()
    {
        return $this->_get(self::INTERNAL_REFERENCE);
    }

    public function setInternalReference($internalReference)
    {
        return $this->setData(self::INTERNAL_REFERENCE , $internalReference);
    }

    public function getAlias()
    {
        return $this->_get(self::ALIAS);
    }

    public function setAlias($alias)
    {
        return $this->setData(self::ALIAS , $alias);
    }

    public function getName()
    {
        return $this->_get(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME , $name);
    }

    public function getType()
    {
        return $this->_get(self::TYPE);
    }

    public function setType($type)
    {
        return $this->setData(self::TYPE , $type);
    }

    public function getDescriptionShort()
    {
        return $this->_get(self::DESCRIPTION_SHORT);
    }

    public function setDescriptionShort($descriptionShort)
    {
        return $this->setData(self::DESCRIPTION_SHORT , $descriptionShort);
    }

    public function getQuantity()
    {
        return $this->_get(self::QUANTITY);
    }

    public function setQuantity($quantity)
    {
        return $this->setData(self::QUANTITY , $quantity);
    }

    public function getAttributesVariant()
    {
        return $this->_get(self::ATTRIBUTES_VARIANT);
    }

    public function setAttributesVariant($attributesVariant)
    {
        return $this->setData(self::ATTRIBUTES_VARIANT , $attributesVariant);
    }

    public function getWidth()
    {
        return $this->_get(self::WIDTH);
    }

    public function setWidth($width)
    {
        return $this->setData(self::WIDTH , $width);
    }

    public function getHeight()
    {
        return $this->_get(self::HEIGHT);
    }

    public function setHeight($height)
    {
        return $this->setData(self::HEIGHT , $height);
    }

    public function getDepth()
    {
        return $this->_get(self::DEPTH);
    }

    public function setDepth($depth)
    {
        return $this->setData(self::DEPTH , $depth);
    }

    public function getWeight()
    {
        return $this->_get(self::WEIGHT);
    }

    public function setWeight($weight)
    {
        return $this->setData(self::WEIGHT , $weight);
    }

    public function getTaxRate()
    {
        return $this->_get(self::TAX_RATE);
    }

    public function setTaxRate($taxRate)
    {
        return $this->setData(self::TAX_RATE , $taxRate);
    }

    public function getTaxName()
    {
        return $this->_get(self::TAX_NAME);
    }

    public function setTaxName($taxName)
    {
        return $this->setData(self::TAX_NAME , $taxName);
    }

    public function getImage()
    {
        return $this->_get(self::IMAGE);
    }

    public function setImage($image)
    {
        return $this->setData(self::IMAGE , $image);
    }

    public function getPrice()
    {
        return $this->_get(self::PRICE);
    }

    public function setPrice($price)
    {
        return $this->setData(self::PRICE , $price);
    }

    public function getDiscounts()
    {
        return $this->_get(self::DISCOUNTS);
    }

    public function setDiscounts($discounts)
    {
        return $this->setData(self::DISCOUNTS , $discounts);
    }

    public function getChildItems()
    {
        return $this->_get(self::CHILD_ITEMS);
    }

    public function setChildItems($childItems)
    {
        return $this->setData(self::CHILD_ITEMS , $childItems);
    }

    public function getOystDisplay()
    {
        return $this->_get(self::OYST_DISPLAY);
    }

    public function setOystDisplay($oystDisplay)
    {
        return $this->setData(self::OYST_DISPLAY , $oystDisplay);
    }

    public function getUserInput()
    {
        return $this->_get(self::USER_INPUT);
    }

    public function setUserInput($userInput)
    {
        return $this->setData(self::USER_INPUT , $userInput);
    }
}
