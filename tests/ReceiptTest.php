<?php
namespace TDD\Test;
require '..\vendor\autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    // Lisan uue funktsiooni setUp
    public function setUp() {
        $this->Receipt = new Receipt();
    }

    // Lisan funktsiooni tearDown, et lasta välja testi eraldi
    public function tearDown() {
        unset($this->Receipt);
    }

    //Test, mis kontrollib, et kviitungi summa oleks 15
    public function testTotal() {
        $input = [0,2,5,8];
        $output = $this->Receipt->total($input);
        $this->assertEquals(
            15,
            $output,
            'When summing the total should equal 15'
        );
    }

    //Test, mis kontrollib allahindlust
    public function testTotalAndCoupon() {
        $input = [0,2,5,8];
        $coupon = 0.20;
        $output = $this->Receipt->total($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'When summing the total should equal 12'
        );
    }

    // Test, mis kontrollib maksu arvutust
    public function testTax() {
        $inputAmount = 10.00;
        $taxInput = 0.10;
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
            1.00,
            $output,
            'The tax calculation should equal 1.00'
        );
    }
}
