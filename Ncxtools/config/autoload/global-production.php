<?php
return array(
    /* PHP config, override php.ini */
    'php' => array(
        'display_errors' => false,
        'error_reporting' => E_ALL,
    ),
    /* application config key -- for getConfig */
    'application' => array(
        'config' => 'ncxtools',
    ),
    /* Application specific config */
    'ncxtools' => array(
        /* db config */
        'databases' => array(
            /* 'primary' => array(
                'driver' => 'Pdo',
                'host' =>  'localhost',
                'port' => '3306',
                'username' => 'root',
                'password' => '',
                'schema' => 'ncxtool',
                'schemas' => array(
                    '\\' => 'ncxtools',
                ),
            ), */
			/* 'primary' => array(
				'driver' => 'Pdo',
				'host' => '127.0.0.1',
				'port' => 3306,
				'username' => 'root',
				'password' => '',
				'schema' => 'ncxtools',
				'schemas' => array(
				),
			), */
			'primary' => array(
				'driver' => 'Oci8',
				'host' => '10.6.16.142',
				'port' => 1523,
				'username' => 'moncrm',
				'password' => 'telco',
				'schema' => 'xe',
				'schemas' => array(
				),
			),
			'third' => array(
				'driver' => 'Oci8',
				'host' => '10.60.180.19',
				'port' => 1525,
				'username' => 'USR_WEB',
				'password' => 'USRWEB#2018',
				'schema' => 'dwhnas',
				'schemas' => array(
				),
			),
        ),
		'languages' => array(
            'id' => 'Bahasa',
            'en' => 'English',
        ),
        'permissions' => array(
            1 => 'view',
            2 => 'modify',
            3 => 'execute',
            4 => 'all',
        ),
        'authentications' => array(
            1 => 'Database',
            2 => 'LDAP',
            3 => 'Token',
        ),
        'activation' => 'none',
        'unique' => 'code',
        'password' => 'autogenerate',
        'attempts' => 0,
        /* table map */
        'tables' => array(
            'config' => 'naf_config',
            'users' => 'naf_users',
            'user_status' => 'naf_user_statuses',
            'user_statuses' => 'naf_user_statuses',
            'access_grant_types' => 'naf_access_grant_types',
            'access_grants' => 'naf_access_grants',
            'access_object_types' => 'naf_access_object_types',
            'access_objects' => 'naf_access_objects',
            'access_permissions' => 'naf_access_permissions',
            'access_roles' => 'naf_access_roles',
            'sessions' => 'naf_sessions',
			'users' => 'naf_users',
			'rekap' => 'naf_ncx_rekap',
            'order' => 'ORDER_PREV',
            'ncx_ogp' => 'dwh_sales.m_ncx_ogp',
            'ncx_quote' => 'dwh_sales.m_ncx_quote',
            'ncx_log' => 'naf_master_log',
            'LOG_INPUT' => 'NAF_LOG_INPUT',
            'LOGS' => 'NAF_LOG',
            'dual' => 'DUAL',
            'queue' => 'NAF_QUEUE',
        ),
        /* session config */
        'session' => array(
            'name' => 'ncxtools',
            'mode' => 'default', //default, db, or cache
        ),
        /* composite config */
        'composite' => array(
            'formlayout' => 'layout/inside',
            'restlayout' => 'neuron/composite/layout/rest',
            'viewprefix' => 'neuron/composite/form',
        ),
		/* 'server' => '_PROD',
		'table' => '',
		'user_update' => '@ody',
		'data_order' => '@crm',
		'data_termin' => '@crm',
		'from_data' => 'sblprd.' */
    )
);