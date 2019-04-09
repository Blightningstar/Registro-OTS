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

namespace CakeDC\OracleDriver\Database\OCI8;

use Cake\Core\Exception\Exception;

class OCI8Exception extends Exception
{
    /**
     * OCI Error builder.
     *
     * @param array $error Error information that includes error message and code.
     * @return OCI8Exception
     */
    public static function fromErrorInfo($error)
    {
        return new self($error['message'], $error['code']);
    }
}
