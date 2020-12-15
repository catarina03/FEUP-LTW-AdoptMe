<?php
    function validInput(){
        foreach($_GET as $get){
            if (!preg_match("/^[0-9a-zA-Z\s]+$/", $get))
               return false;
        }

        foreach($_POST as $post){
            if(!preg_match("/^[0-9a-zA-Z\s]+$/", $post))
                return false;
        }

        return true;
    }
?>