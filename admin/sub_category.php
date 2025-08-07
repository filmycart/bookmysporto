<?php require_once('./private/init.php'); ?>
<?php
	$allCategory = $subCategoryIdArr = array();
    $category = new Category();
    $subCategory = new Event_SubCategory();

    $sort_by = "title";
    $sort_type = "ASC";
    $subCategoryId = "";

    if(Helper::is_post() && isset($_POST["categoryId"])) {
        $categoryId = $_POST["categoryId"];        
        if((isset($_POST["subCategoryId"])) && (!empty($_POST["subCategoryId"]))) {
            $subCategoryId = $_POST["subCategoryId"];
        }

        if((!empty($subCategoryId))) {
            $subCategoryIdArr = explode(",",$subCategoryId);            
        }

        $allSubCategory = (array) $subCategory->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="eventSubCategory" name="eventSubCategory" data-dropdown-css-class="select2-danger" style="width: 100%;" multiple>
    <?php
    	if(!empty($allSubCategory)){
    		foreach($allSubCategory as $allSubCategoryVal) {
                $sel_sub_category = "";
                if(in_array($allSubCategoryVal->id, $subCategoryIdArr)){
                    $sel_sub_category = "selected";
                }
    ?>	
				<option value="<?php echo $allSubCategoryVal->id; ?>" <?php echo $sel_sub_category; ?>><?php echo $allSubCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
    $("#eventSubCategory").change(function() {
        var eventSubCategorySelMultiValues = $(this).val();
        $("#eventSubCategoryHidden").val(eventSubCategorySelMultiValues);
    });
</script>