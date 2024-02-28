<?php
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new FeeCalculator();
        
        $loanAmount = 6500;
        $expectedFee = 130;

        $application = new LoanProposal($loanAmount);
        $fee = $calculator->calculate($application);

        $this->assertEquals($expectedFee, $fee);
    }
}