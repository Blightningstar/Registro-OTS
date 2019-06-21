<?php
return [
    'Datasources' => [
        'test' => [
			'className' => 'CakeDC\OracleDriver\Database\OracleConnection',
            'driver' => 'CakeDC\OracleDriver\Database\Driver\OracleOCI', # For OCI8
            //'datasource' => 'Database/Mysql',
            'host'       => 'ec2-52-15-184-142.us-east-2.compute.amazonaws.com',
			'port' => '1521', # Database port number (default: 1521)
            'database'   => 'orcl',
            'username'   => 'OTS',
            'password'   => 'oracle',
            'encoding'   => 'utf8',
			'sid' => '',                    # Database System ID (maps to Oracle's `SID`)
            'instance' => '',               # Database instance name (maps to Oracle's `INSTANCE_NAME`)
            'pooled' => '',                 # Database pooling (maps to Oracle's `SERVER=POOLED`)
        ],
    ]
];