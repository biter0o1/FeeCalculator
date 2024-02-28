<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    public function __construct(public int $amount)
    {
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): int
    {
        return $this->amount;
    }
}
