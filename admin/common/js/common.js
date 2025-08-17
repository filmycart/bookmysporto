function userTypeFunc(userTypeId) {
    $.ajax({
        url: "user_type.php",
        cache: false,
        type: "POST",
        data: {userTypeId : userTypeId},
        beforeSend: function() {
            $('#userTypeSpinnerDiv').show();
        },
        complete: function(){
            $('#userTypeSpinnerDiv').hide();
        },
        success: function(html){
            $("#userTypeDiv").html(html);
        }
    });
}

function userTypeFieldsFunc(userTypeId) {
    $.ajax({
        url: "user_type_fields.php",
        cache: false,
        type: "POST",
        data: {userTypeId : userTypeId},
        success: function(html){
            $("#userTypeFieldsDiv").html(html);
        }
    });
}

function eventState(countryId, cityId, stateId) {
    $.ajax({
        url: "state.php",
        cache: false,
        type: "POST",
        data: {countryId : countryId, stateSelId : stateId},
        beforeSend: function() {
            $('#stateSpinnerDiv').show();
        },
        complete: function(){
            $('#stateSpinnerDiv').hide();
        },
        success: function(html){
            $("#stateDiv").html(html);
            eventCity(cityId, stateId);
        }
    });
}

function eventVenue(venueId) {
    $.ajax({
        url: "event_venue.php",
        cache: false,
        type: "POST",
        data: {venueId : venueId},
        beforeSend: function() {
            $('#eventVenueSpinnerDiv').show();
        },
        complete: function(){
            $('#eventVenueSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventVenueDiv").html(html);
        }
    });
}  

function eventCity(cityId, stateId) {
    $.ajax({
        url: "city.php",
        cache: false,
        type: "POST",
        data: {cityId : cityId, stateId : stateId},
        beforeSend: function() {
            $('#citySpinnerDiv').show();
        },
        complete: function(){
            $('#citySpinnerDiv').hide();
        },
        success: function(html){
            $("#cityDiv").html(html);
        }
    });
}   

function eventType(eventTypeId) {
    $.ajax({
        url: "type.php",
        cache: false,
        type: "POST",
        data: {eventTypeId : eventTypeId},
        beforeSend: function() {
            $('#typeSpinnerDiv').show();
        },
        complete: function(){
            $('#typeSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventTypeDiv").html(html);
        }
    });
} 

function eventCategoryType(categoryId, eventTypeId, categoryTypeId) {
    $.ajax({
        url: "category_type.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId, eventTypeId : eventTypeId, categoryTypeId : categoryTypeId},
        beforeSend: function() {
            $('#categoryTypeSpinnerDiv').show();
        },
        complete: function(){
            $('#categoryTypeSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventCategoryTypeDiv").html(html);
        }
    });
}

function eventCategory(categoryId, eventTypeId) {
    $.ajax({
        url: "category.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId, eventTypeId: eventTypeId},
        beforeSend: function() {
            $('#categorySpinnerDiv').show();
        },
        complete: function(){
            $('#categorySpinnerDiv').hide();
        },
        success: function(html){
            $("#eventCategoryDiv").html(html);
        }
    });
}

function viewEventCategory(categoryId) {
    $.ajax({
        url: "view_category.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId},
        beforeSend: function() {
            $('#viewCategorySpinnerDiv').show();
        },
        complete: function(){
            $('#viewCategorySpinnerDiv').hide();
        },
        success: function(html){
            $("#viewCategoryDiv").html(html);
        }
    });
}

function viewEventSubCategory(subCategoryId) {
    $.ajax({
        url: "view_sub_category.php",
        cache: false,
        type: "POST",
        data: {subCategoryId : subCategoryId},
        beforeSend: function() {
            $('#viewSubCategorySpinnerDiv').show();
        },
        complete: function(){
            $('#viewSubCategorySpinnerDiv').hide();
        },
        success: function(html){
            $("#viewSubCategoryDiv").html(html);
        }
    });
}

function eventDescription(eventId) {
    $.ajax({
        url: "event-description.php",
        cache: false,
        type: "POST",
        data: {eventId : eventId},
        beforeSend: function() {
            $('#eventDescSpinnerDiv').show();
        },
        complete: function(){
            $('#eventDescSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventDescDiv").html(html);
        }
    });
}

function eventImage(eventId) {
    $.ajax({
        url: "event-images.php",
        cache: false,
        type: "POST",
        data: {eventId: eventId},
        beforeSend: function() {
            $('#evenFileSpinnerDiv').show();
        },
        complete: function(){
            $('#evenFileSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventImagePreview").html(html);
        }
    });
}

function userImage(userId) {
    $.ajax({
        url: "user-images.php",
        cache: false,
        type: "POST",
        data: {userId: userId},
        beforeSend: function() {
            $('#userImageSpinnerDiv').show();
        },
        complete: function(){
            $('#userImageSpinnerDiv').hide();
        },
        success: function(html){
            $("#userImagePreview").html(html);
        }
    });
}

function venueImage(venueId) {
    $.ajax({
        url: "venue-images.php",
        cache: false,
        type: "POST",
        data: {venueId: venueId},
        beforeSend: function() {
            $('#venueFileSpinnerDiv').show();
        },
        complete: function(){
            $('#venueFileSpinnerDiv').hide();
        },
        success: function(html){
            $("#venueImagePreview").html(html);
        }
    });
}

function eventCategoryImage(eventCategoryId) {
    $.ajax({
        url: "event-category-images.php",
        cache: false,
        type: "POST",
        data: {eventCategoryId: eventCategoryId},
        beforeSend: function() {
            $('#eventCategoryFileSpinnerDiv').show();
        },
        complete: function(){
            $('#eventCategoryFileSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventCategoryImagePreview").html(html);
        }
    });
}  

function eventSubCategoryImage(eventSubCategoryId) {
    $.ajax({
        url: "event-subcategory-images.php",
        cache: false,
        type: "POST",
        data: {eventSubCategoryId: eventSubCategoryId},
        beforeSend: function() {
            $('#eventSubCategoryFileSpinnerDiv').show();
        },
        complete: function(){
            $('#eventSubCategoryFileSpinnerDiv').hide();
        },
        success: function(html){
            $("#eventSubCategoryImagePreview").html(html);
        }
    });
}  

function eventSubCategory(categoryId, subCategoryId) {
    $.ajax({
        url: "sub_category.php",
        cache: false,
        type: "POST",
        data: {categoryId : categoryId, subCategoryId : subCategoryId },
        beforeSend: function() {
            $('#subCategorySpinnerDiv').show();
        },
        complete: function(){
            $('#subCategorySpinnerDiv').hide();
        },
        success: function(html){
            $("#eventSubCategoryDiv").append(html);
        }
    });
}     