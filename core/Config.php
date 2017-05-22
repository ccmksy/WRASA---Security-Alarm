<?php
/* -----------------------------------------------------------------------------
 * Base URL
 * -----------------------------------------------------------------------------
 * 
 * Base URL is designed for warning or blocking notice, it should be detect 
 * automatically, if not, please modify yourself.
 */
$config['BaseURL'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['BaseURL'] .= "://".$_SERVER['HTTP_HOST'];


/* -----------------------------------------------------------------------------
 * Webmasters IP address
 * -----------------------------------------------------------------------------
 * 
 * To avoid webmasters' IP address be blocked or warned. 
 * You can set one more IP address like the example:
 * 
 * e.g.
 * array(
 *      '201.163.xxx.xxx',
 *      '218.255.245.198'
 * );
 */
$config['WebmasterIP'] = array();


/* -----------------------------------------------------------------------------
 * Webmasters Email address
 * -----------------------------------------------------------------------------
 * 
 * Send a notification to webmaster. 
 * You can set one more Email address like the example:
 * 
 * e.g.
 * array(
 *      'admin_one@example.com',
 *      'admin_one@example.com'
 * );
 */
$config['WebmasterEmail'] = array();


/* -----------------------------------------------------------------------------
 * Your JavaScript Files
 * -----------------------------------------------------------------------------
 * 
 * Set the url of your JavaScript files that you want to protect.
 * 
 * e.g. 
 * array(
 *      $config["BaseURL"].'/assets/demo1.js',
 *      $config["BaseURL"].'/assets/demo2.js',
 * );
 * 
 * ===========
 * Attention:
 * ===========
 * If you have set the url of your JavaScript files here, you do not need to 
 * insert <script src='.../assets/demo1.js'></script> again in page.
 * 
 * 
 */
$config['JsFiles'] = array();


/* -----------------------------------------------------------------------------
 * Obfuscate JS Files
 * -----------------------------------------------------------------------------
 * 
 * Set the value to be "TRUE" if you want to obfuscate your JavaScript files,
 * otherwise, set the value to be "FALSE".
 */
$config['JsObfuscate'] = TRUE;


/* -----------------------------------------------------------------------------
 * Max Warning Times
 * -----------------------------------------------------------------------------
 * 
 * If over the MaxWarningTimes, the visitor will be blocked. 
 * Suggest the value not more than 3.
 */
$config['MaxWarningTimes'] = 2;


/* -----------------------------------------------------------------------------
 * Blocked HTTP User Agent
 * -----------------------------------------------------------------------------
 * 
 * Set the HTTP User Agent that you disapprove to visit website. 
 * 
 * e.g.
 * array('httrack');
 */
$config['BlockedHUA'] = array('httrack');


/* -----------------------------------------------------------------------------
 * Allowed HTTP User Agent
 * -----------------------------------------------------------------------------
 * 
 * Set the HTTP User Agent that you allow to visit website.
 * 
 * e.g.
 * array('Facebookexternalhit', 'Whatsapp');
 */
$config['AllowedHUA'] = array('Facebookexternalhit', 'Whatsapp');