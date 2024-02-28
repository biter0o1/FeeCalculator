<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interpolation;

/**
 * LinearInterpolation class for linear interpolation calculations.
 *
 * This class implements the InterpolationInterface for linear interpolation.
 */
class LinearInterpolation implements InterpolationInterface
{
    /**
     * Interpolate a value using linear interpolation.
     *
     * @param int $x  The point for which interpolation is performed.
     * @param int $x0 The lower bound for the x-axis.
     * @param int $x1 The upper bound for the x-axis.
     * @param int $y0 The value at the lower bound of the x-axis.
     * @param int $y1 The value at the upper bound of the x-axis.
     *
     * @return int
     */
    public function interpolate(int $x, int $x0, int $x1, int $y0, int $y1): int
    {
        if ($x1 == $x0) {
            return $y0;
        }

        $result = $y0 + (($x - $x0) / ($x1 - $x0)) * ($y1 - $y0);

        return (int) round($result);
    }
}