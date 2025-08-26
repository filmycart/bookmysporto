<?php require_once('./private/init.php'); ?>
<?php
	$allAdminUserPermission = $allAdminUserRolePermission = array();

    $adminUserPermission = new Admin_User_Permission();
    $adminUserRolePermission = new Admin_User_Role_Permissions();

    $sort_by = "name";
    $sort_type = "ASC";
    $userRoleId = "";

	if(Helper::is_post()) {
        if((isset($_POST["userRoleId"])) && (!empty($_POST["userRoleId"]))) {
            $userRoleId = $_POST["userRoleId"];
        }

        $allAdminUserRolePermission = (array) $adminUserRolePermission->where(["role_id" => $userRoleId])->all();
	}

    $allAdminUserPermission = (array) $adminUserPermission->orderBy($sort_by)->orderType($sort_type)->where(["status" => 1])->all();

    $checkedPermArray = array();
    if(!empty($allAdminUserRolePermission)) {
        foreach($allAdminUserRolePermission as $allAdminUserRolePermVal) {
            $checkedPermArray[] = $allAdminUserRolePermVal->permission_id;
        }
    }
?>
<div style="border:0px solid red;width:100%;float:left;">
    <?php    
        if(!empty($allAdminUserPermission)){
            foreach($allAdminUserPermission as $allAdminUserPermissionVal) {
                $check_permission = "";
                if(!empty($userRoleId)) {
                    if(in_array($allAdminUserPermissionVal->id,$checkedPermArray)) {
                        $check_permission = "checked";
                    }
                }
    ?>  
                <div style="border:0px solid red;width:20%;float:left;">
                    <input type="checkbox" id="userRolePermission[]" name="userRolePermission[]" value="<?php echo $allAdminUserPermissionVal->id; ?>" <?php echo $check_permission; ?>>&nbsp;<?php echo $allAdminUserPermissionVal->name; ?>
                </div>    
    <?php
            }
        }
    ?>
</div>    
<div style="border:0px solid red;width:100%;float:left;">&nbsp;</div>