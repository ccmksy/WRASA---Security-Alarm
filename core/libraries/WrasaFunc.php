<?php
/**
 * Wrasa Func
 * 
 * @package	WRASA
 * @author	WRASA Dev Team
 * @copyright	Copyright (c) 2016 - 2017, Cloud Design Limited (http://www.cloud-design.hk/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://wrasa.codage.tech
 * @version     1.0.1
 * @filesource
 */
class WrasaFunc {    
    
    /**
     * Get Visitor IP
     * 
     * @access public
     * @return	string
     */
    public function get_VisitorIP()
    {
        if (isset($_SERVER))
        {
            if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                if(strpos($ip,","))
                {
                    $exp_ip = explode(",",$ip);
                    $ip = $exp_ip[0];
                }
            }
            elseif(isset($_SERVER["HTTP_CLIENT_IP"]))
            {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            }
            else
            {
                $ip = $_SERVER["REMOTE_ADDR"];
            }
        }
        else
        {
            if(getenv('HTTP_X_FORWARDED_FOR'))
            {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
                if(strpos($ip,","))
                {
                    $exp_ip=explode(",",$ip);
                    $ip = $exp_ip[0];
                }
            }
            elseif(getenv('HTTP_CLIENT_IP'))
            {
                $ip = getenv('HTTP_CLIENT_IP');
            }
            else
            {
                $ip = getenv('REMOTE_ADDR');
            }
        }        
       return $ip; 
    }    
    
    
    /**
     * Get Referrer Info
     * 
     * @access public
     * @return	array
     */
    public function get_ReferrerInfo()
    {    
        $get_referrer = $this->get_Referrer();
        $referrer['path'] = $get_referrer ? $get_referrer : '';
        $referrer['host'] = $referrer['path'] ? parse_url($referrer['path'], PHP_URL_HOST) : '';
        $referrer['ip'] = $referrer['host'] ? gethostbyname($referrer['host']) : '';             
        return $referrer; 
    }       
      
    
    /**
     * Get the referrer
     *
     * @access public
     * @return	bool
     */
    public function get_Referrer()
    {
        return empty($_SERVER['HTTP_REFERER']) ? '' : trim($_SERVER['HTTP_REFERER']);
    }  

    
    /**
     * Get Blocking Notice
     * 
     * @access public
     * @return string
     */     
    public function get_BlockingNotice($domain)
    {
        $path_a = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__DIR__));
        $path_b = str_replace('core', '', $path_a);
        $file = "{$domain}{$path_b}notice/Blocking.php";                 
        return $file;
    }
    
    
    /**
     * Get Warning Notice
     * 
     * @access public
     * @return string
     */    
    public function get_WarningNotice($domain)
    {
        $path_a = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(__DIR__));
        $path_b = str_replace('core', '', $path_a);
        $file = "{$domain}{$path_b}notice/Warning.php";                 
        return $file;     
    }     
    
    
    /**
     * Get Client JS File
     *
     * @access public
     * @return	string
     */    
    public function get_ClientJs($js_files, $js_obfuscate)
    {           
        $output = "";          
        foreach($js_files as $file)
        {
            $output .= $this->curl($file);                  
        }  
        
        if( ! $js_obfuscate)
        {
            $result = $output; 
        }
        else
        {
            $jspacker = $this->jspack($output, 'Normal', TRUE, FALSE); 
            $result = $jspacker->pack();  
        }
        
        return $result;
    }       
    

    /**
     * Plugin Devtool JS
     *
     * @access public
     * @return	string
     */ 
    public function plugin_DevtoolJs()
    {
        $plugin = 'var _0x7354=["\x75\x73\x65\x20\x73\x74\x72\x69\x63\x74","\x64\x65\x76\x74\x6F\x6F\x6C\x73\x63\x68\x61\x6E\x67\x65","\x64\x69\x73\x70\x61\x74\x63\x68\x45\x76\x65\x6E\x74","\x6F\x75\x74\x65\x72\x57\x69\x64\x74\x68","\x69\x6E\x6E\x65\x72\x57\x69\x64\x74\x68","\x6F\x75\x74\x65\x72\x48\x65\x69\x67\x68\x74","\x69\x6E\x6E\x65\x72\x48\x65\x69\x67\x68\x74","\x76\x65\x72\x74\x69\x63\x61\x6C","\x68\x6F\x72\x69\x7A\x6F\x6E\x74\x61\x6C","\x46\x69\x72\x65\x62\x75\x67","\x63\x68\x72\x6F\x6D\x65","\x69\x73\x49\x6E\x69\x74\x69\x61\x6C\x69\x7A\x65\x64","\x6F\x70\x65\x6E","\x6F\x72\x69\x65\x6E\x74\x61\x74\x69\x6F\x6E","\x75\x6E\x64\x65\x66\x69\x6E\x65\x64","\x65\x78\x70\x6F\x72\x74\x73","\x64\x65\x76\x74\x6F\x6F\x6C\x73"];(function(){_0x7354[0];var _0x5188x1={open:false,orientation:null};var _0x5188x2=160;var _0x5188x3=function(_0x5188x4,_0x5188x5){window[_0x7354[2]]( new CustomEvent(_0x7354[1],{detail:{open:_0x5188x4,orientation:_0x5188x5}}))};setInterval(function(){var _0x5188x6=window[_0x7354[3]]- window[_0x7354[4]]> _0x5188x2;var _0x5188x7=window[_0x7354[5]]- window[_0x7354[6]]> _0x5188x2;var _0x5188x5=_0x5188x6?_0x7354[7]:_0x7354[8];if((window[_0x7354[9]]&& window[_0x7354[9]][_0x7354[10]]&& window[_0x7354[9]][_0x7354[10]][_0x7354[11]])|| _0x5188x6|| _0x5188x7){if(!_0x5188x1[_0x7354[12]]|| _0x5188x1[_0x7354[13]]!== _0x5188x5){_0x5188x3(true,_0x5188x5)};_0x5188x1[_0x7354[12]]= true;_0x5188x1[_0x7354[13]]= _0x5188x5}else {if(_0x5188x1[_0x7354[12]]){_0x5188x3(false,null)};_0x5188x1[_0x7354[12]]= false;_0x5188x1[_0x7354[13]]= null}},500);if( typeof module!== _0x7354[14]&& module[_0x7354[15]]){module[_0x7354[15]]= _0x5188x1}else {window[_0x7354[16]]= _0x5188x1}})()';    
        return $plugin;
    }

     
    /**
     * Run Devtool Scripts
     *
     * @access public
     * @return	string
     */     
    public function run_DevtoolScripts($warning_files)
    {        
        $run = "var wsc_link = '".$warning_files."';\n\n";
        $run .= 'var _0x6bd2=["\x6F\x6E\x74\x6F\x75\x63\x68\x73\x74\x61\x72\x74","\x64\x6F\x63\x75\x6D\x65\x6E\x74\x45\x6C\x65\x6D\x65\x6E\x74","\x6D\x61\x74\x63\x68","\x75\x73\x65\x72\x41\x67\x65\x6E\x74","\x6F\x70\x65\x6E","\x64\x65\x76\x74\x6F\x6F\x6C\x73","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x64\x65\x76\x74\x6F\x6F\x6C\x73\x63\x68\x61\x6E\x67\x65","\x64\x65\x74\x61\x69\x6C","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x6F\x6E\x73\x65\x6C\x65\x63\x74\x73\x74\x61\x72\x74","\x75\x6E\x64\x65\x66\x69\x6E\x65\x64","\x4D\x6F\x7A\x55\x73\x65\x72\x53\x65\x6C\x65\x63\x74","\x73\x74\x79\x6C\x65","\x6E\x6F\x6E\x65","\x6F\x6E\x6D\x6F\x75\x73\x65\x64\x6F\x77\x6E","\x63\x75\x72\x73\x6F\x72","\x64\x65\x66\x61\x75\x6C\x74","\x62\x6F\x64\x79","\x6F\x6E\x6B\x65\x79\x64\x6F\x77\x6E","\x63\x74\x72\x6C\x4B\x65\x79","\x6B\x65\x79\x43\x6F\x64\x65","\x73\x68\x69\x66\x74\x4B\x65\x79","\x63\x6F\x6E\x74\x65\x78\x74\x6D\x65\x6E\x75","\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74"];var isMobile=(_0x6bd2[0] in  document[_0x6bd2[1]]&& navigator[_0x6bd2[3]][_0x6bd2[2]](/Mobi/));if(!isMobile){if(window[_0x6bd2[5]][_0x6bd2[4]]){window[_0x6bd2[6]]= wsc_link};window[_0x6bd2[9]](_0x6bd2[7],function(_0x976ex2){if(_0x976ex2[_0x6bd2[8]][_0x6bd2[4]]){window[_0x6bd2[6]]= wsc_link}})};function disableSelection(_0x976ex4){if( typeof _0x976ex4[_0x6bd2[10]]!= _0x6bd2[11]){_0x976ex4[_0x6bd2[10]]= function(){return false}}else {if( typeof _0x976ex4[_0x6bd2[13]][_0x6bd2[12]]!= _0x6bd2[11]){_0x976ex4[_0x6bd2[13]][_0x6bd2[12]]= _0x6bd2[14]}else {_0x976ex4[_0x6bd2[15]]= function(){return false};_0x976ex4[_0x6bd2[13]][_0x6bd2[16]]= _0x6bd2[17]}}}disableSelection(document[_0x6bd2[18]]);document[_0x6bd2[19]]= function(_0x976ex2){if(_0x976ex2[_0x6bd2[20]]&& (_0x976ex2[_0x6bd2[21]]=== 65|| _0x976ex2[_0x6bd2[21]]=== 67|| _0x976ex2[_0x6bd2[21]]=== 73|| _0x976ex2[_0x6bd2[21]]=== 80|| _0x976ex2[_0x6bd2[21]]=== 85)){window[_0x6bd2[6]]= wsc_link;return false};if(_0x976ex2[_0x6bd2[21]]=== 123){window[_0x6bd2[6]]= wsc_link;return false};if(_0x976ex2[_0x6bd2[20]]&& _0x976ex2[_0x6bd2[22]]&& (_0x976ex2[_0x6bd2[21]]=== 67|| _0x976ex2[_0x6bd2[21]]=== 73|| _0x976ex2[_0x6bd2[21]]=== 74|| _0x976ex2[_0x6bd2[21]]=== 75|| _0x976ex2[_0x6bd2[21]]== 81|| _0x976ex2[_0x6bd2[21]]=== 83)){window[_0x6bd2[6]]= wsc_link;return false};if(_0x976ex2[_0x6bd2[22]]&& (_0x976ex2[_0x6bd2[21]]=== 116|| _0x976ex2[_0x6bd2[21]]=== 118)){window[_0x6bd2[6]]= wsc_link;return false}};document[_0x6bd2[9]](_0x6bd2[23],function(_0x976ex2){_0x976ex2[_0x6bd2[24]]()},false)';
        return $run;
    }        
      
    
    /**
     * Curl
     * 
     * @access public
     * @return string
     */
    public function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);      
        return $output;
    }  
    
    
    /**
     * jspack
     *
     * @access public
     * @return	object
     */     
    public function jspack($param = NULL) 
    { 
        require_once dirname(__DIR__)."/libraries/JavaScriptPacker.php";
        return new JavaScriptPacker($param);         
    }   
    
    
    /**
     * send_mail
     * 
     * @access public
     * @return string
     */
    public function send_mail($vis_ip, $ref_ip, $ref_path, $response_code, $webmaster_email)
    {
        $msg = '"CDT":"'.date('Y-m-d H:i:s').'",'. "\n";
        $msg .= '"ResponseCode":"'.$response_code.'",'. "\n";
        $msg .= '"VisitorIP":"'.$vis_ip.'",'. "\n";
        $msg .= '"ReferrerIP":"'.$ref_ip.'",'. "\n";
        $msg .= '"ReferrerPath":"'.htmlspecialchars(trim($ref_path)).'",'. "\n";        
        $msg .= '"RequestURI":"'.htmlspecialchars(trim($_SERVER['REQUEST_URI'])).'",'. "\n";
        $msg .= '"UserAgent":"'. htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT'])).'"'. "\n";  

        
        $subject = "WRASA Alert";
        $headers = "From: no-reply@{$_SERVER['HTTP_HOST']}";
        
        // Activate mail function if the value is set.
        if($webmaster_email[0])
        {
            mail(implode(",", $webmaster_email), $subject, $msg, $headers);
        }            
    } 
    
    /**
     * redirect_notice
     * 
     * @access public
     * @return void
     */
    public function redirect_notice($check_for, $domain, $msg)
    {
        if($check_for == 'js')
        {            
            echo "window.location = '". $this->get_BlockingNotice($domain) ."';";
        }
        else
        {
            header("Location: ". $this->get_BlockingNotice($domain));
            exit("{$msg}"); 
        }                
    }    

    
    /**
     * Write Block List
     * 
     * @access public
     * @return void
     */    
    public function write_BlockList($vis_ip, $ref_ip, $ref_path, $response_code)
    {  
        $msg = '"CDT":"'.date('Y-m-d H:i:s').'",';
        $msg .= '"ResponseCode":"'.$response_code.'",';
        $msg .= '"VisitorIP":"'.$vis_ip.'",';
        $msg .= '"ReferrerIP":"'.$ref_ip.'",';
        $msg .= '"ReferrerPath":"'.htmlspecialchars(trim($ref_path)).'",';
        $msg .= '"RequestURI":"'.htmlspecialchars(trim($_SERVER['REQUEST_URI'])).'",';
        $msg .= '"UserAgent":"'. htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT'])).'"';        
        
        $file = dirname(__DIR__). '/data/BlockList.json';
        $handle = fopen($file, "r+");
        fseek($handle, -2, SEEK_END);
        fwrite($handle, "\t,{".$msg. "}\n]}").PHP_EOL;
        fclose($handle);        
    } 
    
    
    /**
     * Write Suspect List
     * 
     * @access public
     * @return void
     */    
    public function write_SuspectList($vis_ip, $ref_ip, $ref_path, $response_code)
    {  
        $msg = '"CDT":"'.date('Y-m-d H:i:s').'",';
        $msg .= '"ResponseCode":"'.$response_code.'",';
        $msg .= '"VisitorIP":"'.$vis_ip.'",';
        $msg .= '"ReferrerIP":"'.$ref_ip.'",';
        $msg .= '"ReferrerPath":"'.htmlspecialchars(trim($ref_path)).'",';        
        $msg .= '"RequestURI":"'.htmlspecialchars(trim($_SERVER['REQUEST_URI'])).'",';
        $msg .= '"UserAgent":"'. htmlspecialchars(trim($_SERVER['HTTP_USER_AGENT'])).'"';        
        
        $file = dirname(__DIR__). '/data/SuspectList.json';
        $handle = fopen($file, "r+");
        fseek($handle, -2, SEEK_END);
        fwrite($handle, "\t,{".$msg. "}\n]}").PHP_EOL;
        fclose($handle);        
    }       
    
}
