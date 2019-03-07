<?php
namespace TDD\Test;
require '..\vendor\autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {
    //Test, mis kontrollib, et kviitungi summa oleks 15
    public function testTotal() {
        $Receipt = new Receipt();
        $this->assertEquals(
            15,
            $Receipt->total([0,2,5,8]),
            'When summing the total should equal 15'
        );
    }
}