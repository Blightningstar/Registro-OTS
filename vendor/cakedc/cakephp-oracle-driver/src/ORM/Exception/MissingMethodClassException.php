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

namespace CakeDC\OracleDriver\ORM\Exception;

use Cake\Core\Exception\Exception;

/**
 * Exception raised when a Table could not be found.
 *
 */
class MissingMethodClassException extends Exception
{

    protected $_messageTemplate = 'Method class %s could not be found.';
}
