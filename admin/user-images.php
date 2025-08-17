<?php require_once('./private/init.php'); ?>
<?php
	$singleUser = array();
    $user = new User();

    $sort_by = "title";
    $sort_type = "ASC";
    $userId = "";

	if(Helper::is_post()) {
        if((isset($_POST["userId"])) && (!empty($_POST["userId"]))) {
            $userId = $_POST["userId"];
        }

		$singleUser = (array) $user->where(["id" => $userId])->one();
	}

    $userImageNameArr = array();
    if((isset($singleUser['image'])) && (!empty($singleUser['image']))) {
        $userImageNameArr = explode(",",$singleUser['image']);
    }

	if(!empty($userImageNameArr)) {
		foreach($userImageNameArr as $singleUserImgVal) {
?>	
		    <div>
                <a href="uploads/users/<?php echo $singleUserImgVal; ?>" target="_blank" id="<?php echo $singleUserImgVal; ?>"><?php echo $singleUserImgVal ?>
                </a>
            </div>
<?php
		}
	}
?>
