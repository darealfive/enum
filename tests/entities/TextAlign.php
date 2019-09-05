<?php
/**
 * TextAlign class file
 *
 * @author Sebastian Krein <sebastian@itstrategen.de>
 */

use darealfive\enum\Enum;

/**
 * Class TextAlign
 *
 * @method static static LEFT
 * @method static static CENTER
 * @method static static RIGHT
 */
class TextAlign extends Enum
{
    /**
     * Central method which indicates what enums are available. The keys are the ordinal numbers and the values are the
     * names.
     *
     * @return array list of all enumeration names with their associated value as key
     */
    public static function names(): array
    {
        return [
            'LEFT',
            'CENTER',
            'RIGHT'
        ];
    }
}