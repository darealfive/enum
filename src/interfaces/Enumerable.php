<?php
/**
 * Enumerable
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */

namespace darealfive\enum\interfaces;

/**
 * Interface Enumerable
 *
 * @package darealfive\enum\interfaces
 */
interface Enumerable
{
    /**
     * Central method which indicates what enums are available. The keys are the ordinal numbers and the values are the
     * names.
     *
     * @return array list of all enumeration names with their associated value as key
     */
    public static function names();

    /**
     * @return array list of all enumeration ordinal values (their positions in the enum declaration within @see names(),
     * where the initial constant is assigned an ordinal of zero) with their associated name as key
     */
    public static function ordinals();

    /**
     * Returns a list of all translated names where the origin names are keys.
     *
     * @return array list of all translated enumerations with their associated name as key
     */
    public static function translations();

    /**
     * Returns a list of all enumerations available in the class
     *
     * @return InstantiatableEnum[] list of all enumerations available in the class
     */
    public static function enumerations();

    /**
     * Returns an instance of the current enum type with the specified name. The name must match exactly an identifier
     * used to declare an enum constant in this type. (Extraneous whitespace characters are not permitted.)
     *
     * @see fromOrdinal this works the same but using enum ordinal value instead of its name.
     *
     * @param string $name the name of the constant to return
     *
     * @return InstantiatableEnum enum instance of the current enum type with the specified name
     */
    public static function valueOf($name);

    /**
     * Returns an instance of the current enum type with the specified ordinal value (its position in the enum
     * declaration within @see names(), where the initial constant is assigned an ordinal of zero) with their associated
     * name as key.
     *
     * @see valueOf this works the same but using enum name instead of its oridinal value.
     *
     * @param mixed $ordinal the ordinal value of the constant to be returned
     *
     * @return InstantiatableEnum enum instance of the current enum type with the specified ordinal value
     */
    public static function fromOrdinal($ordinal);
}