<?php
/**
 * Created by PhpStorm.
 * User: enon51
 * Date: 2017/06/26
 * Time: 13:39
 *
 */
        function createHeader($title){

            $header = <<< "EOD"
            <!DOCTYPE html>
            <html lang = "en">
            <head>
            <meta charset = "UTF-8">
            <!--↓これは仕方ない-->
            <link href = "/ar2/allget/style/tablestyle.css" rel = "stylesheet">
            <title>{$title}</title>
            </head>
EOD;
            echo $header;
        }


        function createFooter(){
            $footer = <<<"EOD"
                </html>
EOD;

            echo $footer;
        }
