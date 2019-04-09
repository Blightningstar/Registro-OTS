# Using Cursors

Cursors are references to prepared statements in the database. Once created you could use them to execute them
later on. It also affects performance because while you work on the cursor the data is being populated in the
database.
Cursors could be returned by Methods, check `fetchCursor` function https://git.cakedc.com/plugins/oracle/blob/master/src/ORM/RequestTrait.php#L431

## Example
### Run a stored function returning a cursor

* We'll create a new Method class. The method class will provide an interface to the stored procedure/function

```php
<?php


namespace App\Model\Method;

use CakeDC\OracleDriver\ORM\Method;
use CakeDC\OracleDriver\Database\Schema\Method as Schema;

class TagsSearchMethod extends Method {

	public function initialize(array $config) {
		$this->method('WORK.TAGS_SEARCH');
	}

    /**
     * @param \CakeDC\OracleDriver\Database\Schema\Method $method
     */
    protected function _initializeSchema(Schema $method)
    {
        return $method;
    }
}
```

* Then in our Controller we could:

```php
    $m = \CakeDC\OracleDriver\ORM\MethodRegistry::get('TagsSearch');
    $r = $m->newRequest([
        'FILTER' => '%'
    ]);
    $m->execute($r);

    $res = $r->fetchCursor(':result', [
       'hydrate' => false, //to return Entities or not
       //'entityClass' => 'Cake\ORM\Entity',
       //for cursors we need to define the structure for the cursor returned
       //we need to define schema to ensure encoding is correct for parameters
       'schema' => [
           'id' => 'uuid',
           'name' => 'string',
           'created' => 'datetime',
           'modified' => 'datetime',
       ],
    ]);
    debug($res->toArray());
```
