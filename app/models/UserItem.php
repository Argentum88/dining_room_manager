<?php




class UserItem extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $user_id;
     
    /**
     *
     * @var integer
     */
    protected $item_id;
     
    /**
     *
     * @var integer
     */
    protected $quantity;

    public function initialize()
    {
        $this->belongsTo('item_id', 'Item', 'id');
    }
     
    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field item_id
     *
     * @param integer $item_id
     * @return $this
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * Method to set the value of field quantity
     *
     * @param integer $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field item_id
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Returns the value of field quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'user_id' => 'user_id', 
            'item_id' => 'item_id', 
            'quantity' => 'quantity'
        );
    }

    public static function convertOrders($orders)
    {
        $resultOfConverting = array();
        foreach($orders as $order) {
            $dishes = $order->Item->getName();
            if (!array_key_exists("$dishes", $resultOfConverting)) {
                $resultOfConverting["$dishes"] = $order->getQuantity();
            } else {
                $resultOfConverting["$dishes"] = $resultOfConverting["$dishes"] + $order->getQuantity();
            }
        }
        return $resultOfConverting;
    }
}
