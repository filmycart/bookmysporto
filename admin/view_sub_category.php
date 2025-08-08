<?php 
    require_once('./private/init.php'); 
	
    $viewSubCategory = $subCategoryIdArray = array();
    $subCategory = new Event_SubCategory();

    $subCategoryId = $viewCat = "";

	if(Helper::is_post()) {
        if((isset($_POST["subCategoryId"])) && (!empty($_POST["subCategoryId"]))) {
            $subCategoryIdArray = explode(",",$_POST["subCategoryId"]);
        }

        if(!empty($subCategoryIdArray)){
            $subCategoryId = "'".implode("','",$subCategoryIdArray)."'";
        }

        $viewSubCategory = (array) $subCategory->whereIn(["id" => $subCategoryId])->all();
	}

    $viewSubCategoryTitleArray = array();
	if(!empty($viewSubCategory)){
		foreach($viewSubCategory as $viewSubCategoryVal) {
            $viewSubCategoryTitleArray[] = $viewSubCategoryVal->title;
		}
	}    

    $viewSubCategoryTitleStr = "";
    if(!empty($viewSubCategoryTitleArray)){
        $viewSubCategoryTitleStr = implode(",",$viewSubCategoryTitleArray);
    }

    echo $viewSubCategoryTitleStr;
