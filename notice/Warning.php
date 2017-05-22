<!DOCTYPE html>
<?php
// Detect & Switch Language File
$http_accept_lang = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5));
if(file_exists(dirname(__DIR__).'/core/language/'.$http_accept_lang.'_lang.php'))
{
    require_once dirname(__DIR__).'/core/language/'.$http_accept_lang.'_lang.php';
    $lang_code = $http_accept_lang;
}
elseif(file_exists(dirname(__DIR__).'/core/language/'.substr($http_accept_lang, 0, 2).'_lang.php'))
{
    require_once dirname(__DIR__).'/core/language/'.substr($http_accept_lang, 0, 2).'_lang.php';
    $lang_code = substr($http_accept_lang, 0, 2);  
}
else
{
    require_once dirname(__DIR__).'/core/language/en_lang.php';
    $lang_code = 'en';
}

// Include WarningTools.php
require_once dirname(__DIR__).'/api/WarningTools.php';
?>
<html lang="<?php echo $lang_code; ?>">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $lang["WarningTitle"]; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="author" content="Cloud Design Limited" >
        <meta name="robots" content="noindex,nofollow">
        <link rel="stylesheet" type="text/css" href="assets/fonts/Open_Sans_Hebrew/fonts.css" />
        <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-3.3.6-dist/css/bootstrap_custom.css">
        <link rel="stylesheet" type="text/css" href="assets/plugins/font-awesome-4.5.0/css/font-awesome.min.css">
        <style type="text/css">
        body {
            background-color: #fff;
        }
        .fa {
            font-size: 250px;
        }
        h1 {
            letter-spacing: 10px;
            margin-bottom: 20px;
        }
        .powered {
            margin-top: 80px;
            font-size: 12px;
            color: #999;
            line-height: 2.2;
        }
        .powered img {
            height: 22px;
        }
        #go-back-link {
            color: #222D32;
            font-weight: 700;
            text-decoration: none;
        }
        .fa-external-link {
            font-size: 14px;
            font-weight: 700;
        }
        </style>
    </head>
    <body>

        
        <!-- Section -->   
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="fa fa-warning"></span>&nbsp;&nbsp;<br>
                        <h1 class="text-uppercase"><?php echo $lang["WarningTitle"]; ?></h1>
                        <p>
                            <?php echo $lang["WarningMsg"]; ?>
                        </p>                        
                        <p class="powered">
                            Powered by<br>
                            <a href="http://wrasa.codage.tech" target="_blank">
                                <img alt="Website is protected by Web Robot Analytics & Security Alarm" src="assets/images/wrasa_logo_w_text_50.png">
                            </a>
                        </p> 
                    </div>
                </div>            
            </div>
        </section>
        <!-- // Section --> 
        
        <!-- Alarm -->
        <audio autoplay loop>
            <source src='assets/sound/alarm.mp3' type='audio/mpeg'>
        </audio> 
        <!-- // Alarm -->

    </body>
</html>
