<?php
/**
 * Comparable
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */

namespace darealfive\enum\interfaces;

/**
 * Interface Comparable
 *
 * @package darealfive\enum\interfaces
 */
interface Comparable
{
    /**
     * Checks whether this comparable is equal to the provided one.
     *
     * @param Comparable $comparable object to check its equality to this one
     * @param bool       $typeSafe   whether to do type safe comparisons. Defaults to true meaning the comparison
     *                               considers the type of the comparable values.
     *
     * @return bool true if they are equal, false otherwise
     * @see compareValue whose value being returned should be used to check the comparables equality.
     */
    public function equals(Comparable $comparable, $typeSafe = true): bool;

    /**
     * Returns the value to being used to check the comparables equality.
     *
     * @return mixed the value to be used for the comparison.
     */
    public function compareValue();
}