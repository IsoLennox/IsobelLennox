<?php include("inc/header.php"); ?>
<?php
 

            //ULINK CURRENT IMAGE 
        $query  = "SELECT * FROM projects WHERE id={$_GET['project_id']}";  
        $result = mysqli_query($connection, $query); 
        if($result){
            $array=mysqli_fetch_assoc($result);
            $current_img=$array['image'];
            if(!empty($current_img)){
             unlink($current_img);
            }
            
            
          //CHECK IMAGE
        $target_dir = "img/";
        if (!file_exists($target_dir)) {
             
            //CREATE DIR and FILE 
            mkdir($target_dir, 0777, true);
            require_once("inc/edit_project_img.php"); 
        }else{
            //DIRECTORY EXISTS. UPLOAD IMAGE
            
            require_once("inc/edit_project_img.php"); 

        } 
          
            
           
        }//end check for directory
        
    
?>
 