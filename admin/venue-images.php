<?php require_once('./private/init.php'); ?>
<?php
	$singleVenue = array();
    $venue = new Venue();

    $sort_by = "title";
    $sort_type = "ASC";
    $eventId = "";

	if(Helper::is_post()) {
        if((isset($_POST["venueId"])) && (!empty($_POST["venueId"]))) {
            $venueId = $_POST["venueId"];
        }

		$singleVenue = (array) $venue->where(["id" => $venueId])->one();
	}

    $venueImageNameArr = array();
    if((isset($singleVenue['image'])) && (!empty($singleVenue['image']))) {
        $venueImageNameArr = explode(",",$singleVenue['image']);
    }

	if(!empty($venueImageNameArr)) {
		foreach($venueImageNameArr as $singleVenueImgVal) {
?>	
		    <div><a href ="uploads/venues/<?php echo $singleVenueImgVal ?>" target="_blank" id="<?php echo $singleVenueImgVal; ?>"><?php echo $singleVenueImgVal ?></a></div>
<?php
		}
	}
?>
