<?php require_once('./private/init.php'); ?>
<?php
	$singleEventSubCategory = array();
    $eventSubCategory = new Event_SubCategory();

    $sort_by = "title";
    $sort_type = "ASC";
    $eventSubCategoryId = "";

	if(Helper::is_post()) {
        if((isset($_POST["eventSubCategoryId"])) && (!empty($_POST["eventSubCategoryId"]))) {
            $eventSubCategoryId = $_POST["eventSubCategoryId"];
        }

		$singleEventSubCategory = (array) $eventSubCategory->where(["id" => $eventSubCategoryId])->one();
	}

    $eventEventSubCategoryImageNameArr = array();
    if((isset($singleEventSubCategory['image_name'])) && (!empty($singleEventSubCategory['image_name']))) {
        $eventEventSubCategoryImageNameArr = explode(",",$singleEventSubCategory['image_name']);
    }

	if(!empty($eventEventSubCategoryImageNameArr)) {
		foreach($eventEventSubCategoryImageNameArr as $singleEventSubCategoryImgVal) {
?>	
		    <div>
                <a href="uploads/event_subcategory/<?php echo $singleEventSubCategoryImgVal; ?>" target="_blank" id="<?php echo $singleEventSubCategoryImgVal; ?>"><?php echo $singleEventSubCategoryImgVal ?></a>
            </div>
<?php
		}
	}
?>
