<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewBooking = new Bookings();
    $viewBookingArray = array();

    $delBookingMsg = "";
    $pgbookingId = "";
    $pgbookingAction = "";
    if((isset($_GET["bookingId"])) && (!empty($_GET["bookingId"]))) {
        $pgbookingId = $_GET['bookingId'];
    } elseif((isset($_POST["bookingId"])) && (!empty($_POST["bookingId"]))) {
        $pgbookingId = $_POST['bookingId'];
    } 

    if((isset($_GET["bookingAction"])) && (!empty($_GET["bookingAction"]))) {
        $pgbookingAction = $_GET['bookingAction'];
    } elseif((isset($_POST["bookingAction"])) && (!empty($_POST["bookingAction"]))) {
        $pgbookingAction = $_POST['bookingAction'];
    }

    $pgbookingFileName = "";
    if((isset($_POST["bookingFileName"])) && (!empty($_POST["bookingFileName"]))) {
        $pgbookingFileName = $_POST['bookingFileName'];
    }    

    $viewBookingArray = array();
    if((Helper::is_get()) && (!empty($pgbookingId)) && ($pgbookingAction == "edit")) {
        $viewBooking->id = $pgbookingId;
        $viewBookingArray = (array) $viewBooking->where(["id" => $viewBooking->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewBookingArray);
        exit;
    } else if((Helper::is_get()) && (!empty($pgbookingId)) && ($pgbookingAction == "booking")) {
        $viewBooking->id = $pgbookingId;
        $viewBookingArray = (array) $viewBooking->where(["id" => $viewBooking->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewBookingArray);
        exit;
    }

    if((Helper::is_post()) && ($pgbookingAction == "deleteBookingImg")) {
        
        $errorArrayDel = array();

        //Upload Location
        $upload_location = "../../uploads/bookings/";

        if(file_exists($upload_location.$pgbookingFileName)) {
            //Delete Uploaded File Delete
            unlink($upload_location.$pgbookingFileName);
        } else {
            $errorArrayDel['noFile'] = "Error: File does not exist.";
        }    

        echo json_encode($errorArrayDel);
        die; 
    }

    if((Helper::is_post()) && ($pgbookingAction == "upload")) {
        //Count total files
        $countfiles = count($_FILES['files']['name']);

        //Upload Location
        $upload_location = "../../uploads/bookings/";
        $newfile = "";

        //To store uploaded files path
        $filesArray = $errorArray = array();

        $eventTitle = "";
        if((isset($_POST['eventTitle'])) && (!empty($_POST['eventTitle']))) {
            $eventTitle = strtolower($_POST['eventTitle']);
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
                   $newfile = rand().".".$ext; 
                   //Check Extension
                   if(!in_array($ext, $valid_ext)) {
                        $errorArray['eventImageInvalid'] = "Error: Invalid file format upload only files with format png, jpeg ,jpg.";
                        echo json_encode($errorArray);
                        die;
                   } elseif(in_array($ext, $valid_ext)) {
                        //File Path
                        $path = $upload_location.$filename;

                        if(!file_exists($upload_location.$newfile)) {
                            //Upload File
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $upload_location.$newfile)) {
                                $errorArray['eventImage'][] = $newfile;
                            } else {
                                $errorArray['eventImageUploadDup'] = "Error: Image already exist.";
                            }
                        }
                   }
             }
        }

        echo json_encode($errorArray);
        die;
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    }else{
        $errors = new Errors();
        $message = new Message();
        $event = new Event();

        if (Helper::is_post()) {
            if((empty($pgbookingId)) && ($pgbookingAction == "add")) {
                $viewBooking = new Event();
                $viewBooking->title = trim($_POST['eventTitle']);
                $viewBookingArray = (array) $viewBooking->where(["title" => $viewBooking->title])->one();

                if((isset($viewBookingArray['id'])) && (!empty($viewBookingArray['id']))) {
                    Helper::redirect_to("../../events.php?msg=4");
                } else {
                    $event->title = trim($_POST['eventTitle']);
                    $event->state_id = $_POST['state'];
                    $event->city_id = $_POST['city'];
                    $event->country_id = $_POST['eventCountry'];
                    $event->address = trim($_POST['eventVenue']);
                    $event->start_date = trim($_POST['eventStartDate']);
                    $event->end_date = trim($_POST['eventEndDate']);
                    $event->status = (isset($_POST['status'])) ? 1 : 1;
                    $event->admin_id = $admin->id;
                    $event->type_id = ((isset($_POST['eventType'])) && (!empty($_POST['eventType'])))?$_POST['eventType']:'';
                    $event->category_id = ((isset($_POST['eventCategoryHidden'])) && (!empty($_POST['eventCategoryHidden'])))?implode(",",$_POST['eventCategory']):'';
                    $event->category_type_id = ((isset($_POST['eventCategoryType'])) && (!empty($_POST['eventCategoryType'])))?$_POST['eventCategoryType']:'';
                    $event->image_name = $_POST['eventFileHidden'];

                    $eventSubCategoryStr = "";

                    $event->sub_category_id = $_POST['eventSubCategory'];
                    $errors = $event->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $event->save();
                            $has_error_creation = false;
                            Helper::redirect_to("../../events.php?msg=1");
                            exit;
                        }
                    }
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/events.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/event-form.php");
                }
            } elseif((!empty($pgbookingId)) && ($pgbookingAction == "update")) {

                $viewBooking = new Event();
                $viewBooking->title = trim($_POST['eventTitle']);
                $viewBooking->id = $pgbookingId;
                $viewBookingArray = (array) $viewBooking->where(["title" => $viewBooking->title])->not(["id" => $viewBooking->id])->one();

                if((isset($viewBookingArray['id'])) && (!empty($viewBookingArray['id']))) {
                    Helper::redirect_to("../../events.php?msg=5");
                    exit;
                } else {
                    $event->id = $pgbookingId;
                    $event->title = trim($_POST['eventTitle']);
                    $event->state_id = $_POST['state'];
                    $event->city_id = $_POST['city'];
                    $event->country_id = $_POST['eventCountry'];
                    $event->address = trim($_POST['eventVenue']);
                    $event->start_date = trim($_POST['eventStartDate']);
                    $event->end_date = trim($_POST['eventEndDate']);
                    $event->status = (isset($_POST['status'])) ? 1 : 1;
                    $event->admin_id = $admin->id;
                    $event->type_id = ((isset($_POST['eventType'])) && (!empty($_POST['eventType'])))?$_POST['eventType']:'';
                    $event->category_id = ((isset($_POST['eventCategoryHidden'])) && (!empty($_POST['eventCategoryHidden'])))?implode(",",$_POST['eventCategory']):'';
                    $event->category_type_id = ((isset($_POST['eventCategoryType'])) && (!empty($_POST['eventCategoryType'])))?$_POST['eventCategoryType']:'';
                    $event->sub_category_id = ((isset($_POST['eventSubCategory'])) && (!empty($_POST['eventSubCategory'])))?$_POST['eventSubCategory']:'';
                    $event->image_name = $_POST['eventFileHidden'];

                    $errors = $event->get_errors();

                    if($errors->is_empty()){
                        if($event->where(["id"=>$event->id])->andWhere(["admin_id" => $event->admin_id])->update()){
                            Helper::redirect_to("../../events.php?msg=2");
                            exit;
                        }
                    }
                }
            } 
        } elseif((!empty($pgbookingId)) && ($pgbookingAction == "delete")) {
            $event->id = Helper::get_val('bookingId');
            $event->admin_id = Helper::get_val('admin_id');

            //if(!empty($event->admin_id) && !empty($event->id)) {
            if(!empty($event->id)) {
                //if($admin->id == $event->admin_id) {
                    $event_from_db = new Event();
                    $event_from_db = $event_from_db->where(["id" => $event->id])->one();

                    if($event_from_db) {
                        $image = $event_from_db->image_name;
                        if($event->where(["id" => $event->id])->delete()) {
                            $delBookingMsg = 1;
                            $message->set_message($delBookingMsg);
                        }else $errors->add_error("Error Occurred While Deleting");
                    } else {
                        $errors->add_error("Invalid Event");
                    }
                //}else $errors->add_error("You re only allowed to delete your own data.");
            }else  $errors->add_error("Invalid Parameters.");
            Helper::redirect_to("../../events.php?msg=3");
            exit;
        }
    }

?>