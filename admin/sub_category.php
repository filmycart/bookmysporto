<?php require_once('./private/init.php'); ?>
<?php
	$allCategory = array();
    $category = new Category();
    $subCategory = new Sub_Category();

    $sort_by = "title";
    $sort_type = "ASC";
    $subCategoryId = "";

	if(Helper::is_post() && isset($_POST["categoryId"])) {
        $categoryId = $_POST["categoryId"];        
        if((isset($_POST["subCategoryId"])) && (!empty($_POST["subCategoryId"]))) {
            $subCategoryId = $_POST["subCategoryId"];
        }
		$allSubCategory = (array) $subCategory->where(["category_id" => $categoryId])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventSubCategory" name="eventSubCategory" data-dropdown-css-class="select2-danger" style="width: 100%;" multiple>
    <?php
    	if(!empty($allSubCategory)){
    		foreach($allSubCategory as $allSubCategoryVal) {
                $sel_sub_category = "";
                if($allSubCategoryVal->id == $subCategoryId) {
                    $sel_sub_category = "selected";
                }
    ?>	
				<option value="<?php echo $allSubCategoryVal->id; ?>" <?php echo $sel_sub_category; ?>><?php echo $allSubCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>