<?php

namespace Hpayments;

/**
 * Class Items
 * @package Hpayments
 */
class Items extends PaymentModel implements \JsonSerializable
{
    protected $items;

    public function __construct()
    {
        $this->items = array();
    }

    /**
     * @param $item
     */
    public function addNewItem(Item $item)
    {
        array_push($this->items, $item);
    }

    /**
     * @return array|mixed|object
     */
    public function jsonSerialize()
    {
        return (array) get_object_vars($this)['items'];
    }
}