<?php  
$target_file = $target_dir . basename($_FILES["image"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
       
    } else {
       // echo "File is not an image."; 
        $_SESSION["message"] = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, FILE NAME already exists.";
    $_SESSION["message"] = "Sorry, FILE NAME already exists.";
    redirect_to("index.php");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 5000000) {
    //echo "Sorry, your file is too large.";
    $_SESSION["message"] = "Sorry, your file is too large. 5000kb is the max file size.";
    redirect_to("index.php");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $_SESSION["message"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    redirect_to("index.php");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION["message"] .= "    Your file was not uploaded.";
    redirect_to("index.php");
// if everything is ok, try to upload file
} else {
   
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //FILE UPLOADED! 
        // unmark all as current, then insert current image    // Perform Update

    $reset  = "UPDATE projects SET ";
    $reset .= "image = '{$target_file}' ";
    $reset .= "WHERE id = '{$project_id}' ";
    $result = mysqli_query($connection, $reset);
    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Image Upload SUCCESSFUL!";
      redirect_to("index.php");
    } else {
      // Failure
      $_SESSION["message"] = "Image uploaded. Filepath NOT written.";
        redirect_to("index.php");
    }//end fail or success redirect
        
        
    } else {
        echo "Sorry, there was an error uploading your file.";
        redirect_to("index.php");
    }
}
    

?>