<?php
/**
 * Created by PhpStorm.
 * User: rytis
 * Date: 20/05/2019
 * Time: 17:55
 */

namespace Hpayments;


use Exception;

class RedirectUrls extends PaymentModel implements \JsonSerializable
{
    protected $return;
    protected $cancel;

    /**
     * RedirectUrls constructor.
     * @param $data
     * @throws Exception
     */
    public function __construct($data)
    {
        if (!isset($data['return']) && empty($data['return'])){
            throw new Exception('Return URL is not set.');
        }

        if (!isset($data['cancel']) && empty($data['cancel'])){
            throw new Exception('Cancel URL is not set.');
        }

        $this->setDataFromArray($data);
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param mixed $return
     */
    public function setReturn($return)
    {
        $this->return = $return;
    }

    /**
     * @return mixed
     */
    public function getCancel()
    {
        return $this->cancel;
    }

    /**
     * @param mixed $cancel
     */
    public function setCancel($cancel)
    {
        $this->cancel = $cancel;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}