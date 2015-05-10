<?php include("inc/header.php");  ?>
<style>
.red {color:red;}
</style>   
<?php
    echo message();  
    echo form_errors($errors);  

    
//    =========================
//    GET MAIN CONTENT
//    =========================
    


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





//See if submitted main content
if(isset($_GET['submit_content'])){ 
    
    
        
//    =========================
//    UPDATE EDITED CONTENT
//    =========================
    
    
    
    $new_email=$_POST['email'];
    $new_about=$_POST['about'];
    $insert_content = "UPDATE main_content SET email = '{$new_email}', about = '{$new_about}' WHERE id = 5 ";
    $content_result = mysqli_query($connection, $insert_content); 
    if($content_result){ $_SESSION['message']="Main Content Updated!"; redirect_to('index.php'); }else{ $_SESSION['message']="Could not update main content"; redirect_to('index.php'); }
    
    
    
    
    
        
//    =========================
//    EDIT BASIC INFO
//    =========================
    
    
    
    
}elseif(isset($_GET['edit_basic_info'])){ ?>
       
<!--   //EDIT CONTENT -->
           
    <h4>Edit Basic Info <span class="right"> <a title="Show Link Title" href="index.php"><i class="fa fa-home"></i> <span class="small">Done</span>  
</a> </span></h4>

     
      
    <form action="index.php?submit_content" method="post">
        <h3>Email</h3>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>" />  
         
         <h3>About </h3>
        <textarea cols="100" rows="10" name="about" id="about" value="<?php echo $about; ?>" ><?php echo $about; ?></textarea>
         <br/>
        <input type="submit" name="submit" value="Save" />
    </form>
    <hr/>
    <p>Current Image</p>
    <img src="<?php echo $image; ?>" alt="current photo" />
    
<form action="upload_img.php" method="post" enctype="multipart/form-data">
    Select New Image:<br/>
    <input type="file" name="image" id="fileToUpload"><br/>
 
    <input type="submit" value="Upload File" name="submit">
</form>
    
    <br /> 

       
       
     <?   }elseif(isset($_GET['edit_skills'])){ 
    

    
        
//    =========================
//    EDIT SKILLS
//    =========================
    
    
    
    
    ?> <h4>Skills <span class="right"> <a title="Show Link Title" href="index.php?add_skills"><i class="fa fa-home"></i> <span class="small"> Done</span>  </a></span></h4> <?php
    
    //GET SKILLS
    $skill_query  = "SELECT * FROM skills";  
    $skill_result = mysqli_query($connection, $skill_query);
    $skill_num_rows = mysqli_num_rows($skill_result);
    if($skill_num_rows>=1){
        //show each result value
        echo "<ul class='one-third'>";
        foreach($skill_result as $skill_show){
            echo "<li>".$skill_show['name']." <a href='index.php?delete_skill={$skill_show['id']}&name={$skill_show['name']}'><i class=\"right fa fa-trash-o red\"></i></a></li><hr/><br/>"; 
        }
        echo "</ul>";
    }else{ echo "You have no skills!"; }//END GET SKILLS 
    ?>
           <h2>Add Skill</h2>
            <form action="index.php?submit_skill" method="post">
            <h3>Name</h3>
            <input type="text" name="name" id="name" value="" />  <br/>
            <input type="submit" name="submit" value="Save" />
        </form>
        <?php        
    

    
        
//    =========================
//    ADD SKILL
//    =========================
    
    
    
}elseif(isset($_GET['submit_skill'])){ 
    
    $insert_skill = "INSERT INTO skills (name) VALUES ('{$_POST['name']}')";
    $skill_result = mysqli_query($connection, $insert_skill); 
    if($skill_result){ $_SESSION['message']="New skill created!"; redirect_to('index.php?edit_skills'); }else{ $_SESSION['message']="Could not add skill"; redirect_to('index.php?edit_skills'); }
 

    
        
//    =========================
//    DELETE SKILL
//    =========================
    
    
    
    
}elseif(isset($_GET['delete_skill'])){ 
    
    $delete_skill = "DELETE FROM skills WHERE id = {$_GET['delete_skill']}";
    $skill_result = mysqli_query($connection, $delete_skill); 
    if($skill_result){ $_SESSION['message']="Skill: {$_GET['name']} Deleted!"; redirect_to('index.php?edit_skills'); }else{ $_SESSION['message']="Could not add skill"; redirect_to('index.php?edit_skills'); }
 
    

    
        
//    =========================
//    EDIT SINGLE PROJECT
//    =========================
    
    
    
 }elseif(isset($_GET['edit_this_project'])){  ?>
    
    
           
    <h4>Edit Project <span class="right"> <a title="Show Link Title" href="index.php?edit_projects"><i class="fa fa-home"></i> <span class="small">Cancel</span>  
</a> </span></h4>
    <?php
     $project_id=$_GET['edit_this_project'];
     
        $query  = "SELECT * FROM projects WHERE id={$project_id}";  
        $result = mysqli_query($connection, $query);
        $num_rows = mysqli_num_rows($result);
        if($num_rows>=1){
            //show each result value
            foreach($result as $show){     ?>
                
        <form action="index.php?submit_project=<?php echo $project_id; ?>" method="post" enctype="multipart/form-data">

        <h3>Title</h3>
        <input type="text" name="title" id="title" value="<?php echo $show['title']; ?>" placeholder="Arbytes..." />  

        <h3>Subtitle</h3>
        <input type="text" name="subtitle" id="subtitle" value="<?php echo $show['subtitle']; ?>" placeholder="A team collaboration tool..." /> 
        
        <h3>Created For</h3>
        <input type="text" name="createdfor" id="createdfor" value="<?php echo $show['created_for']; ?>" placeholder="Personal Development..." /> 
        
        <h3>URL</h3>
        <input type="text" name="url" id="url" value="<?php echo $show['url']; ?>" placeholder="../AppName or http://..." /> 
        <br/>

        <h3>Skills</h3>
        <?php
          
                                      
    //GET SKILLS
    $skill_query  = "SELECT * FROM skills";  
    $skill_result = mysqli_query($connection, $skill_query);
    $skill_num_rows = mysqli_num_rows($skill_result);
    if($skill_num_rows>=1){
        //show each result value
        
        foreach($skill_result as $skill_show){
            
            $this_skill_query  = "SELECT * FROM skill_project WHERE skill_id={$skill_show['id']} AND project_id={$project_id}";  
            $this_skill_result = mysqli_query($connection, $this_skill_query);
            $this_skill_num_rows = mysqli_num_rows($this_skill_result);
            if($this_skill_num_rows>=1){
                $checked="checked";
            }else{
                $checked="";
            }
            
            //get skills from joint table, if this project has skill, $checked='ckecked'
             echo "<input type=\"checkbox\" name=\"skill[]\" value=\"".$skill_show['id']."\" ".$checked." >".$skill_show['name']."<br/>"; 
        } 
        
    }else{ echo "You have no skills! You can edit this project to add skills later."; }//END GET SKILLS 
         ?>
 
<br/><br/>
        <input type="submit" value="Save Project" name="submit">
    </form>
             <?php    }
        }else{ echo "This Project Does Not Exist!"; }

 
    
    
    
    
//    =========================
//    CHANGE PROJECT IMAGE
//    =========================
    
    
 }elseif(isset($_GET['edit_project_img'])){  ?>
    
 
           
    <h4>Edit Project Image <span class="right"> <a title="Show Link Title" href="index.php?edit_projects"><i class="fa fa-home"></i> <span class="small">Cancel</span>  
</a> </span></h4>
    <?php
     
        $query  = "SELECT * FROM projects WHERE id={$_GET['edit_project_img']}";  
        $result = mysqli_query($connection, $query);
        $num_rows = mysqli_num_rows($result);
        if($num_rows>=1){
            //show each result value
            foreach($result as $show){     ?>
                
        <form action="edit_project.php?project_id=<?php echo $_GET['edit_project_img']; ?>" method="post" enctype="multipart/form-data">
 
        <h3>Current Image</h3>
           <img src="<?php echo $show['image']; ?>" alt="">

        <h3>Replace this image:</h3>
        <p>Images work best when 400x250px</p>
<!--        <p>You must re-upload an image each time you edit this project.</p>-->
        <input type="file" name="image" id="fileToUpload" value=""><br/>
<br/><br/>
        <input type="submit" value="Save Project" name="submit">
    </form>
             <?php    }
        }else{ echo "This Project Does Not Exist!"; }

 
    
    
    
    
//    =========================
//    DELETE PROJECT
//    =========================
    
    
 }elseif(isset($_GET['delete_project'])){
    
    // UNLINK PROJECT IMAGE
    // DELETE ALL FROM SKILL_PROJECT WHERE PROJECT_ID = THIS.ID
    // DELETE PROJECT FROM PROJECTS
    echo "We're sorry -  You're stuck with this forever.";
  
    
    
        
//    =========================
//    ADD NEW PROJECT
//    =========================
    
    
    

           
 }elseif(isset($_GET['add_project'])){ ?>
    
    <!--    GET PROJECTS   -->
              
    <h4>Add Project <span class="right"> <a title="Show Link Title" href="index.php?edit_projects"><i class="fa fa-home"></i> <span class="small"> Cancel</span>  
</a> </span></h4>
        <form action="new_project.php" method="post" enctype="multipart/form-data">

        <h3>Title</h3>
        <input type="text" name="title" id="title" value="" placeholder="Arbytes..." />  

        <h3>Subtitle</h3>
        <input type="text" name="subtitle" id="subtitle" value="" placeholder="A team collaboration tool..." /> 
        
        <h3>Created For</h3>
        <input type="text" name="createdfor" id="createdfor" value="" placeholder="Personal Development..." /> 
        
        <h3>URL</h3>
        <input type="text" name="url" id="url" value="" placeholder="../AppName or http://..." /> 
        <br/>

        <h3>Skills</h3>
        <?php
    //GET SKILLS
    $skill_query  = "SELECT * FROM skills";  
    $skill_result = mysqli_query($connection, $skill_query);
    $skill_num_rows = mysqli_num_rows($skill_result);
    if($skill_num_rows>=1){
        //show each result value
        
        foreach($skill_result as $skill_show){
            echo "<input type='checkbox' name='skill[]' value='{$skill_show['id']}'>".$skill_show['name']."<br/>"; 
        }
        
    }else{ echo "You have no skills! You can edit this project to add skills later."; }//END GET SKILLS 
         ?>

        <h3>Screenshot (Works best when 400x250 px):</h3>
        <input type="file" name="image" id="fileToUpload"><br/>

        <input type="submit" value="Save Project" name="submit">
    </form>
    
    
    <?php  }elseif(isset($_GET['submit_project'])){ 
    
    
        
//    =========================
//    UPDATE EDITED PROJECT
//    =========================
    
     
     
    $new_title=$_POST['title'];
    $new_subtitle=$_POST['subtitle'];
    $new_createdfor=$_POST['createdfor'];
    $new_url=$_POST['url'];
    $skills_array=$_POST['skill'];
    
        //DELETE ALL SKILLS
            $delete_skills  = "DELETE FROM skill_project WHERE project_id={$_GET['submit_project']}";  
            $delete_skills_result = mysqli_query($connection, $delete_skills);
            if($delete_skills_result){
        //INSERT NEW SKILLS
            foreach($skills_array as $skill){
            
            $insert_skill  = "INSERT INTO skill_project (skill_id, project_id) VALUES ({$skill},{$_GET['submit_project']})";  
            $insert_skill_result = mysqli_query($connection, $insert_skill);
                } 
                
            $insert_content = "UPDATE projects SET title = '{$new_title}', subtitle = '{$new_subtitle}', created_for='{$new_createdfor}', url='{$new_url}' WHERE id = {$_GET['submit_project']} ";
            $content_result = mysqli_query($connection, $insert_content); 
            if($content_result){ 
                $_SESSION['message']="Project Updated!"; 
                redirect_to('index.php?edit_projects'); 
            }else{
                $_SESSION['message']="Could not update this project"; 
                redirect_to("index.php?edit_this_project={$_GET['submit_project']}"); 
            }
                
                
            }else{
                echo "Could not delete skills";
            }
         

    
}else{ ?>
    


<!--
    
//    =========================
//    SHOW ALL
//    =========================
    
-->


             
<!--         GET BASIC INFO    -->
    <h4>Basic Info <span class="right"> <a title="Show Link Title" href="index.php?edit_basic_info"><i class="fa fa-pencil"></i> <span class="small">Edit</span>  
</a> </span></h4>
        <img class="left main" src="<?php echo $image; ?>" alt="current image">
         <h3>Email </h3> <p><?php echo $email; ?></p> 
         <h3>About </h3> <p><?php echo $about; ?></p>
         
         
    
<!--    GET ALL SKILLS   -->
    
    <h4>Skills <span class="right"> <a title="Show Link Title" href="index.php?edit_skills"><i class="fa fa-pencil"></i> <span class="small">Edit</span>  </a></span></h4> <?php
    //GET SKILLS
    $skill_query  = "SELECT * FROM skills";  
    $skill_result = mysqli_query($connection, $skill_query);
    $skill_num_rows = mysqli_num_rows($skill_result);
    if($skill_num_rows>=1){
        
        echo "Click skill name to see all projects using this skill";
        //show each result value
        echo "<ul>";
        foreach($skill_result as $skill_show){
            echo "<li><a href\"#\">".$skill_show['name']."</a>"; 
            
            //get number of projects with this skill
                $skill_count  = "SELECT * FROM skill_project WHERE skill_id={$skill_show['id']}";  
                $count_result = mysqli_query($connection, $skill_count);
                if($count_result){
                    $num_rows = mysqli_num_rows($count_result); 
                    $i=1;
                    while( $i<=$num_rows){
                    echo " <i class=\"fa fa-file-code-o\"></i>"; 
                        $i++;
                    }
                }
            echo "</li><br/>";
        }//end foreach skill
        echo "</ul>"; 
        
    }else{ echo "You have no skills!"; }//END GET SKILLS 
 ?>
 
         
<!--    GET PROJECTS   -->
  
           
    <h4>Projects <span class="right"> <a title="Show Link Title" href="index.php?add_project"><i class="fa fa-plus"></i> <span class="small"> New Project</span>  
</a>  </span></h4>
              <?php         

        $query  = "SELECT * FROM projects";  
        $result = mysqli_query($connection, $query);
        $num_rows = mysqli_num_rows($result);
        if($num_rows>=1){
            //show each result value
            foreach($result as $show){
            echo "<div class='projects left'>";
                echo "<a href='index.php?edit_this_project={$show['id']}'><i class=\"fa fa-pencil\"> Edit Content</i></a> | <a href='index.php?edit_project_img={$show['id']}'><i class=\"fa fa-pencil\"> Edit Image</i></a> | <a href='index.php?delete_project'><i class=\"red fa fa-trash-o\"></i></a><br/><br/>";
            echo "<a href='{$show['url']}' title='View Project'><img src='{$show['image']}' alt=\"Project Screenshot\" /></a>";
            
            echo "<h2>".$show['title']."</h2><br/>";
            echo "<strong>Subtitle:</strong> ".$show['subtitle']."<br/>";
            echo "<strong>Created For:</strong> ".$show['created_for']."<br/>";
                
                $skill_query  = "SELECT * FROM skill_project WHERE project_id={$show['id']}";  
                $skill_result = mysqli_query($connection, $skill_query);
                $skill_num_rows = mysqli_num_rows($skill_result);
                if($skill_num_rows>=1){  
                     echo "<strong>Skills:</strong> ";
                foreach($skill_result as $skill_show){
                        $skill_name_query  = "SELECT * FROM skills WHERE id={$skill_show['skill_id']} ";  
                        $skill_name_result = mysqli_query($connection, $skill_name_query); 
                        if($skill_name_result){  
                            $skill_array=mysqli_fetch_assoc($skill_name_result);
                        echo  $skill_array['name'].", "; 
                        }//end print skill name 
                }//end loop through skills if found  
                   
                }//end get skills 
                
                
                
                echo "</div>"; 

            }//end show each project
        }else{ echo "You do not have any projects yet!"; }
           
 
         }//end show all, no edits ?> 
          
<!--
    <h4>Resume <span class="right"> <a title="Show Link Title" href="browse.php"><i class="fa fa-upload"></i> <span class="small">Edit</span>  
</a> </span></h4>
         <p>Link to read-only google doc</p>
-->
           
           <?php

//example query

//    $query  = "SELECT * FROM TABLE";  
//    $result = mysqli_query($connection, $query);
//    if($result){
//        //show each result value
//        foreach($result as $show){
//            
//            $this_value=$show['col_name'];
//            echo $this_value;
//                      
//            }
//        }
 ?>
     
      
        
<?php include("inc/footer.php"); ?>