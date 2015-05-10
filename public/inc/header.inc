<?php require_once('db_connect.inc');

 //GET MAIN CONTENT
 
    $main_query  = "SELECT * FROM main_content";  
    $main_result = mysqli_query($connection, $main_query);
    $main_num_rows = mysqli_num_rows($main_result);
    if($main_num_rows>=1){
        //show each result value
        foreach($main_result as $main_show){
            if(empty($main_show['image'])){
                $image = "img/default.jpg";
                }else{
                $image = $main_show['image'];
                }
            $email = $main_show['email'];
            $about = $main_show['about'];  

        }
    }else{ 
        $image = "img/default.jpg";
        $email = "isolennox@gmail.com";
        $about = "Say something...";  
    } 
?>
<!DOCTYPE html> 
<html>
<!-- ISOBEL LENNOX



         $$\       $$\          $$\                        
        $$  |     $$  |         \$$\                       
       $$  /     $$  /$$\   $$\  \$$\                      
      $$  /     $$  / \$$\ $$  |  \$$\                     
      \$$<     $$  /   \$$$$  /   $$  |                    
       \$$\   $$  /    $$  $$<   $$  /                     
        \$$\ $$  /    $$  /\$$\ $$  /                      
         \__|\__/     \__/  \__|\__/                       
                                                           
      -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Isobel Lennox</title>
    <link rel="stylesheet" href="css/style.css">

    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Nunito:300" rel="stylesheet" type="text/css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
 
<!--        link to font awesome-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


</head>

<body>


    <header>
        <h1>Isobel Lennox</h1>
        <h3><?php echo $email; ?></h3>

        <div class="menu"><span class="hiddenemail"><?php echo $email; ?></span><a href="http://isobellennox.com/#about">About</a> - <a href="http://isobellennox.com/#skills">Skills</a> - <a href="http://isobellennox.com/#projects">Projects</a> 
        </div>


    </header>