<?php
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Interpolation\LinearInterpolation;
use PragmaGoTech\Interview\FeeStructure\FeeStructureDefault;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorTest extends TestCase
{
    /**
     * @var FeeCalculator
     */
    private FeeCalculator $calculator;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->calculator = new FeeCalculator(new FeeStructureDefault(), new LinearInterpolation());
    }

    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculate(int $loanAmount, int $expectedFee): void
    {
        $fee = $this->calculator->calculate(new LoanProposal($loanAmount));

        $this->assertEquals($expectedFee, $fee);
    }

    /**
     * @return array<array{0: int, 1: int}>
     */
    public static function calculateDataProvider(): array
    {
        return [
            [6500, 130],
            [19250, 385],
            [1000, 50],
            [20000, 400],
            [10000, 200],
            [10050, 205],
            [11000, 220],
            [3000, 90],
            [2250, 90],
            [1500, 70]
        ];
    }


    /**
     * @return void
     */
    public function testCalculateForBelowMinLoanAmount(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $loanAmount = 999;

        $this->calculator->calculate(new LoanProposal($loanAmount));
    }

    /**
     * @return void
     */
    public function testCalculateForAboveMaxLoanAmount(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $loanAmount = 20001;

        $this->calculator->calculate(new LoanProposal($loanAmount));
    }
}