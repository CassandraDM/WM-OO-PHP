<?php

var_dump(value: 'test');

// Reproduisez la classe VendorMachine en PHP
// Modifiez la méthode shoot with foot, pour qu'elle affiche une phrase avec l'argent tombé + les snacks tombés
// En dessous de votre classe, instanciez là et appelez la méthode shootWithFoot
// Vérifiez ce que ça affiche en rechargeant le navigateur (sur index.php)

class VendorMachine {
    private bool $isOn;
  
    private int $snacksQty;
  
    private float $money;
  
    public function __construct() {
        $this->isOn = false;
        $this->snacksQty = 50;
        $this->money = 0;
    }
  
    public function buySnack() {
      $this->isOn = true;
      if ($this->snacksQty === 0) {
        throw new Error("No snacks for you :(");
      }
      $this->money += 2;
      $this->snacksQty -= 1;
    }
  
    public function reset() {
      $this->isOn = false;
      $this->money = 0;
      $this->snacksQty = $this->calculateLeftSnacksQty();
      $this->isOn = true;
    }
  
    private function calculateLeftSnacksQty() {
      return $this->snacksQty + (50 - $this->snacksQty);
    }
  
    public function shootWithFoot() {
      $this->isOn = false;

      return "Snacks tombés : {$this->dropSnacks()} et monnaie tombée : {$this->dropMoney()}";
    }

    private function dropMoney() {
      $moneyToDrop = 20;
      if ($this->money < 20) {
        $moneyToDrop = $this->money;
      }
      $this->money -= $moneyToDrop;

        return $moneyToDrop;
    }


    private function dropSnacks() {
      $snacksToDrop = 5;
      if ($this->snacksQty < 5) {
        $snacksToDrop = $this->snacksQty;
      }
      $this->snacksQty -= $snacksToDrop;

      return $snacksToDrop;
    }
  }
  
$vendorMachine = new VendorMachine();
  
var_dump($vendorMachine->shootWithFoot());