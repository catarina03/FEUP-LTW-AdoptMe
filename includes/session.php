<?php
  session_set_cookie_params(0,'/','www.fe.up.pt',true,true);
  session_start();

  if(!isset($_SESSION['token']))
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
  
?>