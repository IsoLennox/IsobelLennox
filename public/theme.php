<?php require_once("inc/session.php"); 

        if($_SESSION['theme']==1){  
            $_SESSION['theme']=2;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            
        }else{ 
            $_SESSION['theme']=1;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
?>
