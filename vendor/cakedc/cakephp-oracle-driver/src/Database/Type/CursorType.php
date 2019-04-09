<?php
/**
 * Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\OracleDriver\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

/**
 * Provides behavior for the cursors type
 */
class CursorType extends Type
{

    /**
     * Casts given value from a PHP type to one acceptable by database
     *
     * @param mixed $value value to be converted to database equivalent
     * @param Driver $driver object from which database preferences and configuration will be extracted
     * @return mixed
     */
    public function toDatabase($value, Driver $driver)
    {
        if ($value === null || $value === '') {
            return null;
        }

        return parent::toDatabase($value, $driver);
    }

    /**
     * Marshalls request data into a PHP string
     *
     * @param mixed $value The value to convert.
     * @return string|null Converted value.
     */
    public function marshal($value)
    {
		return null;
    }


    /**
     * @inheritDoc
     */
    public function toStatement($value, Driver $driver)
    {
        return PDO::PARAM_STMT;
    }

}
