<?php require_once('./private/init.php'); ?>
<?php
	$singleEvent = array();
    $eventCategory = new Category();

    $sort_by = "title";
    $sort_type = "ASC";
    $eventTypeId = "";

	if(Helper::is_post()) {
        $eventCategoryId = "";
        if((isset($_POST["eventCategoryId"])) && (!empty($_POST["eventCategoryId"]))) {
            $eventCategoryId = $_POST["eventCategoryId"];
        }

		$singleEventCategory = (array) $eventCategory->where(["id" => $eventCategoryId])->one();
	}

    $eventImageNameArr = array();
    if((isset($singleEventCategory['image_name'])) && (!empty($singleEventCategory['image_name']))) {
        $eventImageNameArr = explode(",",$singleEventCategory['image_name']);
    }

	if(!empty($eventImageNameArr)) {
		foreach($eventImageNameArr as $singleEventImgVal) {
?>	
		    <div><a href ="uploads/event_category/<?php echo $singleEventImgVal ?>" target="_blank" id="<?php echo $singleEventImgVal; ?>"><?php echo $singleEventImgVal ?></a></div>
<?php
		}
	}
?>
