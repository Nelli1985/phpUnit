<?php
namespace TDD;
class Receipt {
    // Funktsioon, mis tagastab summade massiivi
    public function total(array $items = [], $coupon) {
        $sum = array_sum($items);
        if (!is_null($coupon)) {
            return $sum - ($sum * $coupon);
        }
        return $sum;
    }

    //Funktsioon, mis tagastab maksu
    public function tax($amount, $tax) {
        return ($amount * $tax);
    }

    //Lisan funktsiooni, mis postitab maksu summa
    public function postTaxTotal($items, $tax, $coupon) {
        $subtotal = $this->total($items, $coupon);
        return $subtotal + $this->tax($subtotal, $tax);
    }
}