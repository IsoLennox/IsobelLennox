<?php include("inc/header.php"); ?>
<?php
 
$title = $_POST['title'];
$subtitle= $_POST['subtitle'];
$for= $_POST['createdfor'];
$url= $_POST['url'];
$skills_array= $_POST['skill'];

    //INSERT ALL DATA EXCEPT IMAGE
$insert  = "INSERT INTO projects ( title, subtitle, created_for, url ) VALUES ( '{$title}', '{$subtitle}', '{$for}', '{$url}' ) ";
$insert_result = mysqli_query($connection, $insert);
if($insert_result){
    
    //GET ID OF PROJECT
    $id_query  = "SELECT * FROM projects WHERE title= '{$title}' ORDER BY id DESC LIMIT 1 ";
    $id_query_result = mysqli_query($connection, $id_query);
    if($id_query_result){
        $result_array=mysqli_fetch_assoc($id_query_result);
        $project_id=$result_array['id'];
    
    //EXPLODE SKILLS ARRAY: FOREACH, INSERT INTO SKILLS_PROJECT TABLE    
    for ($i = 0; $i < count($skills_array); $i++) { 
//        mysqli_query("INSERT INTO skill_project (skill_id, project_id) VALUES ('$skills_array[$i]', '$project_id')");
         $insert_skill_query  = "INSERT INTO skill_project (skill_id, project_id) VALUES ('{$skills_array[$i]}', '{$project_id}')";
        $insert_skill_query_result = mysqli_query($connection, $insert_skill_query);
    } 
    

          //CHECK IMAGE
        $target_dir = "img/";
        if (!file_exists($target_dir)) {

            //CREATE DIR and FILE 
            mkdir($target_dir, 0777, true);
            require_once("inc/upload_project_img.php"); 
        }else{

            //DIRECTORY EXISTS. UPLOAD IMAGE
            require_once("inc/upload_project_img.php"); 
        }//end check for directory
        
    }else{
        $_SESSION["message"] = "Project Inserted. Could not get project ID";
        redirect_to("index.php");
    }

}else{
    $_SESSION["message"] = "Could not create project: {$title}: {$subtitle}: {$for}: {$url}";
    redirect_to("index.php?add_project");
}
?>
 