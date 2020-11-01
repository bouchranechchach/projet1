<?php


class EventUser {

    private $id;
    private $payment_date;

    /**
     * EventUser constructor.
     * @param $id
     * @param $payment_date
     */
    public function __construct($id, $payment_date)
    {
        $this->id = $id;
        $this->payment_date = $payment_date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPaymentDate()
    {
        return $this->payment_date;
    }

    /**
     * @param mixed $payment_date
     */
    public function setPaymentDate($payment_date)
    {
        $this->payment_date = $payment_date;
    }

}