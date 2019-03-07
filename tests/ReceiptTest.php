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
}
