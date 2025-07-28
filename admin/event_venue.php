<?php require_once('./private/init.php'); ?>
<?php
	$allVenue = array();
    $venue = new Venue();

    $sort_by = "title";
    $sort_type = "ASC";
    $eventVenueSelId = "";    
    $venueSel = "";
	
    if(Helper::is_post()){
        $eventVenueSelId = $_POST["venueId"];
        $allVenue = (array) $venue->where(["status" => "1"])->orderBy($sort_by)->orderType($sort_type)->all();
	}
?>
<select class="form-control select2 select2-danger" id="venue" name="venue" data-dropdown-css-class="select2-danger" style="width: 100%;">
    <option value="">Select Venue</option>
    <?php
    	if(!empty($allVenue)) {
    		foreach($allVenue as $allVenueVal){
                if(!empty($eventVenueSelId)) {
                    if($eventVenueSelId == $allVenueVal->id) {
                        $venueSel = "selected";
                    } else {
                        $venueSel = "";
                    }
                }
    ?>	
				<option value="<?php echo $allVenueVal->id; ?>" <?php echo $venueSel; ?> ><?php echo $allVenueVal->title; ?>
                </option>
    <?php
    		}
    	}
    ?>
</select>
