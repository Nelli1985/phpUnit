<?php
namespace TDD;
class Receipt {
    // Funktsioon, mis tagastab summade massiivi
    public function total(array $items = []) {
        return array_sum($items);
    }

    //Funktsioon, mis tagastab maksu
    public function tax($amount, $tax) {
        return ($amount * $tax);
    }
}
