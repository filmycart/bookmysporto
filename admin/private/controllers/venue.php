<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $delVenuMsg = "";
    $pgVenuId = "";
    $pgVenueAction = "";

    if((isset($_GET["venueId"])) && (!empty($_GET["venueId"]))) {
        $pgVenuId = $_GET['venueId'];
    } elseif((isset($_POST["venueId"])) && (!empty($_POST["venueId"]))) {
        $pgVenuId = $_POST['venueId'];
    }

    if((isset($_GET["venueAction"])) && (!empty($_GET["venueAction"]))) {
        $pgVenueAction = $_GET['venueAction'];
    } elseif((isset($_POST["venueAction"])) && (!empty($_POST["venueAction"]))) {
        $pgVenueAction = $_POST['venueAction'];
    }

    $pgVenueFileName = "";
    if((isset($_POST["venueFileName"])) && (!empty($_POST["venueFileName"]))) {
        $pgVenueFileName = $_POST['venueFileName'];
    }

    $editVenue = new Venue();
    $viewVenue = new Venue();
    $editVenuArray = array();
    if((Helper::is_get()) && (!empty($pgVenuId)) && ($pgVenueAction == "edit")) {
        $editVenue->id = $pgVenuId;
        $editVenuArray = (array) $editVenue->where(["id" => $pgVenuId])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($editVenuArray);
        exit;
    }

    if((Helper::is_get()) && (!empty($pgVenuId)) && ($pgVenueAction == "view")) {
        $column = "";
        $column = "venue.id AS venueId, venue.title AS venueTitle, venue.description AS venueDescription, venue.address AS venuAddress, venue.owner AS venuOwner, venue.image AS venuImage, venue.state AS venueState, venue.city AS venueCity, venue.country AS venueCountry, venue.status AS venueStatus, venue.admin_id AS venueAdminId, ";
        $column .= "countries.id AS countryId, countries.shortname AS countryShortName, countries.name AS countryName, countries.phonecode AS countryPhoneCode, ";
        $column .= "state.id AS stateId, state.name AS stateName, state.country_id AS stateCountryId, ";
        $column .= "city.id AS cityId, city.name AS cityName, city.state_id AS cityCountryId ";

        $joinColumn['join_table_name1'] = "venue";
        $joinColumn['join_table_name2'] = "countries";
        $joinColumn['join_table_name3'] = "state";
        $joinColumn['join_table_name4'] = "city";

        $joinColumn['join_column_name1'] = "country";
        $joinColumn['join_column_name2'] = "state";
        $joinColumn['join_column_name3'] = "city";
        $joinColumn['join_column_city_state_country_id'] = "id";

        $idStr = $joinColumn['join_table_name1'].".".$joinColumn['join_column_city_state_country_id'];

        $viewVenue->id = $pgVenuId;
        $editVenuArray = (array) $viewVenue->where([$idStr => $viewVenue->id])->oneLeftJoin($column, $joinColumn);

        echo json_encode($editVenuArray);
        exit;
    }

    if((Helper::is_post()) && ($pgVenueAction == "deleteVenueImg")) {
        
        $errorArrayDel = array();

        //Upload Location
        $upload_location = "../../uploads/venue/";

        if(file_exists($upload_location.$pgEventFileName)) {
            //Delete Uploaded File Delete
            unlink($upload_location.$pgEventFileName);
        } else {
            $errorArrayDel['noFile'] = "Error: File does not exist.";
        }    

        echo json_encode($errorArrayDel);
        die; 
    }

    if((Helper::is_post()) && ($pgVenueAction == "upload")) {
        //Count total files
        $countfiles = count($_FILES['files']['name']);

        //Upload Location
        $upload_location = "../../uploads/venues/";
        $newfile = "";

        //To store uploaded files path
        $filesArray = $errorArray = array();

        $eventTitle = "";
        if((isset($_POST['venueTitle'])) && (!empty($_POST['venueTitle']))) {
            $eventTitle = strtolower($_POST['venueTitle']);
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
                        $errorArray['venueImageInvalid'] = "Error: Invalid file format upload only files with format png, jpeg ,jpg.";
                        echo json_encode($errorArray);
                        die;
                   } elseif(in_array($ext, $valid_ext)) {
                        //File Path
                        $path = $upload_location.$filename;

                        if(!file_exists($upload_location.$newfile)) {
                            //Upload File
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $upload_location.$newfile)) {
                                $errorArray['venueImage'][] = $newfile;
                            } else {
                                $errorArray['venueImageUploadDup'] = "Error: Image already exist.";
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
    } else {
        $errors = new Errors();
        $message = new Message();
        $venue = new Venue();

        if (Helper::is_post()) {
            if((empty($pgVenuId)) && ($pgVenueAction == "create")) {

                $viewVenue = new Venue();
                $viewVenue->title = trim($_POST['venueTitle']);
                $viewVenuArray = (array) $viewVenue->where(["title" => $viewVenue->title])->one();

                if((isset($viewVenuArray['id'])) && (!empty($viewVenuArray['id']))) {
                    Helper::redirect_to("../../venue.php?msg=4");
                } else {
                    $venue->title = trim($_POST['venueTitle']);
                    $venue->description = $_POST['venueDescription'];                    
                    $venue->address = trim($_POST['venueAddress']);
                    $venue->owner = trim($_POST['venueOwner']);
                    $venue->image = trim($_POST['venueFileHidden']);
                    $venue->state = $_POST['state'];
                    $venue->city = $_POST['city'];
                    $venue->country = $_POST['venueCountry'];
                    $venue->status = (isset($_POST['status'])) ? 1 : 1;
                    $venue->admin_id = $admin->id;

                    $errors = $venue->get_errors();

                    if($errors->is_empty()) {
                        /*if(!empty($_FILES["image_name"]["name"])){
                            $upload = new Upload($_FILES["image_name"]);
                            $upload->set_max_size(MAX_IMAGE_SIZE);
                            if($upload->upload()) {
                                $event->image_name = $upload->get_file_name();
                                $event->image_resolution = $upload->resolution;
                            }
                            $errors = $upload->get_errors();
                        }*/

                        if($errors->is_empty()) {
                            $id = $venue->save();
                            $has_error_creation = false;
                            /*$uploaded_image_names = Helper::post_val("uploaded-image-names");
                                if($uploaded_image_names){
                                    $image_names = explode(",", $uploaded_image_names);
                                    if(empty(trim($image_names[count($image_names)-1]))) array_splice($image_names, count($image_names)-1, 1);

                                    foreach ($image_names as $item){
                                        $item_images = new Item_Image();
                                        $resolution = Upload::get_image_resolution($item);
                                        $item_images->resolution = $resolution[0] . ":" . $resolution[1];
                                        $item_images->image_name = $item;
                                        $item_images->admin_id = $admin->id;
                                        $item_images->item_id = $id;

                                        $event_id = $item_images->save();

                                        if(!$event_id) {
                                            $has_error_creation = true;
                                            $errors->add_error($item_images->image_name . " failed to upload.");
                                        }
                                    }
                                }

                                if(!$has_error_creation) $message->set_message("Event Created Successfully");
                            }*/

                            //if(!$has_error_creation) $message->set_message("Event Created Successfully");
                            Helper::redirect_to("../../venue.php?msg=1");
                            exit;
                        }
                    }
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../venue.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../venue-form.php");
                }
            } elseif((!empty($pgVenuId)) && ($pgVenueAction == "update")) {

                $viewVenue = new Venue();
                $viewVenue->title = trim($_POST['venueTitle']);
                $viewVenue->id = $pgVenuId;
                $viewVenuArray = (array) $viewVenue->where(["title" => $viewVenue->title])->not(["id" => $viewVenue->id])->one();

                if((isset($viewVenuArray['id'])) && (!empty($viewVenuArray['id']))) {
                    Helper::redirect_to("../../venue.php?msg=5");
                    exit;
                } else {
                        $venue->id = $pgVenuId;
                        $venue->title = trim($_POST['venueTitle']);
                        $venue->description = $_POST['venueDescription'];
                        $venue->address = trim($_POST['venueAddress']);
                        $venue->owner = trim($_POST['venueOwner']);
                        $venue->image = trim($_POST['venueFileHidden']);
                        $venue->state = $_POST['state'];
                        $venue->city = $_POST['city'];
                        $venue->country = $_POST['venueCountry'];
                        $venue->status = (isset($_POST['venueStatus'])) ? $_POST['venueStatus'] : 1;
                        $venue->admin_id = $admin->id;
                        //$event->validate_except(["id", "image_resolution", "sell", "group_by"]);
                        $errors = $venue->get_errors();
                        //$event->validate_except(["image_name", "image_resolution", "sell", "group_by"]);

                        if($errors->is_empty()) {
                            if($venue->where(["id"=>$venue->id])->andWhere(["admin_id" => $venue->admin_id])->update()) {
                                Helper::redirect_to("../../venue.php?msg=2");
                                exit;
                                /*if(!empty($_FILES["image_name"]["name"])){
                                    $upload = new Upload($_FILES["image_name"]);
                                    $upload->set_max_size(MAX_IMAGE_SIZE);
                                    if($upload->upload()){
                                        $upload->delete($event->image_name);
                                        $event->image_name = $upload->get_file_name();
                                        $event->image_resolution = $upload->resolution;
                                    }
                                    $errors = $upload->get_errors();
                                }

                                if($errors->is_empty()){
                                    if($event->where(["id"=>$event->id])->andWhere(["admin_id" => $event->admin_id])->update()){

                                        $has_error_updating = false;
                                        $removed_image_ids = Helper::post_val("removed-image-ids");

                                        if($removed_image_ids){
                                            $removed_id_arr = $image_names = explode(",", $removed_image_ids);
                                            if(empty(trim($removed_id_arr[count($removed_id_arr)-1]))) array_splice($removed_id_arr, count($removed_id_arr)-1, 1);

                                            foreach ($removed_id_arr as $item){
                                                $item_images = new Item_Image();
                                                if(!$item_images->where(["id"=>$item])->delete()) {
                                                    $has_error_updating = true;
                                                    $errors->add_error($item . " failed to delete.");
                                                }
                                            }
                                        }

                                        $uploaded_image_names = Helper::post_val("uploaded-image-names");

                                        if($uploaded_image_names){
                                            $image_names = explode(",", $uploaded_image_names);
                                            if(empty(trim($image_names[count($image_names)-1]))) array_splice($image_names, count($image_names)-1, 1);

                                            foreach ($image_names as $item){
                                                $item_images = new Item_Image();

                                                $resolution = Upload::get_image_resolution($item);
                                                $item_images->resolution = $resolution[0] . ":" . $resolution[1];

                                                $item_images->image_name = $item;
                                                $item_images->admin_id = $admin->id;
                                                $item_images->item_id = $product->id;

                                                if(!$item_images->save()) {
                                                    $has_error_updating = true;
                                                    $errors->add_error($item_images->image_name . " failed to upload.");
                                                }
                                            }
                                        }

                                        if(!$has_error_updating) $message->set_message("Product Updated Successfully");
                                    }
                                }*/
                            }
                        }
                    }

                    /*if(!$message->is_empty()){
                        Session::set_session($message);
                        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/event.php");
                    }else if(!$errors->is_empty()){
                        Session::set_session($errors);
                        Helper::redirect_to("../../".ADMIN_FOLER_NAME."/event-form.php?id=" . $product->id);
                    }*/

                    /*Helper::redirect_to("../../venue.php?msg=2");
                    exit;*/
            } 
        } elseif((!empty($pgVenuId)) && ($pgVenueAction == "delete")) {
            $venue->id = $pgVenuId;
            $venue->admin_id = $admin->id;
            //if(!empty($venue->admin_id) && !empty($venue->id)) {
            
            if(!empty($venue->id)) {
                //if($admin->id == $event->admin_id) {
                    $venue_from_db = new Venue();
                    $venue_from_db = $venue_from_db->where(["id" => $venue->id])->one();

                    if($venue_from_db) {
                        //$image = $venue_from_db->image_name;

                        //if($event->where(["id" => $event->id])->andWhere(["admin_id" => $event->admin_id])->delete()) {
                        if($venue->where(["id" => $venue->id])->delete()) {

                            /*Upload::delete($image);

                            $image_from_db = new Item_Image();
                            $image_from_db = $image_from_db->where(["item_id"=>$event->id])->all();
                            if(count($image_from_db) > 0){
                                foreach($image_from_db as $item){
                                    $item_image_name = $item->image_name;
                                    $item_image = new Item_Image();
                                    if($item_image->where(["id" => $item->id])->andWhere(["admin_id" => $event->admin_id])->delete()){
                                        Upload::delete($item_image_name);
                                    }
                                }
                            }

                            $inventory = new Inventory();
                            $inventory = $inventory->where(["product"=>$event->id])->delete();*/
                            $delVenueMsg = 1;
                            $message->set_message($delVenueMsg);
                            Helper::redirect_to("../../venue.php?msg=3");
                            exit;
                        }else $errors->add_error("Error Occurred While Deleting");
                    } else {
                        $errors->add_error("Invalid Venue");
                    }
                //}else $errors->add_error("You re only allowed to delete your own data.");
            }else  $errors->add_error("Invalid Parameters.");

            /*if(!$message->is_empty()) Session::set_session($message);
            else Session::set_session($errors);*/

 
           /* if(!$message->is_empty()) {
                Session::set_session($message);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/events.php");
            }else if(!$errors->is_empty()) {
                Session::set_session($errors);
                Helper::redirect_to("../../".ADMIN_FOLER_NAME."/event-form.php");
            }*/
            Helper::redirect_to("../../venue.php?msg=3");
            exit;

            //Helper::redirect_to("../../".ADMIN_FOLER_NAME."/events.php?delmsg=".$message->message);
        }
    }
?>