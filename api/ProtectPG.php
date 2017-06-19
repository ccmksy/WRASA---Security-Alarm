<?php
/**
 * Protect Page
 * 
 * This is optional, it is designed to protect the page only, not JavaScript.
 * 
 * @package	WRASA
 * @author	WRASA Dev Team
 * @copyright	Copyright (c) 2016 - 2017, Cloud Design Limited (http://www.cloud-design.hk/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://wrasa.codage.tech
 * @version     1.0.1
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
$wscsa->protect_pg($config, $lang);
