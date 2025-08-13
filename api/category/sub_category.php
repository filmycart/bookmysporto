<?php require_once('../../admin/private/init.php'); ?>
<?php
	$allCategory = array();
    $subCategory = new Event_SubCategory();

    $sort_by = "title";
    $sort_type = "ASC";
    $subCatId = $sel_subcategory = "";

	if(Helper::is_post()) {
        if((isset($_POST["subCatId"])) && (!empty($_POST["subCatId"]))) {
            $subCatId = explode(",",$_POST["subCatId"]);
        }

        $allSubCategory = (array) $subCategory->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control2" id="eventSubCategory" name="eventSubCategory">
    <option value="">Select Sub Category</option>
    <?php
    	if(!empty($allSubCategory)){
    		foreach($allSubCategory as $allSubCategoryVal) {
                $sel_category = "";
                if(!empty($subCatId)) {
                    if(in_array($allSubCategoryVal->id, $subCatId)) {
                        $sel_subcategory = "selected";
                    }
                }
    ?>	
				<option value="<?php echo $allSubCategoryVal->id; ?>" <?php echo $sel_subcategory; ?>><?php echo $allSubCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
    $("#eventSubCategory").change(function() {
        var eventSubCategorySelMultiValues = $(this).val();
        $("#eventCategoryHidden").val(eventSubCategorySelMultiValues);
    });
</script>