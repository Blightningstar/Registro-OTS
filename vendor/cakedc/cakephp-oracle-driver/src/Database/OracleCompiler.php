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

namespace CakeDC\OracleDriver\Database;

use Cake\Database\QueryCompiler;

class OracleCompiler extends QueryCompiler
{
    /**
     * {@inheritDoc}
     */
    protected $_selectParts = [
        'select',
        'from',
        'join',
        'where',
        'group',
        'having',
        'order',
        'union',
        'epilog'
    ];

    /**
     * Builds the SQL fragment for INSERT INTO.
     *
     * @param array $parts The insert parts.
     * @param \Cake\Database\Query $query The query that is being compiled
     * @param \Cake\Database\ValueBinder $generator the placeholder generator to be used in expressions
     * @return string SQL fragment.
     */
    protected function _buildInsertPart($parts, $query, $generator)
    {
        $driver = $query->connection()->driver();
        $table = $driver->quoteIfAutoQuote($parts[0]);
        $columns = $this->_stringifyExpressions($parts[1], $generator);
        return sprintf('INSERT INTO %s (%s)', $table, implode(', ', $columns));
    }

}
