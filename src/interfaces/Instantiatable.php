<?php
/**
 * Instantiatable
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */

namespace darealfive\enum\interfaces;

/**
 * Interface Instantiatable
 * Should be implemented by all classes which wants to be able to return instances of the corresponding Enumerable.
 * Extends the Enumerable interface to provide Enum related necessary information.
 * Extends the Comparable interface to make enum's comparable to any other Comparable class.
 *
 * @package darealfive\enum\interfaces
 */
interface Instantiatable extends Enumerable, Comparable
{
    /**
     * Returns the name of this enum.
     *
     * @return string name of this enum
     */
    public function name(): string;

    /**
     * Returns ordinal of this enumeration (its position in the enum declaration within @see names(), where the initial
     * constant is assigned an ordinal of zero).
     *
     * @return mixed the value of this enum
     */
    public function ordinal();

    /**
     * Returns the translated representation of this enum name
     *
     * @return string translated name of this enum
     */
    public function translate(): string;

    /**
     * Returns a hash which can uniquely identify one specific enumerable value.
     *
     * @return string a hash to uniquely identify the enum
     */
    public function hashCode(): string;

    /**
     * Returns a fresh instance of this enum. Useful if you are working with a serialized/unserialized or cloned version
     * of this Enum. Such a "modified" Enum won't ever be equal to any other enum due to its object ID having changed
     * after the serialization respectively cloning process.
     * However, the refreshed version can be used like any other newly created enum
     * => e.g. checking its equality with other enum again return true if they are the same objects.
     *
     * @see equals() will only work with "refreshed" enums => uncloned and not serialized
     *
     * @return static a fresh instance of this enum
     */
    public function refresh(): self;
}