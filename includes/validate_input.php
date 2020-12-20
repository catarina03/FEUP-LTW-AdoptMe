<?php
    function validInput(){
        foreach($_GET as $get){
            if (!preg_match("/^[0-9a-zA-Z\s]+$/", urldecode($get)))
               return false;
        }

        foreach($_POST as $post){
            if(!preg_match("/^[0-9a-zA-Z\s]+$/", urldecode($post)))
                return false;
        }

        return true;
    }
?>