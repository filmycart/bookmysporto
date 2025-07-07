<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewEventType = new Event_Type();
    $viewEventTypeArray = array();

    $delEventTypeMsg = "";
    $pgEventTypeId = "";
    $pgEventTypeAction = "";
    if((isset($_GET["eventTypeId"])) && (!empty($_GET["eventTypeId"]))) {
        $pgEventTypeId = $_GET['eventTypeId'];
    } elseif((isset($_POST["eventTypeId"])) && (!empty($_POST["eventTypeId"]))) {
        $pgEventTypeId = $_POST['eventTypeId'];
    }

    if((isset($_GET["eventTypeAction"])) && (!empty($_GET["eventTypeAction"]))) {
        $pgEventTypeAction = $_GET['eventTypeAction'];
    } elseif((isset($_POST["eventTypeAction"])) && (!empty($_POST["eventTypeAction"]))) {
        $pgEventTypeAction = $_POST['eventTypeAction'];
    }

    if((Helper::is_get()) && (!empty($pgEventTypeId)) && ($pgEventTypeAction == "view")) {
        $viewEventType->id = $pgEventTypeId;
        $viewEventTypeArray = (array) $viewEventType->where(["id" => $viewEventType->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventTypeArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgEventTypeId)) && ($pgEventTypeAction == "edit")) {
        $viewEventType->id = $pgEventTypeId;
        $viewEventTypeArray = (array) $viewEventType->where(["id" => $viewEventType->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventTypeArray);
        exit;
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    }else{
        $errors = new Errors();
        $message = new Message();
        $viewAddEventType = new Event_Type();
        $addEventType = new Event_Type();
        $updEventType = new Event_Type();
        $viewAddEventArray = array();

        if (Helper::is_post()) {
            if((empty($pgEventTypeId)) && ($pgEventTypeAction == "add")) {
                $viewAddEventType = new Event_Type();
                $viewAddEventType->name = trim($_POST['eventTypeName']);
                $viewAddEventTypeArray = (array) $viewAddEventType->where(["name" => $viewAddEventType->name])->one();

                if((isset($viewAddEventTypeArray['id'])) && (!empty($viewAddEventTypeArray['id']))) {
                    Helper::redirect_to("../../event-type.php?msg=4");
                } else {
                    $addEventType->name = trim($_POST['eventTypeName']);
                    $addEventType->status = (isset($_POST['eventTypeStatus'])) ? 1 : 1;
                    $addEventType->admin_id = $admin->id;

                    $errors = $addEventType->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $addEventType->save();
                            $has_error_creation = false;
                            Helper::redirect_to("../../event-type.php?msg=1");
                            exit;
                        }
                    }
                }
            } elseif((!empty($pgEventTypeId)) && ($pgEventTypeAction == "update")) {
                $viewEditEventType = new Event_Type();
                $viewEditEventType->name = trim($_POST['eventTypeName']);
                $viewEditEventType->id = $pgEventTypeId;
                $viewEditEventArray = (array) $viewEditEventType->where(["name" => $viewEditEventType->name])->not(["id" => $viewEditEventType->id])->one();

                if((isset($viewEditEventArray['id'])) && (!empty($viewEditEventArray['id']))) {
                    Helper::redirect_to("../../event-type.php?msg=5");
                    exit;
                } else {
                    $updEventType->id = $pgEventTypeId;
                    $updEventType->name = trim($_POST['eventTypeName']);
                    $updEventType->status = (isset($_POST['eventTypeStatus'])) ? 1 : 1;
                    $updEventType->admin_id = $admin->id;
        
                    $errors = $updEventType->get_errors();

                    if($errors->is_empty()){
                        if($updEventType->where(["id"=>$updEventType->id])->andWhere(["admin_id" => $updEventType->admin_id])->update()){
                            Helper::redirect_to("../../event-type.php?msg=2");
                            exit;
                        }
                    }
                }              
            }
        } elseif((!empty($pgEventTypeId)) && ($pgEventTypeAction == "delete")) {
            $delEventType = new Event_Type();
            
            $delEventType->id = Helper::get_val('eventTypeId');
            $delEventType->admin_id = $admin->id;

            if(!empty($delEventType->id)){
                $delEventTypeDb = new Event_Type();
                $delEventTypeDb = $delEventTypeDb->where(["id" => $delEventType->id])->one();

                if($delEventTypeDb) {
                    if($delEventTypeDb->where(["id" => $delEventTypeDb->id])->delete()) {
                        $delEventTypeMsg = 1;
                        $message->set_message($delEventTypeMsg);
                    }else $errors->add_error("Error Occurred While Deleting");
                } else {
                    $errors->add_error("Invalid Event Type");
                }
            }else  $errors->add_error("Invalid Parameters.");

            Helper::redirect_to("../../event-type.php?msg=3");
            exit;
        }   
    }
?>