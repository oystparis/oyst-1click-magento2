<?php

namespace Oyst\OneClick\Api\Data\OystCheckout;

/**
 * Interface MessageInterface
 * @api
 */
interface MessageInterface
{
    /**#@+
     * Constants defined for keys of array, makes typos less likely
     */

    const TYPE = 'type';
    const CONTENT = 'content';

    /**#@-*/

    /**
     * @return string|null
     */
    public function getType();

    /**
     * @param string $order
     * @return $this
     */
    public function setType($type);

    /**
     * @return string|null
     */
    public function getContent();

    /**
     * @param string $gift
     * @return $this
     */
    public function setContent($content);
}
