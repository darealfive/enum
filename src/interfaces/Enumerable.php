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
     * Checks whether this class contains an enum with given name.
     *
     * @param string $name the name of the enum to check its existence
     *
     * @return bool true if such enum exists, false otherwise
     */
    public static function has($name);

    /**
     * Central method which indicates what enums are available. The keys are the ordinal numbers and the values are the
     * names.
     *
     * @return array list of all enumeration names with their associated value as key
     */
    public static function names();

    /**
     * Returns an associative list of all enumeration ordinal values (their positions in the enum declaration)
     *
     * @return array list of all enumeration ordinals with their associated name as key
     * @see names(), where the initial constant is assigned an ordinal of zero) with their associated name as key.
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
     * @param array|null $names list of enums to be returned. Defaults to null, meaning all enums as listed in names()
     *                          will be returned. If it is an array, only the enums in the array will be returned.
     *
     * @return Instantiatable[] list of all (optionally filtered) enumerations available in the class
     */
    public static function enumerations(array $names = null);

    /**
     * Returns an instance of the current enum type with the specified name. The name must match exactly an identifier
     * used to declare an enum constant in this type. (Extraneous whitespace characters are not permitted.)
     *
     * @param string $name the name of the constant to return
     *
     * @return Instantiatable enum instance of the current enum type with the specified name
     * @see fromOrdinal this works the same but using enum ordinal value instead of its name.
     */
    public static function valueOf($name);

    /**
     * Returns an instance of the current enum type with the specified ordinal value (its position in the enum
     * declaration)
     *
     * @param mixed $ordinal the ordinal value of the constant to be returned
     *
     * @return Instantiatable enum instance of the current enum type with the specified ordinal value
     * @see names(), where the initial constant is assigned an ordinal of zero) with their associated name as key.
     * @see valueOf this works the same but using enum name instead of its oridinal value.
     */
    public static function fromOrdinal($ordinal);
}