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
    /**
     * @dataProvider provideTotal
     */
    //Test, mis kontrollib, et kviitungi summa oleks 15
    public function testTotal($items, $expected) {
        $coupon = null;
        $output = $this->Receipt->total($items, $coupon);

        //Hindame testTotal oodatud väärtust
        $this->assertEquals(
            $expected,
            $output,
            "When summing the total should equal {$expected}"
        );
    }

    //Lisame dataprovideri funktsiooni, mis annab erinevad väärtused
    public function provideTotal() {
        return [
            'ints totaling 16' => [[1,2,5,8], 16],
            [[-1,2,5,8], 14],
            [[1,2,8], 11],
        ];
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

    public function testTotalException() {
        $input = [0,2,5,8];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $this->Receipt->total($input, $coupon);
    }

    //Lisame mock meetodi testPostTaxTotal, mis kasutab MockBuilder classi
    public function testPostTaxTotal() {
        $items = [1,2,5,8];
        $tax = 0.20;
        $coupon = null;
        $Receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $Receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));
        $Receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));
        $result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null);
        $this->assertEquals(11.00, $result);
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
