<?php
/**
 * Warning Tools
 * 
 * This is designed for Warning.php use only.  
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
require_once dirname(__DIR__).'/core/Config.php';
require_once dirname(__DIR__).'/core/libraries/BrowserDetection.php';
require_once dirname(__DIR__).'/core/libraries/WrasaFunc.php';
require_once dirname(__DIR__).'/core/libraries/WrasaCore.php';

/* New Wrasa Object */
$wscsa = new WrasaCore;
$wscsa->warning_tools($config, $lang);
