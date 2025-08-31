<?php require_once('../../admin/private/init.php'); ?>
<?php
	$allCategory = array();
    $subCategory = new Event_SubCategory();

    $sort_by = "title";
    $sort_type = "ASC";
    $subCatId = $sel_subcategory = "";

	if(Helper::is_post()) {
        $allSubCategory = (array) $subCategory->where(["status" => 1])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<div style="border:0px solid red;width:100%;float:left;">
    <?php
    	if(!empty($allSubCategory)) {
    		foreach($allSubCategory as $allSubCategoryVal) {
    ?>	
                <div style="border:0px solid red;width:20%;float:left;cursor: pointer;">
                    <div class="product-item">
                        <div style="border:0px solid red;width:100%;float:left;vertical-align: baseline;cursor: pointer;">
                            <img src="././admin/uploads/event_subcategory/<?=$allSubCategoryVal->image_name; ?>" title="<?=$allSubCategoryVal->title; ?>" height="25" width="25">
                        </div>
                        <div style="border:0px solid red;width:100%;float:left;">
                            <input type="checkbox" class="eventSubCategory" id="eventSubCategory_<?=$allSubCategoryVal->id?>" name="eventSubCategory_<?=$allSubCategoryVal->id?>" value="<?=$allSubCategoryVal->id?>" onclick="checkUncheckSubcat(this.value,'<?=$allSubCategoryVal->id?>')" />
                        </div>
                    </div>
                </div>
    <?php
    		}
    	}
    ?>
</div>
<!-- <div id="cartItemsSpinnerDiv"><img src="././admin/assets/images/spinner.png" class="spinner"></div> -->
<div class="form-group">
    <div id="cartItemsDiv"></div>
</div>