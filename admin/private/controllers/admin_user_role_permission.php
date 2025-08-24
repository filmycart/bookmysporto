<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewUserPermission = new Admin_User_Permission();
    $viewUserPermissionArray = array();

    $delUserPermissionMsg = "";
    $pgUserPermissionId = "";
    $pgUserPermissionAction = "";
    if((isset($_GET["userPermissionId"])) && (!empty($_GET["userPermissionId"]))) {
        $pgUserPermissionId = $_GET['userPermissionId'];
    } elseif((isset($_POST["userPermissionId"])) && (!empty($_POST["userPermissionId"]))) {
        $pgUserPermissionId = $_POST['userPermissionId'];
    }

    if((isset($_GET["userPermissionAction"])) && (!empty($_GET["userPermissionAction"]))) {
        $pgUserPermissionAction = $_GET['userPermissionAction'];
    } elseif((isset($_POST["userPermissionAction"])) && (!empty($_POST["userPermissionAction"]))) {
        $pgUserPermissionAction = $_POST['userPermissionAction'];
    }

    if((Helper::is_get()) && (!empty($pgUserPermissionId)) && ($pgUserPermissionAction == "view")) {
        $viewUserPermission->id = $pgUserPermissionId;
        $viewUserPermissionArray = (array) $viewUserPermission->where(["id" => $viewUserPermission->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewUserPermissionArray);
        exit;
    } else if((Helper::is_get()) && (!empty($pgUserPermissionId)) && ($pgUserPermissionAction == "edit")) {
        $viewUserPermission->id = $pgUserPermissionId;
        $viewUserPermissionArray = (array) $viewUserPermission->where(["id" => $viewUserPermission->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewUserPermissionArray);
        exit;
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    }else{
        $errors = new Errors();
        $message = new Message();
        $adminPermission = new Admin_User_Permission();

        if (Helper::is_post()) {
            if((empty($pgUserPermissionId)) && ($pgUserPermissionAction == "add")) {

                $viewAdminPermission = new Admin_User_Permission();
                $viewAdminPermission->name = trim($_POST['userPermissionName']);
                $viewAdminPermissionArray = (array) $viewAdminPermission->where(["name" => $viewAdminPermission->name])->one();

                if((isset($viewAdminPermissionArray['id'])) && (!empty($viewAdminPermissionArray['id']))) {
                    Helper::redirect_to("../../admin-user-permission.php?msg=4");
                } else {
                    $adminPermission->name = trim($_POST['userPermissionName']);
                    $adminPermission->status = (isset($_POST['userPermissionStatus'])) ? 1 : 1;
                    $adminPermission->admin_id = $admin->id;

                    $errors = $adminPermission->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $adminPermission->save();
                            $has_error_creation = false;

                            Helper::redirect_to("../../admin-user-permission.php?msg=1");
                            exit;
                        }
                    }
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-permission.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-permission.php");
                }
            } elseif((!empty($pgUserPermissionId)) && ($pgUserPermissionAction == "update")) {
                $viewAdminPermission = new Admin_User_Roles();
                $viewAdminPermission->name = trim($_POST['userPermissionName']);
                $viewAdminPermission->id = $pgUserPermissionId;
                $viewAdminRoleArray = (array) $viewAdminPermission->where(["name" => $viewAdminPermission->name])->not(["id" => $viewAdminPermission->id])->one();

                if((isset($viewAdminRoleArray['id'])) && (!empty($viewAdminRoleArray['id']))) {
                    Helper::redirect_to("../../admin-user-permission.php?msg=5");
                    exit;
                } else {
                    $adminPermission->id = $pgUserPermissionId;
                    $adminPermission->name = trim($_POST['userPermissionName']);
                    $adminPermission->status = (isset($_POST['userPermissionStatus'])) ? 1 : 1;
                    $adminPermission->admin_id = $admin->id;

                    $errors = $adminPermission->get_errors();
                    if($errors->is_empty()){
                        if($adminPermission->where(["id"=>$adminPermission->id])->andWhere(["admin_id" => $admin->id])->update()){
                            Helper::redirect_to("../../admin-user-permission.php?msg=2");
                            exit;
                        }
                    }
                }
            }
        } elseif((!empty($pgUserPermissionId)) && ($pgUserPermissionAction == "delete")) {
            $adminPermission->id = $pgUserPermissionId;
            $adminPermission->admin_id = $admin->id;

            if(!empty($adminPermission->id)) {
                $usr_permission_from_db = new Admin_User_Permission();
                $usr_permission_from_db = $usr_permission_from_db->where(["id" => $adminPermission->id])->andWhere(["admin_id" => $adminPermission->admin_id])->one();

                if($usr_permission_from_db) {
                    if($usr_permission_from_db->where(["id" => $usr_permission_from_db->id])->delete()) {
                        $delUsrPermissionMsg = 1;
                        $message->set_message($delUsrPermissionMsg);
                    }else $errors->add_error("Error Occurred While Deleting");
                } else {
                    $errors->add_error("Invalid User Role");
                }

            }else  $errors->add_error("Invalid Parameters.");

            Helper::redirect_to("../../admin-user-permission.php?msg=3");
            exit;
        }
    }
?>