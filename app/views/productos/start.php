<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require __DIR__ . '/../../vendor/autoload.php';

// API
$api = new ApiContext(
		new OAuthTokenCredential(
			'AeZFxxDWVfRCSjHIkMUTXLBnl-s5-oiFU_YvYAsY_wgYVUvole-CowvvmOoG',
			'EA8b6hDuZSmVTtOHGp6sUc-5ggQZKoEvEGDPcPJTkS58kwTSNTWaD2SN1VDp'
		)
	);

$api->setConfig([
	'mode' => 'sandbox',
	'http.ConnectionTimeOut' => 30,
	'log.LogEnabled' => false,
	'log.FileName' => '',
	'log.Loglevel' => 'FINE',
	'validation.level' => 'log'
]);
