<?php

namespace Hpayments;

use Exception;

/**
 * Class RedirectUrls
 * @package Hpayments
 */
class RedirectUrls extends PaymentModel
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
}