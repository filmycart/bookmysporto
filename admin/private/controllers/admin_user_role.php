<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $viewUserRole = new Admin_User_Roles();
    $viewUserRoleArray = array();

    $delUserRoleMsg = "";
    $pgUserRoleId = "";
    $pgUserRoleAction = "";
    if((isset($_GET["userRoleId"])) && (!empty($_GET["userRoleId"]))) {
        $pgUserRoleId = $_GET['userRoleId'];
    } elseif((isset($_POST["userRoleId"])) && (!empty($_POST["userRoleId"]))) {
        $pgUserRoleId = $_POST['userRoleId'];
    }

    if((isset($_GET["userRoleAction"])) && (!empty($_GET["userRoleAction"]))) {
        $pgUserRoleAction = $_GET['userRoleAction'];
    } elseif((isset($_POST["userRoleAction"])) && (!empty($_POST["userRoleAction"]))) {
        $pgUserRoleAction = $_POST['userRoleAction'];
    }

    if((Helper::is_get()) && (!empty($pgUserRoleId)) && ($pgUserRoleAction == "view")) {
        $viewUserRole->id = $pgUserRoleId;
        $viewUserRoleArray = (array) $viewUserRole->where(["id" => $viewUserRole->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewUserRoleArray);
        exit;
    } else if((Helper::is_get()) && (!empty($pgUserRoleId)) && ($pgUserRoleAction == "edit")) {
        $viewUserRole->id = $pgUserRoleId;
        $viewUserRoleArray = (array) $viewUserRole->where(["id" => $viewUserRole->id])->andwhere(["admin_id" => $admin->id])->one();
        echo json_encode($viewUserRoleArray);
        exit;
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    }else{
        $errors = new Errors();
        $message = new Message();
        $adminRole = new Admin_User_Roles();

        if (Helper::is_post()) {
            if((empty($pgUserRoleId)) && ($pgUserRoleAction == "add")) {
                $viewAdminRole = new Admin_User_Roles();
                $viewAdminRole->name = trim($_POST['userRoleName']);
                $viewAdminRoleArray = (array) $viewAdminRole->where(["name" => $viewAdminRole->name])->one();

                if((isset($viewAdminRoleArray['id'])) && (!empty($viewAdminRoleArray['id']))) {
                    Helper::redirect_to("../../admin-user-roles.php?msg=4");
                } else {
                    $adminRole->name = trim($_POST['userRoleName']);
                    $adminRole->status = (isset($_POST['userRoleStatus'])) ? 1 : 1;
                    $adminRole->admin_id = $admin->id;

                    $errors = $adminRole->get_errors();

                    if($errors->is_empty()) {
                        if($errors->is_empty()) {
                            $id = $adminRole->save();
                            $has_error_creation = false;

                            Helper::redirect_to("../../admin-user-roles.php?msg=1");
                            exit;
                        }
                    }
                }

                if(!$message->is_empty()){
                    Session::set_session($message);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-roles.php");
                }else if(!$errors->is_empty()){
                    Session::set_session($errors);
                    Helper::redirect_to("../../".ADMIN_FOLER_NAME."/admin-user-roles.php");
                }
            } elseif((!empty($pgUserRoleId)) && ($pgUserRoleAction == "update")) {
                $viewAdminRole = new Admin_User_Roles();
                $viewAdminRole->name = trim($_POST['userRoleName']);
                $viewAdminRole->id = $pgUserRoleId;
                $viewAdminRoleArray = (array) $viewAdminRole->where(["name" => $viewAdminRole->name])->not(["id" => $viewAdminRole->id])->one();

                if((isset($viewAdminRoleArray['id'])) && (!empty($viewAdminRoleArray['id']))) {
                    Helper::redirect_to("../../admin-user-roles.php?msg=5");
                    exit;
                } else {
                    $adminRole->id = $pgUserRoleId;
                    $adminRole->name = trim($_POST['userRoleName']);
                    $adminRole->status = (isset($_POST['status'])) ? 1 : 1;
                    $adminRole->admin_id = $admin->id;

                    $errors = $adminRole->get_errors();
                    if($errors->is_empty()){
                        if($adminRole->where(["id"=>$adminRole->id])->andWhere(["admin_id" => $admin->id])->update()){
                            Helper::redirect_to("../../admin-user-roles.php?msg=2");
                            exit;
                        }
                    }
                }
            }
        } elseif((!empty($pgUserRoleId)) && ($pgUserRoleAction == "delete")) {
            $adminRole->id = $pgUserRoleId;
            $adminRole->admin_id = $admin->id;

            if(!empty($adminRole->id)) {
                $usr_role_from_db = new Admin_User_Roles();
                $usr_role_from_db = $usr_role_from_db->where(["id" => $adminRole->id])->andWhere(["admin_id" => $adminRole->admin_id])->one();
                
                if($usr_role_from_db) {
                    if($usr_role_from_db->where(["id" => $usr_role_from_db->id])->delete()) {
                        $delUsrRoleMsg = 1;
                        $message->set_message($delUsrRoleMsg);
                    }else $errors->add_error("Error Occurred While Deleting");
                } else {
                    $errors->add_error("Invalid User Role");
                }

            }else  $errors->add_error("Invalid Parameters.");

            Helper::redirect_to("../../admin-user-roles.php?msg=3");
            exit;
        }
    }
?>