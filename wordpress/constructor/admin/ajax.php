<?php
/**
 * All AJAX actions control from this is file
 * 
 * @package WordPress
 * @subpackage Constructor
 */
require_once 'ajax/donate.php';
require_once 'ajax/save.php';

/**
 * Definition of response OK/KO
 *
 * @var string
 */
define('RESPONSE_OK', 'ok');
define('RESPONSE_KO', 'ko');

/**
 * Return simple JSON response
 *
 * @param string $status RESPONSE_OK|RESPONSE_KO
 * @param string $message
 */
function returnResponse($status = RESPONSE_OK, $message = '') {
    header('Content-type: application/json');
    $message = addslashes($message);
    echo "{'status':'$status','message':'$message'}";
    die();
}

?>