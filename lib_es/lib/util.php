<?php
function es($data){
    if(is_array($data)){
        return array_map(__METHOD__,$data);

    }else{
        return htmlspecialchars($data, ENT_QUOTES,"UTF-8");

    }

}