<?php 
    require_once('../../admin/private/init.php'); 

    $response = new Response();
    $errors = new Errors();

    $pgUserImgAction = "";
    $pgUserImgName = "";

    $requestScheme = "";
    if((isset($_SERVER['REQUEST_SCHEME'])) && (!empty($_SERVER['REQUEST_SCHEME']))) {
        $requestScheme = $_SERVER['REQUEST_SCHEME'];    
    }

    $hostName = "";
    if((isset($_SERVER['HTTP_HOST'])) && (!empty($_SERVER['HTTP_HOST']))) {
        $hostName = $_SERVER['HTTP_HOST'];  
    }

    //Upload Location
    $upload_location = "";
    if($hostName == "localhost") {
        $upload_location = "/var/www/html/bookmysporto/admin/uploads/users/";
    } else {
        $upload_location = "/var/www/html/bookmysporto.com/public_html/admin/uploads/users/";
    }

    if((isset($_POST["userImgAction"])) && (!empty($_POST["userImgAction"]))) {
        $pgUserImgAction = $_POST['userImgAction'];
    } elseif((isset($_GET["userImgAction"])) && (!empty($_GET["userImgAction"]))) {
        $pgUserImgAction = $_GET['userImgAction'];
    }

    if((isset($_POST["userName"])) && (!empty($_POST["userName"]))) {
        $pgUserImgName = $_POST['userName'];
    } elseif((isset($_GET["userName"])) && (!empty($_GET["userName"]))) {
        $pgUserImgName = $_GET['userName'];
    }

    if(Helper::is_post()) {
        $api_token = Helper::post_val("api_token");
        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                if((Helper::is_post()) && ($pgUserImgAction == "upload")) {
                    //Count total files
                    $countfiles = count($_FILES['files']['name']);
                    $newfile = "";

                    //To store uploaded files path
                    $filesArray = $errorArray = array();

                    $userName = "";
                    if((isset($_POST['userName'])) && (!empty($_POST['userName']))) {
                        $userName = strtolower($_POST['userName']);
                    }

                    //Loop all files
                    for($index = 0;$index < $countfiles;$index++) {
                         if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
                               //FileName
                               $filename = $_FILES['files']['name'][$index];

                               //GetExtension
                               $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                               //Valid Image Extension
                               $valid_ext = array("png","jpeg","jpg");
                               //$newfile = $eventTitle."_".rand().".".$ext; 
                               $newfile = date('dmyhis')."-".rand().".".$ext; 
                               //Check Extension
                               if(!in_array($ext, $valid_ext)) {
                                    $errorArray['userImageInvalid'] = "Error: Invalid file format upload only files with format png, jpeg ,jpg.";
                                    echo json_encode($errorArray);
                                    die;
                               } elseif(in_array($ext, $valid_ext)) {
                                    //File Path
                                    $path = $upload_location.$filename;

                                    if(!file_exists($upload_location.$newfile)) {
                                        //Upload File
                                        if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $upload_location.$newfile)) {
                                            $errorArray['userImage'][] = $newfile;
                                        }
                                        chmod($upload_location.$newfile, 0777);
                                    }
                               }
                         }
                    }

                    echo json_encode($errorArray);
                    die;
                }       
            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();

?>
