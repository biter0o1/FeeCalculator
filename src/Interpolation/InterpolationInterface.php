<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interpolation;

/**
 * Interface for interpolation methods.
 */
interface InterpolationInterface
{
    /**
     * Interpolate a value.
     *
     * @param int $x  The point for which interpolation is performed.
     * @param int $x0 The lower bound for the x-axis.
     * @param int $x1 The upper bound for the x-axis.
     * @param int $y0 The value at the lower bound of the x-axis.
     * @param int $y1 The value at the upper bound of the x-axis.
     *
     * @return int
     */
    public function interpolate(int $x, int $x0, int $x1, int $y0, int $y1): int;
}