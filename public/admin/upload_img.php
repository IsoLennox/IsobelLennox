<?php include("inc/header.php"); ?>
<?php
 

        //GET CURRENT IMG AND DELETE IT So that img name doesnt exist if user should try to upload it again in future
        //No Gallery in this website, just one user image.
 

    //REMOVE FROM DIR
$remove  = "SELECT * FROM main_content ";
$remove .= "WHERE id = 5 ";
$remove_result = mysqli_query($connection, $remove);
if($remove_result){

    $user_array=mysqli_fetch_assoc($remove_result);
    $image=$user_array['image'];

    if(empty($image)){

          //CHECK IMAGE
        $target_dir = "img/";
        if (!file_exists($target_dir)) {

            //CREATE DIR and FILE 
            mkdir($target_dir, 0777, true);
            require_once("inc/upload_img.php"); 
        }else{

            //DIRECTORY EXISTS. UPLOAD IMAGE
            require_once("inc/upload_img.php"); 
        }//end check for directory

    }else{

        //UNLINK IMAGE FROM DIR
        unlink($image);

        //REMOVE FROM DB
        $reset  = "UPDATE main_content SET ";
        $reset .= "image = '' ";
        $reset .= "WHERE id = 5 ";
        $result = mysqli_query($connection, $reset);

        if ($result && mysqli_affected_rows($connection) == 1) {

              //CHECK IMAGE
            $target_dir = "img/";
            if (!file_exists($target_dir)) {

                //CREATE DIR and FILE 
                mkdir($target_dir, 0777, true);
                require_once("inc/upload_img.php"); 

            }else{

                //DIRECTORY EXISTS. UPLOAD IMAGE
                require_once("inc/upload_img.php"); 
            }//end check for directory

        } else{
            // Failure
            $_SESSION["message"] = "Could not remove old image";
            redirect_to("index.php");
        }
    }    
}else{
    $_SESSION["message"] = "Could not find user";
    redirect_to("index.php");
}
?>
 