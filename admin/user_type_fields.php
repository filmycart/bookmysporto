<?php require_once('./private/init.php'); ?>
<?php
    $pgUserTypeId = "";
    if((isset($_POST["userTypeId"])) && (!empty($_POST["userTypeId"]))){
        $pgUserTypeId = $_POST["userTypeId"];
    }

    if($pgUserTypeId == 1) {
?>
        <div class="eventFormCol">
            <label>E-Mail</label>
            <span class="required-field">*</span>
            <div class="form-group" data-target-input="nearest">
                <input type="text" class="form-control" name="userEmail" id="userEmail" />
            </div>
        </div>
        <div class="eventFormSpacerDiv">&nbsp;</div>
        <div class="eventFormCol">
            <label>Password</label>
            <span class="required-field">*</span>
            <div class="form-group" data-target-input="nearest">
                <input type="text" class="form-control" name="userPassword" id="userPassword" />
            </div>
        </div>
<?php        
    } else if(($pgUserTypeId == 2) || ($pgUserTypeId == 3) || ($pgUserTypeId == 5)) {
        $userLabel = "";
        if($pgUserTypeId == 2){
            $userLabel = "Facebook";
        } else if($pgUserTypeId == 3){
            $userLabel = "Google";
        } else if($pgUserTypeId == 5){
            $userLabel = "Apple";
        }
?>
        <div class="eventFormSpacerDiv">&nbsp;</div>
        <div class="eventFormCol">
            <label><?=$userLabel?></label>
            <span class="required-field">*</span>
            <div class="form-group" data-target-input="nearest">
                <input type="text" class="form-control" name="userSocialId" id="userSocialId" />
            </div>
        </div>   
<?php        
    } else if($pgUserTypeId == 4) {
?>
        <div class="eventFormSpacerDiv">&nbsp;</div>
        <div class="eventFormCol">
            <label>Mobile</label>
            <span class="required-field">*</span>
            <div class="form-group" data-target-input="nearest">
                <input type="text" class="form-control" name="userMobile" id="userMobile" />
            </div>
        </div>
<?php        
    }
?>








<script type="text/javascript">
    $("#userType").change(function() {
        var stateId = $("#userType").val();
        $.ajax({
            url: "city.php",
            cache: false,
            type: "POST",
            data: {stateId : stateId},
            success: function(html){
                $("#eventCityDiv").html(html);
            }
        });
    });    
</script>