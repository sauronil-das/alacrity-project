<?php

namespace Tests\Unit;

use App\Models\Loan;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{
    /**
     * Test creating a new Loan instance.
     *
     * @return void
     */
    public function test_create_loan_instance()
    {
        $loan = new Loan();

        $loan->amount = 10000;
        $loan->interest_rate = 5.5;

        $this->assertEquals(10000, $loan->amount);
        $this->assertEquals(5.5, $loan->interest_rate);
    }
}
