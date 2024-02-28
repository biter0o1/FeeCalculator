<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\FeeStructure;

/**
 * Interface for fee structure providers.
 */
interface FeeStructureInterface
{
    /**
     * @return array<int, int>
     */
    public function getStructure(): array;
}