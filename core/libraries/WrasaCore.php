<?php
/**
 * Wrasa Core
 * 
 * @package	WRASA
 * @author	WRASA Dev Team
 * @copyright	Copyright (c) 2016 - 2017, Cloud Design Limited (http://www.cloud-design.hk/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://wrasa.codage.tech
 * @version     1.0.1
 * @filesource
 */
class WrasaCore extends WrasaFunc{
    

    /**
     * Warning Tools
     * 
     * @access public
     * @return	string
     */    
    public function warning_tools($config, $lang)
    {        
        $response_code = "HOT";
        
        // Set referrer info variable
        $referrer_info = parent::get_ReferrerInfo();
        $ref_path = $referrer_info['path'];
        $ref_ip = $referrer_info['ip'];        
        
        // Visitor ip
        $vis_ip = parent::get_VisitorIP();                             
        
        // Check if visitor ip is webmaster ip
        //if($config['WebmasterIP'] != $vis_ip)
        if( ! $this->is_WebmasterIP($vis_ip, $config['WebmasterIP']))
        {
            // Start the session for analysis warning only.
            session_start();

            // Setup WarningCount Session
            if( ! isset($_SESSION['WarningCount']))
            {
                $_SESSION['WarningCount'] = 0;
                parent::send_mail($vis_ip, $ref_ip, $ref_path, $response_code, $config['WebmasterEmail']); 
            }      
            
            // If MaxWarningTimes over WarningCount, visitors will be blocked.
            if( isset($_SESSION['WarningCount']) && $_SESSION['WarningCount'] < $config['MaxWarningTimes']) 
            {
                parent::write_SuspectList($vis_ip, $ref_ip, $ref_path, $response_code);                 
                $_SESSION['WarningCount']++;
            }
            else
            {
                // Reset & Clear Session
                $_SESSION['WarningCount'] = 0;
                session_unset(); 
                session_destroy();      

                // Write Block List  
                parent::write_SuspectList($vis_ip, $ref_ip, $ref_path, $response_code); 
                parent::write_BlockList($vis_ip, $ref_ip, $ref_path, $response_code);                             

                // Redirect Blocked Notice 
                parent::redirect_notice('', $config['BaseURL'], $lang['BlockedMsg']); 
                exit('Banned');
            } 
        }
    }     
    
    
    
    /**
     * Protect Page
     * 
     * Protect normal page not Javascript.
     * 
     * @access public
     * @return	void
     */    
    public function protect_pg($config, $lang)
    {             
        // Visitor IP
        $vis_ip = parent::get_VisitorIP();        
        
        // Check if visitor ip is webmaster ip
        //if($config['WebmasterIP'] != $vis_ip)
        if( ! $this->is_WebmasterIP($vis_ip, $config['WebmasterIP']))
        {
            $this->checking($config, $lang);
        }              
    }   
    
    
    /**
     * Protect Javascript.
     * 
     * @access public
     * @return	string
     */    
    public function protect_js($config, $lang)
    {        
        // Visitor IP
        $vis_ip = parent::get_VisitorIP();
        
        // Check if visitor ip is webmaster ip
        //if($config['WebmasterIP'] != $vis_ip)
        if( ! $this->is_WebmasterIP($vis_ip, $config['WebmasterIP']))
        {
            //Checking & Generate JS
            $this->checking($config, $lang, 'js');
            $js_file = parent::plugin_DevtoolJs(). "\n\n";
            $js_file .= parent::run_DevtoolScripts(parent::get_WarningNotice($config['BaseURL'])). "\n\n";
            $js_file .= parent::get_ClientJs($config["JsFiles"], $config["JsObfuscate"]);                       
        }
        else
        {
            // Generate JS without checking
            $js_file = parent::get_ClientJs($config["JsFiles"], $config["JsObfuscate"]);           
        }

        echo $js_file;              
    }       
        
    
    /**
     * Checking
     * 
     * @access protected
     * @return	bool
     */    
    protected function checking($config, $lang, $check_for = \FALSE)
    {
        // Set referrer info variable
        $referrer_info = parent::get_ReferrerInfo();
        $ref_path = $referrer_info['path'];
        $ref_host = $referrer_info['host'];
        $ref_ip = $referrer_info['ip'];  
        
        // Visitor ip
        $vis_ip = parent::get_VisitorIP();      
        
        // New Browser Detection
        $browser = new BrowserDetection;
        
        // All $xxx_result is False by default
        $first_result = FALSE;   
        $second_result = FALSE;       
        
        // Default $response_code is empty
        $response_code = '';        
        

        // First Checking
        if($this->is_Banned($vis_ip))
        {
            // Redirect Blocked Notice            
            parent::redirect_notice($check_for, $config['BaseURL'], $lang['BlockedMsg']);     
            exit('Banned');
            
        }
        elseif( ! $this->is_browser($browser->getName()))
        {             
            $response_code = "BE";         // BE = Browser Error
        }                
        elseif($this->is_HUA($_SERVER['HTTP_USER_AGENT'], $config["BlockedHUA"]))
        {
            $response_code = "HUA";       // Http User Agent Error
        }
        elseif($check_for == 'js')
        {
            if( ! $this->is_local_referral($ref_host))
            {            
                $response_code = "HE";         // HE = Host Error
            } 
            elseif( ! $this->is_ip($ref_ip))
            {
                $response_code = "IPE";         // IPE = IP Error
            } 
            else
            {
                $first_result = TRUE;
            }
        }
        else
        {
            $first_result = TRUE;
        }

                
        // Second Checking
        if( ! $first_result)
        {
            if($this->is_HUA($_SERVER['HTTP_USER_AGENT'], $config["AllowedHUA"]))
            {
                parent::write_SuspectList($vis_ip, $ref_ip, $ref_path, "HUA".$response_code);    
                $second_result = TRUE; 
            }
            else
            {
                // Write Block List  
                parent::write_SuspectList($vis_ip, $ref_ip, $ref_path, $response_code); 
                parent::write_BlockList($vis_ip, $ref_ip, $ref_path, $response_code);                             

                // Redirect Blocking Notice 
                parent::redirect_notice($check_for, $config['BaseURL'], $lang['BlockedMsg']);  
                exit('Banned');
            }                     
        } 
        else
        {                   
            $isMobile = FALSE;
            $isRobot = FALSE;

            if($browser->isMobile())
            {
                $isMobile = TRUE;
                $response_code .= 'MOB';
            }
            
            if($browser->isRobot())
            {
                $isRobot = TRUE;
                $response_code .= 'BOT';                           
            }

            if($isMobile || $isRobot)
            {
                parent::write_SuspectList($vis_ip, $ref_ip, $ref_path, $response_code);                             
            }
            else
            {
                //parent::write_SuspectList($vis_ip, $ref_ip, $ref_path, "NORMAL");  
            }
            $second_result = TRUE;              
        }
        
        return $second_result;             
    }   
    

