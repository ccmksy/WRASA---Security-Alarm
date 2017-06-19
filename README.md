**************
What is WRASA?
**************

WRASA is a project of Cloud Design Limited, it is composed of Web Robot Analytics 
and Security Alarm. And its purpose is to analyse the activities of web robots 
(Googlebot, Bingbot...etc.) on your websites, and protect the source code of 
your web-based applications.

If you want to view more details, please go to http://wrasa.codage.tech


**********************
WRASA - Security Alarm
**********************

WRASA – Security Alarm is a kind of web plug-in and 100% free of charge. It works 
like CCTV and Alarm System, that assists in identifying and deterring people who 
attempt to copy or analyse the source code of your web-based applications.


************
Requirements
************

- Linux platform
- PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.


*************
Quick Install
*************

- Step 1 : Extract the wrasa-SecurityAlarm-x.x.zip file.
- Step 2 : Move the wrasa-SecurityAlarm-x.x folder to its intended location. (e.g. http://example.com/assets/)
- Step 3 : Select the page you want to protect, then open and edit like this:

            <!DOCTYPE html>
            <?php require_once "var/www/example.com/assets/wrasa-SecurityAlarm-x.x/api/ProtectPG.php"; ?>
            <html lang="en">
                <head>
                    ...
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function(){
                        $.ajax({
                            url:'http://example.com/assets/wrasa-SecurityAlarm-x.x/protect.js',
                            dataType:'script'
                        });
                    });        
                    </script>
                </head>

- Step 4 : Press F12. If you see the Warning page, that means installed successfully.


*************
Configuration
*************

If you want to change the default setting, please open the core/Config.php and modify yourself.


*********
Attention
*********

- If you want to change the default setting, please open the Config.php and modify yourself.
- If you want to check the collected data, please go to core/data folder.
- DON'T REMOVE core/data/default folder.
- ENSURE the BlockList.json and SuspectList.json can be written.


*********
Changelog
*********

*************
Version 1.0.1
*************

Fixed : Cannot block the IP address that has appeared in BlockList.json
