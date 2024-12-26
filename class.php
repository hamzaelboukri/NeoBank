<?php

 class Account {
    protected int $AccountID;
    protected string $AccountNumber;
    protected string $OwnerName;
    protected float $Balance;
    protected PDO $db;

    public function __construct(string $AccountNumber, string $ownerName, float $balance) {
        $this->AccountNumber = $AccountNumber;
        $this->OwnerName = $OwnerName;
        $this->Balance = $Balance;
        
    }


    public function  InserData(){
                     


        
    }

}





































































































?>