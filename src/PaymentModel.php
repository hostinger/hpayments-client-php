<?php
/**
 * Created by PhpStorm.
 * User: rytis
 * Date: 20/05/2019
 * Time: 17:25
 */

namespace Hpayments;


/**
 * Class PaymentModel
 * @package Hpayments
 */
abstract class PaymentModel
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
    private function snakeToCamel($key)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
    }
}