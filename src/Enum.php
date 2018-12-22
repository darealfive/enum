<?php
/**
 * Enum class file
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */

namespace darealfive\enum;

use InvalidArgumentException;
use OutOfRangeException;
use DomainException;
use LogicException;

/**
 * Class Enum can create all type of Enumerable objects.
 *
 * @see     Enum::valueOf() as central factory to create an instance
 *
 * @package darealfive\enum\interfaces
 */
abstract class Enum implements interfaces\InstantiatableEnum
{
    /**
     * Holds all the enums and is used as Enum store whenever an Enum is to be returned.
     *
     * @var static[] associative list of all enums created during this request. Keys are hash codes of the enum's.
     *
     * @access private
     */
    private static $_hashCodeEnum = array();

    /**
     * @var string The name of this enum, as provided via object creation.
     *
     * @access private
     */
    private $name;

    /**
     * @var mixed The ordinal of this enumeration (its position in the enum declaration, where the initial constant is
     * assigned an ordinal of zero).
     * @see    names() for the enum declaration
     *
     * @access private
     */
    private $ordinal;

    /**
     * Returns the name of this enum.
     *
     * @return string name of this enum
     */
    public final function name()
    {
        return $this->name;
    }

    /**
     * The ordinal of this enumeration (its position in the enum declaration, where the initial constant is assigned an
     * ordinal of zero).
     *
     * @see names() for the enum declaration
     *
     * @return mixed the value of this enum
     */
    public final function ordinal()
    {
        return $this->ordinal;
    }

    /**
     * Returns the translated representation of this enum name. If no translation is available the string being returned
     * will be the name of this enum as contained in the declaration.
     *
     * @see names() for the declaration
     *
     * @return string (translated) name of this enum
     */
    public final function translate()
    {
        return static::translations()[$this->name()];
    }

    /**
     * Returns a hash which can uniquely identify one specific enumerable value.
     *
     * @return string a hash to uniquely identify the enum
     */
    public final function hashCode()
    {
        return md5(serialize($this));
    }

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
    public final function refresh()
    {
        return $this::valueOf($this->name);
    }

    /**
     * Checks whether this enum is equal to the provided one. Each enum is created once so the provided object can only
     * be equal with this one if they are exactly the same objects.
     *
     * @see refresh() However, if this returns false despite the fact that you are sure they are the same, use a
     * refreshed version. If this helps you may have worked with a serialized/cloned version of the enum.
     *
     * @see Enum::$_hashCodeEnum where each enum is stored so the provided enum must come from this array.
     *
     * @param interfaces\Comparable $comparable object to check its equality to this Enum
     * @param bool                  $typeSafe   whether to do type safe comparisons. Is ignored because this Enum can
     *                                          only equal the provided one if they are exactly the same objects.
     *
     * @return bool true if this enum equals the provided one, false otherwise
     */
    public final function equals(interfaces\Comparable $comparable, $typeSafe = true)
    {
        return $this->compareValue() === $comparable->compareValue();
    }

    /**
     * Returns the value to be used for the comparison.
     *
     * @return static the enum to be used for the comparison.
     */
    public final function compareValue()
    {
        return $this;
    }

    /**
     * Enum constructor.
     *
     * @param string $name    The name of this enum, which is the identifier used to declare it.
     * @param mixed  $ordinal The ordinal of this enumeration (its position in the enum declaration within @see values(),
     *                        where the initial constant is assigned an ordinal of zero).
     *
     * @access private
     */
    private function __construct($name, $ordinal)
    {
        $this->name    = $name;
        $this->ordinal = $ordinal;
    }

    /**
     * Returns the name of this enum as contained in the declaration or, if available, the translated name.
     * This method may be overridden, though it typically isn't necessary or desirable. An enum type should override
     * this method when a more "programmer-friendly" string form exists.
     *
     * @return string (translated) name of this enum
     */
    public function __toString()
    {
        return $this->translate();
    }

    /**
     * Allows creating enums by calling its name in a static context of the class.
     *
     * @param string $name the name of the enum to be created
     * @param mixed  $arguments
     *
     * @return static
     */
    public final static function __callStatic($name, $arguments)
    {
        return static::valueOf($name);
    }

    /**
     * @return array list of all enumeration ordinal values (their positions in the enum declaration within @see names(),
     * where the initial constant is assigned an ordinal of zero) with their associated name as key
     */
    public final static function ordinals()
    {
        return array_flip(static::names());
    }

    /**
     * Returns a list of all translated names where the origin names are keys.
     *
     * @return array list of all translated enumerations with their associated name as key
     */
    public static function translations()
    {
        return array_combine($names = static::names(), $names);
    }

    /**
     * Returns a list of all enumerations available in the class
     *
     * @return static[] list of all enumerations available in the class
     */
    public final static function enumerations()
    {
        return array_map('static::valueOf', static::names());
    }

    /**
     * Factory to return an instance of the current enum type with the specified name. The name must match exactly an
     * identifier used to declare an enum constant in this type. (Extraneous whitespace characters are not permitted.)
     *
     * Note that this method is the only way to create Enumerable instances. Additionally this method will rather
     * returns a stored version (of a previous call) of the requested enum instead of re-creating it.
     *
     * @see $_hashCodeEnum which holds all the enums and is used as Enum store whenever an Enum is to be returned.
     *
     * @param string $name the name of the constant to return
     *
     * @return static enum instance of the current enum type with the specified name
     *
     * @throws LogicException if given name is of invalid type, or there are more that once enum associated with that
     * name, or there is no such Enum available.
     */
    public final static function valueOf($name)
    {
        if (!is_string($name)) {

            throw new InvalidArgumentException(sprintf('Enum can only be identified by strings, %s given',
                gettype($name)));
        }

        $ordinals = array_keys(static::names(), $name, true);
        $ordinal  = array_pop($ordinals);
        if (!empty($ordinals)) {

            throw new OutOfRangeException(sprintf('Enum type %s is not unique and thus can not be added', $name));
        } elseif (is_null($ordinal)) {

            throw new DomainException(sprintf('Enum type %s with the specified name %s does not exist',
                get_called_class(), $name));
        }

        $enum = new static($name, $ordinal);
        if (!isset(self::$_hashCodeEnum[$hashCode = $enum->hashCode()])) {

            self::$_hashCodeEnum[$hashCode] = $enum;
        }

        return self::$_hashCodeEnum[$hashCode];
    }

    /**
     * Returns an instance of the current enum type with the specified ordinal value (its position in the enum
     * declaration within @see names(), where the initial constant is assigned an ordinal of zero) with their associated
     * name as key.
     *
     * @see valueOf this works the same but using enum name instead of its oridinal value.
     *
     * @param mixed $ordinal the ordinal value of the constant to be returned
     *
     * @return static enum instance of the current enum type with the specified ordinal value
     */
    public static function fromOrdinal($ordinal)
    {
        if (!key_exists($ordinal, $names = static::names())) {

            throw new DomainException(sprintf('Enum type %s with the specified ordinal %s does not exist',
                get_called_class(), $ordinal));
        }

        return static::valueOf($names[$ordinal]);
    }
}