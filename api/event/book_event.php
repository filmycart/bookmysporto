<?php require_once('../../admin/private/init.php'); ?>

<?php
    $response = new Response();
    $errors = new Errors();

    if((Helper::is_post())){

        print"<pre>";
        print_r($_POST);
        exit;

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                $booking = new Bookings();

                $event->title = trim($_POST['eventTitle']);
                $event->description = trim($_POST['eventDescription']);                    
                $event->venue = trim($_POST['venue']);
                $event->start_date = trim($_POST['eventStartDate']);
                $event->end_date = trim($_POST['eventEndDate']);
                $event->status = (isset($_POST['status'])) ? 1 : 1;
                $event->admin_id = $admin->id;
                $event->type_id = ((isset($_POST['eventType'])) && (!empty($_POST['eventType'])))?$_POST['eventType']:'';
                $event->category_id = ((isset($_POST['eventCategoryHidden'])) && (!empty($_POST['eventCategoryHidden'])))?$_POST['eventCategoryHidden']:'';
                $event->category_type_id = ((isset($_POST['eventCategoryType'])) && (!empty($_POST['eventCategoryType'])))?$_POST['eventCategoryType']:'';
                $event->sub_category_id = ((isset($_POST['eventSubCategoryHidden'])) && (!empty($_POST['eventSubCategoryHidden'])))?$_POST['eventSubCategoryHidden']:'';
                $event->image_name = $_POST['eventFileHidden'];


                /*$viewEvent = new Event();
                $viewEvent->title = trim($_POST['eventTitle']);
                $viewEventArray = (array) $viewEvent->where(["title" => $viewEvent->title])->one();*/

                /*if((isset($viewEventArray['id'])) && (!empty($viewEventArray['id']))) {
                    Helper::redirect_to("../../events.php?msg=4");
                } else {*/
                    $event->title = trim($_POST['eventTitle']);
                    $event->description = trim($_POST['eventDescription']);                    
                    $event->venue = trim($_POST['venue']);
                    $event->start_date = trim($_POST['eventStartDate']);
                    $event->end_date = trim($_POST['eventEndDate']);
                    $event->status = (isset($_POST['status'])) ? 1 : 1;
                    $event->admin_id = $admin->id;
                    $event->type_id = ((isset($_POST['eventType'])) && (!empty($_POST['eventType'])))?$_POST['eventType']:'';
                    $event->category_id = ((isset($_POST['eventCategoryHidden'])) && (!empty($_POST['eventCategoryHidden'])))?$_POST['eventCategoryHidden']:'';
                    $event->category_type_id = ((isset($_POST['eventCategoryType'])) && (!empty($_POST['eventCategoryType'])))?$_POST['eventCategoryType']:'';
                    $event->sub_category_id = ((isset($_POST['eventSubCategoryHidden'])) && (!empty($_POST['eventSubCategoryHidden'])))?$_POST['eventSubCategoryHidden']:'';
                    $event->image_name = $_POST['eventFileHidden'];

                    /*$eventSubCategoryStr = "";
                   
                    //$event->sub_category_id = $_POST['eventSubCategory'];

                    $errors = $event->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $event->save();
                            $has_error_creation = false;

                            Helper::redirect_to("../../index.php?pg-name=my-booking");
                            exit;
                        }
                    }*/
                //}


                
                
                    
                if (!empty($eventDetail)) {
                    $response->create(200, "Success.", $eventDetail);
                } else {
                    $response->create(200, "No Item Found.", []);
                }

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>