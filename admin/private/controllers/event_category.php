<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewEventCategory = new Category();
    $viewEventCategoryArray = array();

    $delEventTypeMsg = "";
    $pgEventCategoryId = "";
    $pgEventCategoryAction = "";
    if((isset($_GET["eventCategoryId"])) && (!empty($_GET["eventCategoryId"]))) {
        $pgEventCategoryId = $_GET['eventCategoryId'];
    } elseif((isset($_POST["eventCategoryId"])) && (!empty($_POST["eventCategoryId"]))) {
        $pgEventCategoryId = $_POST['eventCategoryId'];
    }

    if((isset($_GET["eventCategoryAction"])) && (!empty($_GET["eventCategoryAction"]))) {
        $pgEventCategoryAction = $_GET['eventCategoryAction'];
    } elseif((isset($_POST["eventCategoryAction"])) && (!empty($_POST["eventCategoryAction"]))) {
        $pgEventCategoryAction = $_POST['eventCategoryAction'];
    }

    if((Helper::is_get()) && (!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "view")){
        $viewEventCategory->id = $pgEventCategoryId;
        $viewEventCategoryArray = (array) $viewEventCategory->where(["id" => $viewEventCategory->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventCategoryArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "edit")){
        $viewEventCategory->id = $pgEventCategoryId;
        $viewEventCategoryArray = (array) $viewEventCategory->where(["id" => $viewEventCategory->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewEventCategoryArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "delete")){
        $delEventCategory = new Category();        
        $delEventCategory->id = Helper::get_val('eventCategoryId');
        $delEventCategory->admin_id = $admin->id;

        if(!empty($delEventCategory->id)){
            $delEventCategoryDb = new Category();
            $delEventCategoryDb = $delEventCategoryDb->where(["id" => $delEventCategory->id])->one();

            if($delEventCategoryDb){
                if($delEventCategoryDb->where(["id" => $delEventCategoryDb->id])->delete()){
                    $delEventCategoryMsg = 1;
                }else $errors->add_error("Error Occurred While Deleting");
            } else {
                $errors->add_error("Invalid Event Category");
            }
        }else  $errors->add_error("Invalid Parameters.");

        Helper::redirect_to("../../event-category.php?msg=3");
        exit;
    } 

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    } else {
        $errors = new Errors();
        $message = new Message();
        $viewAddEventCategory = new Category();
        $addEventCategory = new Category();
        $updEventCategory = new Category();

        if (Helper::is_post()) {
            if((empty($pgEventCategoryId)) && ($pgEventCategoryAction == "add")) {
                $viewAddEventCategory = new Category();
                $viewAddEventCategory->title = trim($_POST['eventCategoryTitle']);
                $viewAddEventCategoryArray = (array) $viewAddEventCategory->where(["title" => $viewAddEventCategory->title])->one();

                if((isset($viewAddEventCategoryArray['id'])) && (!empty($viewAddEventCategoryArray['id']))) {
                    Helper::redirect_to("../../event-category.php?msg=4");
                } else {
                    $addEventCategory->title = trim($_POST['eventCategoryTitle']);
                    $addEventCategory->status = (isset($_POST['eventCategoryStatus'])) ? 1 : 1;
                    $addEventCategory->admin_id = $admin->id;

                    $errors = $addEventCategory->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $addEventCategory->save();
                            $has_error_creation = false;
                            Helper::redirect_to("../../event-category.php?msg=1");
                            exit;
                        }
                    }
                }
            } elseif((!empty($pgEventCategoryId)) && ($pgEventCategoryAction == "update")) {
                $viewEditEventCategory = new Category();
                $viewEditEventCategory->title = trim($_POST['eventCategoryTitle']);
                $viewEditEventCategory->id = $pgEventCategoryId;
                $viewEditEventCategoryArray = (array) $viewEditEventCategory->where(["title" => $viewEditEventCategory->name])->not(["id" => $viewEditEventCategory->id])->one();

                if((isset($viewEditEventCategoryArray['id'])) && (!empty($viewEditEventCategoryArray['id']))) {
                    Helper::redirect_to("../../event-category.php?msg=5");
                    exit;
                } else {
                    $updEventCategory->id = $pgEventCategoryId;
                    $updEventCategory->title = trim($_POST['eventCategoryTitle']);
                    $updEventCategory->status = (isset($_POST['eventCategoryStatus'])) ? 1 : 1;
                    $updEventCategory->admin_id = $admin->id;
        
                    $errors = $updEventCategory->get_errors();

                    if($errors->is_empty()){
                        if($updEventCategory->where(["id"=>$updEventCategory->id])->andWhere(["admin_id" => $updEventCategory->admin_id])->update()){
                            Helper::redirect_to("../../event-category.php?msg=2");
                            exit;
                        }
                    }
                }              
            }
        }
    }
?>