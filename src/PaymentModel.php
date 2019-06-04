<?php

namespace Hpayments;

use JsonSerializable;

/**
 * Class PaymentModel
 * @package Hpayments
 */
abstract class PaymentModel implements JsonSerializable
{
    /**
     * @param $data
     */
    protected function setDataFromArray($data)
    {
        foreach ($data as $key => $value) {
            $this->assignValue($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    protected function assignValue($key, $value)
    {
        $setter = 'set' . $this->snakeToCamel($key);

        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function snakeToCamel($key)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
    }

    /**
     * @return mixed|object
     */
    public function jsonSerialize()
    {
        return (object)array_filter(get_object_vars($this), function ($val) {
            return !is_null($val);
        });
    }
}