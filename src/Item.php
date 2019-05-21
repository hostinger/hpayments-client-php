<?php

namespace Hpayments;

use Exception;

/**
 * Class Item
 * @package Hpayments
 */
class Item extends PaymentModel
{
    protected $name;
    protected $period;
    protected $price_now;
    protected $price_before;

    /**
     * Payer constructor.
     * @param $data
     * @throws
     */
    public function __construct($data)
    {
        if (!isset($data['name']) && empty($data['name'])) {
            throw new Exception('Item name is not set.');
        }

        if (!isset($data['price_now']) && empty($data['price_now'])) {
            throw new Exception('Item price is not set.');
        }

        $this->setDataFromArray($data);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @return mixed
     */
    public function getPriceNow()
    {
        return $this->price_now;
    }

    /**
     * @param mixed $price_now
     */
    public function setPriceNow($price_now)
    {
        $this->price_now = $price_now;
    }

    /**
     * @return mixed
     */
    public function getPriceBefore()
    {
        return $this->price_before;
    }

    /**
     * @param mixed $price_before
     */
    public function setPriceBefore($price_before)
    {
        $this->price_before = $price_before;
    }
}