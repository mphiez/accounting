<?php
return array(
    /* PHP config, override php.ini */
    'php' => array(
        'display_errors' => true,
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
            'config' => 'naf_config_dev',
            'users' => 'naf_users_dev',
            'user_status' => 'naf_user_statuses_dev',
            'user_statuses' => 'naf_user_statuses_dev',
            'access_grant_types' => 'naf_access_grant_types_dev',
            'access_grants' => 'naf_access_grants_dev',
            'access_object_types' => 'naf_access_object_types_dev',
            'access_objects' => 'naf_access_objects_dev',
            'access_permissions' => 'naf_access_permissions_dev',
            'access_roles' => 'naf_access_roles_dev',
            'sessions' => 'naf_sessions_dev',
			'users' => 'naf_users_dev',
			'rekap' => 'naf_ncx_rekap_dev',
            'order' => 'ORDER_PREV_dev',
            'ncx_ogp' => 'dwh_sales.m_ncx_ogp_dev',
            'ncx_quote' => 'dwh_sales.m_ncx_quote_dev',
            'ncx_log' => 'naf_master_log_dev',
            'LOG_INPUT' => 'NAF_LOG_INPUT_dev',
            'LOGS' => 'NAF_LOG_dev',
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
		'server' => '',
		'table' => '_DEV',
		'user_update' => '@crmsit',
		'data_order' => '@crmsit',
		'data_termin' => '@crmuat',
		'from_data' => 'siebel.',
    )
);