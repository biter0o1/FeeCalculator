<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\FeeStructure\FeeStructureInterface;
use PragmaGoTech\Interview\Interpolation\InterpolationInterface;
use PragmaGoTech\Interview\Model\LoanProposal;


/**
 * FeeCalculator class for calculating fees based on loan amounts.
 *
 * This class uses feeStructure and interpolation methods to calculate fees for loan proposals.
 */
class FeeCalculator implements FeeCalculatorInterface
{
    private const int MIN_AMOUNT_ALLOWED = 1000;
    private const int MAX_AMOUNT_ALLOWED = 20000;
    public function __construct(public FeeStructureInterface $feeStructure, public InterpolationInterface $interpolation)
    {
    }

    /**
     * @param LoanProposal $application
     * @return int The calculated total fee.
     */
    public function calculate(LoanProposal $application): int
    {
        $loanAmount = $application->amount();
        $structure = $this->feeStructure->getStructure();

        $this->validateLoanAmount($loanAmount);

        $lowerBound = $this->findLowerBound($structure, $loanAmount);
        $upperBound = $this->findUpperBound($structure, $loanAmount);

        $lowerFee = $structure[$lowerBound];
        $upperFee = $structure[$upperBound];

        $interpolateResult = $this->interpolation->interpolate($loanAmount, $lowerBound, $upperBound, $lowerFee, $upperFee);

        return $this->roundUp($interpolateResult);
    }

    /**
     * @param int $loanAmount
     * @return void
     */
    private function validateLoanAmount(int $loanAmount): void
    {
        if ($loanAmount < self::MIN_AMOUNT_ALLOWED || $loanAmount > self::MAX_AMOUNT_ALLOWED) {
            throw new \InvalidArgumentException('Loan amount must be between 1,000 and 20,000 PLN.');
        }
    }

    /**
     * @param array<int, int> $structure
     * @param int $loanAmount
     * @return int
     */
    private function findLowerBound(array $structure, int $loanAmount): int
    {
        return max(array_filter(array_keys($structure), function ($value) use ($loanAmount) {
            return $value <= $loanAmount;
        }));
    }

    /**
     * @param array<int, int> $structure
     * @param int $loanAmount
     * @return int
     */
    private function findUpperBound(array $structure, int $loanAmount): int
    {
        return min(array_filter(array_keys($structure), function ($value) use ($loanAmount) {
            return $value >= $loanAmount;
        }));
    }

    /**
     * @param int $value
     * @return int
     */
    private function roundUp(int $value): int
    {
        return (int) ceil($value / 5) * 5;
    }
}