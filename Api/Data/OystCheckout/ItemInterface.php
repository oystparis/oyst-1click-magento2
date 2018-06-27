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
    const REFERENCE_PARENT = 'reference_parent';
    const REFERENCE_PACKAGE = 'reference_package';
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
     * @return string|null
     */
    public function getReferenceParent();

    /**
     * @param string $referenceParent
     * @return $this
     */
    public function setReferenceParent($referenceParent);

    /**
     * @return string|null
     */
    public function getReferencePackage();

    /**
     * @param string $referencePackage
     * @return $this
     */
    public function setReferencePackage($referencePackage);

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
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemPriceInterface
     */
    public function getPrice();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemPriceInterface $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * @return \Oyst\OneClick\Api\Data\OystCheckout\ItemAttributeInterface[]|null
     */
    public function getAttributesVariant();

    /**
     * @param \Oyst\OneClick\Api\Data\OystCheckout\ItemAttributeInterface[] $attributesVariant
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
}
