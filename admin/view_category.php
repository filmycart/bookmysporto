<?php 
    require_once('./private/init.php'); 
	
    $viewCategory = array();
    $category = new Category();

    $categoryId = $viewCat = "";

	if(Helper::is_post()) {
        if((isset($_POST["categoryId"])) && (!empty($_POST["categoryId"]))) {
            $categoryIdArray = explode(",",$_POST["categoryId"]);
        }

        if(!empty($categoryIdArray)){
            $categoryId = "'".implode("','",$categoryIdArray)."'";
        }

        $viewCategory = (array) $category->whereIn(["id" => $categoryId])->all();
	}

    $viewCategoryTitleArray = array();
	if(!empty($viewCategory)){
		foreach($viewCategory as $viewCategoryVal) {
            $viewCategoryTitleArray[] = $viewCategoryVal->title;
		}
	}    

    $viewCategoryTitleStr = "";
    if(!empty($viewCategoryTitleArray)){
        $viewCategoryTitleStr = implode(",",$viewCategoryTitleArray);
    }

    echo $viewCategoryTitleStr;