    /**
     * Is IP
     * 
     * @access protected
     * @return	bool
     */
    protected function is_ip($ref_ip)
    {
        $result = FALSE;
        $server_ip = gethostbyname($_SERVER['SERVER_NAME']);        
        if($server_ip == $ref_ip)
        {
            $result =  TRUE;
        }  
        return $result;
    }    
    

    /**
     * Is Browser
     * 
     * Attention, the robots are also regarded as Browser.
     * 
     * @access protected
     * @return	bool
     */
    protected function is_browser($browser_name)
    {
        $result = FALSE;
        if($browser_name && $browser_name != "unknown")
        {
            $result =  TRUE;
        }  
        return $result;       
    } 
    
    
    /**
     * Is Local Referral
     * 
     * @access protected
     * @return	bool
     */
    protected function is_local_referral($ref_host)
    {
        $result = FALSE;
        if($_SERVER['HTTP_HOST'] == $ref_host)
        {
            $result =  TRUE;
        }  
        return $result;
    }
            
    
    /**
     * Is Banned
     * 
     * Check if Visitor IP is banned. 
     * 
     * @access protected
     * @param string $vis_ip
     * @return bool
     */
    protected function is_Banned($vis_ip)
    {
        $result = FALSE;
        $file = dirname(__DIR__). '/data/BlockList.json';
        $handle = fopen($file, "r");
        $json_data = fread($handle,filesize($file));
        $json_decode_data = json_decode($json_data, true);          
        foreach($json_decode_data["BlockList"] as $item)
        {            
            if($item["VisitorIP"] == $vis_ip)
            {
                $result = TRUE;
            }            
        }        
        fclose($handle);         
        return $result;
    }  
    
    /**
     * Check if Webmaster IP
     * 
     * @access protected
     * @param string $vis_ip 
     * @param array $webmaster_ip
     * @return bool
     */
    protected function is_WebmasterIP($vis_ip, $webmaster_ip)
    {
        $result = FALSE;
        if(in_array($vis_ip, $webmaster_ip))
        {
            $result = TRUE;
        } 
        return $result;
    }   
    
    
    /**
     * Check if HTTP USER AGENT (blocked or allowed)
     * 
     * This function is designed to supplement the Browser Detection, you can 
     * allow or block the specific HUA by this function.
     * 
     * @access protected
     * @param string $vis_hua 
     * @param array $conf_hua       Blocked HUA or Allowed HUA
     * @return bool
     */    
    protected function is_HUA($vis_hua , $conf_hua)
    {
        $result = FALSE;
        foreach($conf_hua as $item)
        {     
            if(stripos($vis_hua, $item) !== false)
            {
                $result = TRUE;
            }
        }     
        return $result;
    }      
   
 
}
