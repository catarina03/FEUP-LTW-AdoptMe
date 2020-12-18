<?php
    function validInput(){
        foreach($_GET as $get){
            /* echo '1 --- ' . urldecode($get);?><br><?php */

            if (!preg_match("/^[0-9a-zA-Z\s]+$/", urldecode($get)))
               return false;
        }

        foreach($_POST as $post){
            echo urldecode($post);
            if(!preg_match("/^[0-9a-zA-Z\s]+$/", urldecode($post)))
                return false;
        }

        return true;
    }
?>