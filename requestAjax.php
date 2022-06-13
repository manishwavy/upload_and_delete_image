<?php

include('../connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function uploadImage($image,$UploadingPath){
  $tmp_path = $image['tmp_name'];
  $filename = md5(time());
  $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
  $name= $UploadingPath.$filename.".".$ext;
  if(move_uploaded_file( $tmp_path,$name)){
    return $name;
  }
}
function UnlinkFile($path){
   unlink($path);
}


if($_POST['action'] == 'addSetting'){

    $description =$_POST['description'];
    $usa_address =$_POST['usa_address'];
    $india_address =$_POST['india_address'];
    $contact =$_POST['contact'];
    $copyright =$_POST['copyright'];
    $fb_link =$_POST['fb_link'];
    $tw_link =$_POST['tw_link'];
    $insta_link=$_POST['insta_link'];
    $youtube_link=$_POST['youtube_link'];
    $linkedin_link=$_POST['linkedin_link'];
    $header_logo=$_FILES['header_logo'];
    $footer_logo=$_FILES['footer_logo'];
    $path='../images/siteSetting/';
    $header=uploadImage($header_logo,$path);
    sleep(1);
    $footer=uploadImage($footer_logo,$path);
    $sql = "INSERT INTO site_settings(`description`,`usa_address`,`india_address`,`contact`,`copyright`,`fb_link`,`tw_link`,`insta_link`,`header_logo`,`footer_logo`,`youtube_link`,`linkedin_link`) VALUES ('$description', '$usa_address', '$india_address','$contact','$copyright','$fb_link','$tw_link','$insta_link','$header','$footer','$youtube_link','$linkedin_link')";
    $result = $conn->query($sql);
  
    if($result)
    {
      $_SESSION['msg'] = 'Data updated successfully.';
    }
    else{
      $_SESSION['error'] = 'ERROR: could not insert data';
    }
    header('Location:site-setting.php');

    
}

if($_POST['action'] == 'updateSetting'){
  $id=$_POST['s_id'];
  $description =$_POST['description'];
  $usa_address =$_POST['usa_address'];
  $india_address =$_POST['india_address'];
  $contact =$_POST['contact'];
  $copyright =$_POST['copyright'];
  $fb_link =$_POST['fb_link'];
  $tw_link =$_POST['tw_link'];
  $insta_link=$_POST['insta_link'];
  $youtube_link=$_POST['youtube_link'];
  $linkedin_link=$_POST['linkedin_link'];
  $path='../images/siteSetting/';
  if($_FILES['header_logo']['name'] != ''){
    $header_logo=$_FILES['header_logo'];
    UnlinkFile($_POST['old_header']);
    $header=uploadImage($header_logo,$path);
    sleep(1);
  }
  else{
      $header=$_POST['old_header'];
  }

  if($_FILES['footer_logo']['name'] != ''){
    $footer_logo=$_FILES['footer_logo'];
    UnlinkFile($_POST['old_header']);
    $footer=uploadImage($footer_logo,$path);
    
  }
  else{
     $footer=$_POST['old_footer'];
  }
  $sql="UPDATE site_settings SET `description` = '".$description."', `usa_address` = '".$usa_address."',`india_address`='".$india_address."',`contact`='".$contact."',`copyright` = '".$copyright."',`fb_link` = '".$fb_link."',`tw_link` = '".$tw_link."',`insta_link` = '".$insta_link."',`header_logo` = '".$header."',`footer_logo` = '".$footer."',`youtube_link`='".$youtube_link."',`linkedin_link`='".$linkedin_link."' WHERE id = '".$id."' ";
  $result = $conn->query($sql);
  
  if($result)
  {
    $_SESSION['msg'] = 'Data updated successfully.';
  }
  else{
    $_SESSION['error'] = 'ERROR: could not insert data';
  }
  header('Location:site-setting.php');
}





?>