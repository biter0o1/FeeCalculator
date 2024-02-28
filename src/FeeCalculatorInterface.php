<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeCalculatorInterface
{
    /**
     * @return int The calculated total fee.
     */
    public function calculate(LoanProposal $application): int;
}
