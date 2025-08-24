<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $pgUserRoleId = "";
    $pgUserPermId = "";
    //$pgUserRolePermAction = "";

    if((isset($_GET["userRoleId"])) && (!empty($_GET["userRoleId"]))) {
        $pgUserRoleId = $_GET['userRoleId'];
    } elseif((isset($_POST["userRoleId"])) && (!empty($_POST["userRoleId"]))) {
        $pgUserRoleId = $_POST['userRoleId'];
    }

    if((isset($_GET["userPermId"])) && (!empty($_GET["userPermId"]))) {
        $pgUserPermId = $_GET['userPermId'];
    } elseif((isset($_POST["userPermId"])) && (!empty($_POST["userPermId"]))) {
        $pgUserPermId = $_POST['userPermId'];
    }

    if(empty($admin)){
        Helper::redirect_to("admin_login.php");
    }else{
        $errors = new Errors();
        $message = new Message();
        $adminUserRolePermission = new Admin_User_Role_Permissions();

        if (Helper::is_post()) {
            if((!empty($pgUserRoleId)) && (!empty($pgUserPermId))) {
                $viewAdminRolePermission = new Admin_User_Role_Permissions();
                $viewAdminRolePermissionArray = (array) $viewAdminRolePermission->where(["role_id" => $pgUserRoleId])->one();

                if((isset($viewAdminRolePermissionArray)) && (!empty($viewAdminRolePermissionArray))) {
                    $delAdminUserRolePermission = new Admin_User_Role_Permissions();                    
                    if($delAdminUserRolePermission->where(["role_id" => $pgUserRoleId])->delete()) {

                        $adminUserRolePermission->role_id = trim($_POST['adminUserName']);
                        $adminUserRolePermission->email = trim($_POST['adminUserEmail']);
                      
                        $errors = $adminUserRolePermission->get_errors();

                        if($errors->is_empty()) {
                            if($errors->is_empty()) {
                                $id = $adminUserRolePermission->save();
                                $has_error_creation = false;

                                Helper::redirect_to("../../admin-user-roles.php?msg=1");
                                exit;
                            }
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
            }
        }
    }
?>