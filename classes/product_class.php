<?php
    class Product{
        private $id;
        private $name;
        private $amount;
        private $price;
        private $delivery;

        public function __construct($id, $name, $amount, $price, $delivery){
            $this->id = $id;
            $this->name = $name;
            $this->amount = $amount;
            $this->price = $price;
            $this->delivery = $delivery;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getAmount()
        {
            return $this->amount;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getDelivery()
        {
            return $this->delivery;
        }

        function increaseAmount($value){
            $this->amount = $this->amount + $value;
        }
    }
?>