<?php require_once('../../admin/private/init.php'); ?>
<?php
	$allCategory = array();
    $category = new Category();
    $catRespStr = "";

    $sort_by = "title";
    $sort_type = "ASC";
    $categoryId = $eventTypeId = "";

	if(Helper::is_post()) {
        if((isset($_POST["categoryId"])) && (!empty($_POST["categoryId"]))) {
            $categoryId = explode(",",$_POST["categoryId"]);
        }

        if((isset($_POST["eventTypeId"])) && (!empty($_POST["eventTypeId"]))) {
            $eventTypeId = $_POST["eventTypeId"];
        }

        $allCategory = (array) $category->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
	}

    $catRespStr .= '<div class="event-cat-parent-div">';

   	if(!empty($allCategory)){
    	foreach($allCategory as $allCategoryVal) {
            $sel_category = "";
            if(!empty($categoryId)) {
                if(in_array($allCategoryVal->id, $categoryId)) {
                    $sel_category = "selected";
                }
            }

            $catRespStr .= '<div class="event-cat-child-div"><button type="button" class="btn btn-block btn-warning btn-sm">'.$allCategoryVal->title.'</button>&nbsp;</div>';

    	}
    }

    $catRespStr .= '</div>';

    echo $catRespStr;
?>
