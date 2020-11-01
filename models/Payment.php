<?php


class Payment {

    private $id;
    private $amount;
    private $date;
    private $mode;
    private $account_num;
    private $user;

    /**
     * Payment constructor.
     * @param $id
     * @param $amount
     * @param $date
     * @param $mode
     * @param $account_num
     */
    public function __construct($id, $amount, $date, $mode, $account_num)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->date = $date;
        $this->mode = $mode;
        $this->account_num = $account_num;
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return mixed
     */
    public function getAccountNum()
    {
        return $this->account_num;
    }

    /**
     * @param mixed $account_num
     */
    public function setAccountNum($account_num)
    {
        $this->account_num = $account_num;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}