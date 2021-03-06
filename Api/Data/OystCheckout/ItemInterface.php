<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface ItemInterface
 * @api
 */
interface ItemInterface 
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const REFERENCE = 'reference';
    const INTERNAL_REFERENCE = 'internal_reference';
    const ALIAS = 'alias';
    const NAME = 'name';
    const TYPE = 'type';
    const DESCRIPTION_SHORT = 'description_short';
    const QUANTITY = 'quantity';
    const QUANTITY_AVAILABLE = 'quantity_available';
    const QUANTITY_MINIMAL = 'quantity_minimal';
    const ATTRIBUTES_VARIANT = 'attributes_variant';
    const AVAILABILITY_STATUS = 'availability_status';
    const AVAILABILITY_DATE = 'availability_date';
    const AVAILABILITY_LABEL = 'availability_label';
    const WIDTH = 'width';
    const HEIGHT = 'height';
    const DEPTH = 'depth';
    const WEIGHT = 'weight';
    const TAX_RATE = 'tax_rate';
    const TAX_NAME = 'tax_name';
    const IMAGE = 'image';
    const PRICE = 'price';
    const DISCOUNTS = 'discounts';
    const CHILD_ITEMS = 'child_items';
    const OYST_DISPLAY = 'oyst_display';
    const USER_INPUT = 'user_input';

    /**#@-*/

    /**
     * @return string
     */
    public function getReference();

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference($reference);

    /**
     * @return string
     */
    public function getInternalReference();

    /**
     * @param string $internalReference
     * @return $this
     */
    public function setInternalReference($internalReference);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);
    
    /**
     * @return string
     */
    public function getAlias();

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getDescriptionShort();

    /**
     * @param string $descriptionShort
     * @return $this
     */
    public function setDescriptionShort($descriptionShort);

    /**
     * @return float
     */
    public function getQuantity();

    /**
     * @param float $quantity
     * @return $this
     */
    public function setQuantity($quantity);

    /**
     * @return float|null
     */
    public function getQuantityAvailable();

    /**
     * @param float $quantityAvailable
     * @return $this
     */
    public function setQuantityAvailable($quantityAvailable);

    /**
     * @return float|null
     */
    public function getQuantityMinimal();

    /**
     * @param float $quantityMinimal
     * @return $this
     */
    public function setQuantityMinimal($quantityMinimal);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\ItemPriceInterface
     */
    public function getPrice();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\ItemPriceInterface $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * @return \Oyst\OneClick\Api\Data\Common\ItemAttributeInterface[]|null
     */
    public function getAttributesVariant();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\ItemAttributeInterface[] $attributesVariant
     * @return $this
     */
    public function setAttributesVariant($attributesVariant);

    /**
     * @return string|null
     */
    public function getAvailabilityStatus();

    /**
     * @param string $availabilityStatus
     * @return $this
     */
    public function setAvailabilityStatus($availabilityStatus);

    /**
     * @return string|null
     */
    public function getAvailabilityDate();

    /**
     * @param string $availabilityDate
     * @return $this
     */
    public function setAvailabilityDate($availabilityDate);

    /**
     * @return string|null
     */
    public function getAvailabilityLabel();

    /**
     * @param string $availabilityLabel
     * @return $this
     */
    public function setAvailabilityLabel($availabilityLabel);

    /**
     * @return float|null
     */
    public function getWidth();

    /**
     * @param float $width
     * @return $this
     */
    public function setWidth($width);

    /**
     * @return float|null
     */
    public function getHeight();

    /**
     * @param float $height
     * @return $this
     */
    public function setHeight($height);

    /**
     * @return float|null
     */
    public function getDepth();

    /**
     * @param float $depth
     * @return $this
     */
    public function setDepth($depth);

    /**
     * @return float
     */
    public function getWeight();

    /**
     * @param float $weight
     * @return $this
     */
    public function setWeight($weight);

    /**
     * @return float
     */
    public function getTaxRate();

    /**
     * @param float $taxRate
     * @return $this
     */
    public function setTaxRate($taxRate);

    /**
     * @return string|null
     */
    public function getTaxName();

    /**
     * @param string $taxName
     * @return $this
     */
    public function setTaxName($taxName);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param string $image
     * @return $this
     */
    public function setImage($image);
    
    /**
     * @return \Oyst\OneClick\Api\Data\Common\DiscountInterface[]|null
     */
    public function getDiscounts();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\DiscountInterface[] $discounts
     * @return $this
     */
    public function setDiscounts($discounts);
    
    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[]|null
     */
    public function getChildItems();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemInterface[] $childItems
     * @return $this
     */
    public function setChildItems($childItems);

    /**
     * @return string
     */
    public function getOystDisplay();

    /**
     * @param string $oystDisplay
     * @return $this
     */
    public function setOystDisplay($oystDisplay);
    
    /**
     * @return \Oyst\OneClick\Api\Data\Common\KeyValueInterface[]|null
     */
    public function getUserInput();

    /**
     * @param \Oyst\OneClick\Api\Data\Common\KeyValueInterface[] $userInput
     * @return $this
     */
    public function setUserInput($userInput);
}
