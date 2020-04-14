<?php
abstract class OrderState
{
    const ORDER_STATUS = 'undefined';

    public function getStatus() {
        return static::ORDER_STATUS;
    }

    abstract public function isPending();
    abstract public function canBeCancelled();
}

class PrendingOrderState extends OrderState
{
    const ORDER_STATUS = 'pending';

    public function isPending() {
        return true;
    }

    public function canBeCancelled() {
        return true;
    }
}

class DisptachedOrderState extends OrderState
{
    const ORDER_STATUS = 'dispatched';

    public function isPending() {
        return false;
    }

    public function canBeCancelled() {
        return false;
    }
}

class Order
{
    /**
     * @var OrderState
     */
    protected $state;

    /**
     * @var string
     */
    protected $status;

    public function __construct(OrderState $state)
    {
        $this->state = $state;
        return  $this->status = $state->getStatus();
    }

    public function setState() {

    }

    public function isPending() {
        return $this->state->isPending();
    }

    public function canBeCancelled(){
        return $this->state->canBeCancelled();
    }
}

$order =  new Order(new PrendingOrderState());
//$orderstate = $order->setState();
var_dump($order->isPending());