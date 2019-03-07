<?php
namespace TDD;
class Receipt {
    // Funktsioon, mis tagastab summade massiivi
    public function total(array $items = [], $coupon) {
        //kontrollime, kas allahindlus on suurem ühest
        if ($coupon > 1.00) {
            throw new BadMethodCallException('Coupon must be less than or equal to 1.00');
        }
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