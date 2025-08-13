<?php require_once('../../admin/private/init.php'); ?>
<?php
    $allSubCategory = array();
    $subCategory = new Event_SubCategory();

    $sort_by = "title";
    $sort_type = "ASC";
    $subCategoryId = "";

    if(Helper::is_post()) {
        if((isset($_POST["categoryId"])) && (!empty($_POST["categoryId"]))) {
            $categoryId = explode(",",$_POST["categoryId"]);
        }

        $allSubCategory = (array) $subCategory->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
    }

    /*print"<pre>";
    print_r($allSubCategory);
    exit;*/
?>
<?php
    $subCatArray = array();
    if(!empty($allSubCategory)){
        foreach($allSubCategory as $key=>$allSubCategoryVal) {
            $subCatArray[$key]['id'] = $allSubCategoryVal->id;
            $subCatArray[$key]['title'] = $allSubCategoryVal->title;
            $subCatArray[$key]['category_id'] = $allSubCategoryVal->category_id;            
            $subCatArray[$key]['image_name'] = $allSubCategoryVal->image_name;
            $subCatArray[$key]['price'] = $allSubCategoryVal->price;
        }
    }

    /*print"<pre>";
    print_r($catArray);
    exit;*/

    echo json_encode($subCatArray);
    exit;
?>