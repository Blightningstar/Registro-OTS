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


namespace CakeDC\OracleDriver\Database\Statement;

use Cake\Database\Statement\BufferedStatement;

/**
 * Statement class meant to be used by an Oracle driver
 *
 */
class OracleBufferedStatement extends BufferedStatement
{

    /**
     * {@inheritDoc}
     */
    public function fetch($type = 'num')
    {
        if ($this->_allFetched) {
            $row = ($this->_counter < $this->_count) ? $this->_records[$this->_counter++] : false;
            $row = ($row && $type === 'num') ? array_values($row) : $row;
            return $row;
        }

        $this->_fetchType = $type;
        $record = $this->_statement->fetch($type);

        if ($record === false) {
            $this->_allFetched = true;
            $this->_counter = $this->_count + 1;
            $this->_statement->closeCursor();
            return false;
        }

        if (is_array($record)) {
            foreach ($record as $key => &$value) {
                if (is_resource($value)) {
                    $value = stream_get_contents($value);
                }
            }
        }

        $this->_count++;
        return $this->_records[] = $record;
    }

}
