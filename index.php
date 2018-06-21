<?php
/**
 * Author: Serhii Filoniuk
 */
define('RECMAN_API_KEY', '150701010135kb9c982b064e6347133216129a7f2fff31755256708');

require_once 'RecmanJobPostApi.php';

$api = new RecmanJobPostApi(RECMAN_API_KEY, 'jobPost');

$api->getJobPosts('name,ingress,body,contacts,address1,address2,images');

die();
