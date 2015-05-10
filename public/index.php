<?php 
require_once("inc/db_connect.inc");
require_once("inc/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Isobel Lennox</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="js/jquery-2.1.1.min.js">
</head>
<body>
<header>
    <h1 id="name"><a href="index.php">Isobel Lennox</a></h1>
    
        <nav>
        <ul> 
            <li><a href="index.php?projects"><i class="fa fa-file-code-o"></i> Projects </a></li> 
            <li><a href="http://github.com/isolennox"><i class="fa fa-github"></i> </a></li>
            <li><a href="http://codepen.io/IsoLennox/"><i class="fa fa-codepen"> </i> </a></li>
            <li><a href="http://lennoxfiles.wordpress.com"><i class="fa fa-wordpress"></i> </a></li>
        </ul>
    </nav>   
</header>

<div id="page">

      <?php

    if(isset($_POST['skills'])){
    
        $skill_id=$_POST['skills'];
        
                //GET SKILLS
        $skill_query  = "SELECT * FROM skills";  
        $skill_result = mysqli_query($connection, $skill_query);
        $skill_num_rows = mysqli_num_rows($skill_result);
        if($skill_num_rows>=1){ ?>
          <form method="POST" >
           <select name="skills" id="skills" onChange="this.form.submit()">
            <option value="">All Projects</option>
         <?php   
            foreach($skill_result as $skill_show){
                if($skill_show['id']==$skill_id){
                    $selected="selected";
                }else{ 
                    $selected="";
                }
                echo "<option ".$selected." value=\"".$skill_show['id']."\">".$skill_show['name']."  "; 
                } 
            echo "</select></form>"; } 
        
        
         if(empty($skill_id)){ 
             
             
                $all_projects=all_projects();
                echo $all_projects;

                             
                             
                             }else{
        
             echo "<h1>"; 
      //get number of projects with this skill
        $skill_count  = "SELECT * FROM skill_project WHERE skill_id={$skill_id}";  
        $count_result = mysqli_query($connection, $skill_count);
        foreach($count_result as $projects){
            
             $project_count  = "SELECT * FROM projects WHERE id={$projects['project_id']} AND published=1";  
            $pcount_result = mysqli_query($connection, $project_count);
            if($pcount_result){
                $num_rows = mysqli_num_rows($pcount_result); 
                $i=1;
                while( $i<=$num_rows){
                echo " <i class=\"fa fa-file-code-o\"></i>"; 
                    $i++;
                }
            }
        }
    echo " </h1>"; 
        
        
       
            
//     GET ALL PROJECTS WITH THIS SKILL 
                                     
            $skill_proj  = "SELECT * FROM skill_project WHERE skill_id={$skill_id}";  
            $skills_result = mysqli_query($connection, $skill_proj);
                if($skills_result){
                    $array=mysqli_fetch_assoc($skills_result);
                    foreach($skills_result as $project){
                 ?>
                 
          <div class="projects_container">
            <?php
            $query  = "SELECT * FROM projects WHERE id={$project['project_id']} AND published=1 ORDER BY id DESC";  
            $result = mysqli_query($connection, $query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows>=1){
                //show each result value
                foreach($result as $show){
                echo "<div class='projects'>";    
                    if(empty($show['image'])){
                    echo "<a target='_blank' href='".$show['url']."' title='View Project'><img src='admin/default_project.png' alt=\"Project Screenshot\" /></a>";
                    }else{
                echo "<a target='_blank' href='".$show['url']."' title='View {$show['title']}'><img src='admin/{$show['image']}' alt=\"Project Screenshot\" /></a>";
                    }
                echo "<h3>".$show['title']."</h3> ";
                echo "<p>".$show['subtitle']."</p> ";
                echo "<p>".$show['created_for']."</p> "; 
                $skill_query  = "SELECT * FROM skill_project WHERE project_id={$show['id']}";  
                $skill_result = mysqli_query($connection, $skill_query);
                $skill_num_rows = mysqli_num_rows($skill_result);
                if($skill_num_rows>=1){  
                     echo "<p><strong>Skills:</strong> ";
                foreach($skill_result as $skill_show){
                        $skill_name_query  = "SELECT * FROM skills WHERE id={$skill_show['skill_id']} ";  
                        $skill_name_result = mysqli_query($connection, $skill_name_query); 
                        if($skill_name_result){  
                            $skill_array=mysqli_fetch_assoc($skill_name_result);
                        echo  $skill_array['name'].", "; 
                        }//end print skill name 
                    
                }//end loop through skills if found  
                    echo "</p>";
                   
                }//end get skills 
                    
                    
                echo "<a href=\"".$show['url']."\" >View this Project</a>";

                echo "</div> ";

                    echo "<hr/>";
                }//end show each project
            } ?>

                
       
        </div>
        <?php
                    }

                    
                    
                }
    }
            
    }elseif(isset($_GET['projects'])){
     echo "<h1>";
        //GET SKILLS
        $skill_query  = "SELECT * FROM skills";  
        $skill_result = mysqli_query($connection, $skill_query);
        $skill_num_rows = mysqli_num_rows($skill_result);
        if($skill_num_rows>=1){ ?>
          <form method="POST" >
           <select name="skills" id="skills" onChange="this.form.submit()">
            <option value="">All Projects</option>
         <?php   
            foreach($skill_result as $skill_show){
                echo "<option value=\"".$skill_show['id']."\">".$skill_show['name']."  "; 
                } 
            echo "</select></form>"; } 


 

      //get number of projects with this skill
        $skill_count  = "SELECT * FROM projects WHERE published=1";  
        $count_result = mysqli_query($connection, $skill_count);
        if($count_result){
            $num_rows = mysqli_num_rows($count_result); 
            $i=1;
            while( $i<=$num_rows){
            echo " <i class=\"fa fa-file-code-o\"></i>"; 
                $i++;
            }
        }
    echo " </h1>";
   
        $all_projects=all_projects();
        echo $all_projects;

}else{
    
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
            $about = nl2br($main_show['about']); 

        }
    }else{ 
        $image = "img/default.jpg";
        $email = "isolennox@gmail.com";
        $about = "Say something...";  
    }
    
    ?>


<!--         GET BASIC INFO    -->
  
        <img src="<?php echo $image; ?>" alt="current image">
         <h3>Email </h3> <p><?php echo $email; ?></p> 
         <h3>About </h3> <p><?php echo $about; ?></p>


 <?php } ?>
   
    </div>
</body>
</html>