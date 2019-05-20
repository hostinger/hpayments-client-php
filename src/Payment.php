<?php

namespace Hpayments;


class Payment
{
    private $payer;
    private $transaction;
    private $items;
    private $redirectUrls;
    private $gateways;

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payerDetails
     */
    public function setPayer(Payer $payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param mixed $transactionDetails
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems(Items $items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrls()
    {
        return $this->redirectUrls;
    }

    /**
     * @param mixed $redirectUrls
     */
    public function setRedirectUrls(RedirectUrls $redirectUrls)
    {
        $this->redirectUrls = $redirectUrls;
    }

    /**
     * @return mixed
     */
    public function getGateways()
    {
        return $this->gateways;
    }

    /**
     * @param mixed $gateways
     */
    public function setGateways(Gateways $gateways)
    {
        $this->gateways = $gateways;
    }

    public function toJson()
    {
        return json_encode(get_object_vars($this));
    }
}