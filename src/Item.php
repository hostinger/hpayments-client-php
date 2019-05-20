<?php

namespace Hpayments;

use Exception;
use JsonSerializable;

class Item extends PaymentModel implements JsonSerializable
{
    protected $name;
    protected $period;
    protected $priceNow;
    protected $priceBefore;

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
        return $this->priceNow;
    }

    /**
     * @param mixed $priceNow
     */
    public function setPriceNow($priceNow)
    {
        $this->priceNow = $priceNow;
    }

    /**
     * @return mixed
     */
    public function getPriceBefore()
    {
        return $this->priceBefore;
    }

    /**
     * @param mixed $priceBefore
     */
    public function setPriceBefore($priceBefore)
    {
        $this->priceBefore = $priceBefore;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}