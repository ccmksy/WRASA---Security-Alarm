<?php
/**
 * Protect JavaScript
 * 
 * This will be used when you want to protect JavaScript or activate some 
 * functions like "Disable Hot Keys Function".
 * 
 * @package	WRASA
 * @author	WRASA Dev Team
 * @copyright	Copyright (c) 2016 - 2017, Cloud Design Limited (http://www.cloud-design.hk/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://wrasa.codage.tech
 * @since	Version 1.0.0
 * @filesource
 */

/* Include Files */
require_once dirname(__DIR__).'/core/language/en_lang.php';                     // For exit message.
require_once dirname(__DIR__).'/core/Config.php';
require_once dirname(__DIR__).'/core/libraries/BrowserDetection.php';
require_once dirname(__DIR__).'/core/libraries/WrasaFunc.php';
require_once dirname(__DIR__).'/core/libraries/WrasaCore.php';

/* New Wrasa Object */
$wscsa = new WrasaCore;
$wscsa->protect_js($config, $lang);