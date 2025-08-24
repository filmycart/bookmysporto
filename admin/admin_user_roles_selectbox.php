<?php require_once('./private/init.php'); ?>
<?php
	$allAdminUserRole = array();
    $adminUserRole = new Admin_User_Roles();

    $sort_by = "name";
    $sort_type = "ASC";
    $userRoleId = "";

	if(Helper::is_post()) {
        if((isset($_POST["userRoleId"])) && (!empty($_POST["userRoleId"]))) {
            $userRoleId = $_POST["userRoleId"];
        }

        $allAdminUserRole = (array) $adminUserRole->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="adminUserRole" name="adminUserRole" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <option value="">Select User Role</option>
    <?php
        if(!empty($allAdminUserRole)){
            foreach($allAdminUserRole as $allAdminUserRoleVal) {
                $sel_role = "";
                if(!empty($userRoleId)) {
                    if($allAdminUserRoleVal->id == $userRoleId) {
                        $sel_role = "selected";
                    }
                }
    ?>  
                <option value="<?php echo $allAdminUserRoleVal->id; ?>" <?php echo $sel_role; ?>><?php echo $allAdminUserRoleVal->name; ?></option>
    <?php
            }
        }
    ?>
</select>