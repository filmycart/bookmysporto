<?php require_once('../../admin/private/init.php'); ?>
<?php
	$allCategory = array();
    $category = new Category();

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
?>
<select class="form-control2" id="eventCategory" name="eventCategory">
    <option value="">Select Category</option>
    <?php
    	if(!empty($allCategory)){
    		foreach($allCategory as $allCategoryVal) {
                $sel_category = "";
                if(!empty($categoryId)) {
                    if(in_array($allCategoryVal->id, $categoryId)) {
                        $sel_category = "selected";
                    }
                }
    ?>	
				<option value="<?php echo $allCategoryVal->id; ?>" <?php echo $sel_category; ?>><?php echo $allCategoryVal->title; ?></option>
    <?php
    		}
    	}
    ?>
</select>
<script type="text/javascript">
    $("#eventCategory").change(function() {
        var eventCategorySelMultiValues = $(this).val();
        $("#eventCategoryHidden").val(eventCategorySelMultiValues);
    });
</script>