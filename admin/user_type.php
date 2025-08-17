<?php require_once('./private/init.php'); ?>
<?php
	$allUserType = array();
    $usertype = new User_Type();

    $sort_by = "name";
    $sort_type = "ASC";

    $userTypeId = "";    
    $userTypeSel = "";
	if(Helper::is_post() && isset($_POST["userTypeId"])){
		$userTypeId = $_POST["userTypeId"];
		$allUserType = (array) $usertype->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="userType" name="userType" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <option value="">Select User Type</option>
    <?php
    	if(!empty($allUserType)) {
    		foreach($allUserType as $allUserTypeVal){
                if(!empty($userTypeId)) {
                    if($userTypeId == $allUserTypeVal->id) {
                        $userTypeSel = "selected";
                    } else {
                        $userTypeSel = "";
                    }
                }
    ?>	
				<option value="<?php echo $allUserTypeVal->id; ?>" <?php echo $userTypeSel; ?> ><?php echo $allUserTypeVal->name; ?>
                </option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
    $("#userType").change(function() {
        var userTypeId = $("#userType").val();
        userTypeFieldsFunc(userTypeId);
    });    
</script>