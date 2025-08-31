<?php require_once('../../admin/private/init.php'); ?>

<?php
    $response = new Response();
    $errors = new Errors();

    if((Helper::is_post())){

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                $booking = new Bookings();

                $booking->player_name = trim($_POST['playerName']);
                $booking->player_phone_number = trim($_POST['playerPhoneNumber']);                    
                $booking->player_age = trim($_POST['playerAge']);                
                $booking->partner_player_name = trim($_POST['playerPartnerName']);
                $booking->partner_player_phone_number = trim($_POST['playerPartnerPhoneNumber']);                    
                $booking->partner_player_age = trim($_POST['playerPartnerAge']);
                $booking->event_id = trim($_POST['eventId']);
                $booking->venue_id = trim($_POST['venueId']);                    
                $booking->user_id = trim($_POST['userId']);
                $booking->booking = json_encode($_POST);
                $booking->status = 1;
                $booking->total_amount = trim($_POST['subtotal2']);

                $errors = $booking->get_errors();

                if($errors->is_empty()) {
                    if($errors->is_empty()) {
                        $id = $booking->save();
                        $has_error_creation = false;
                        return true;
                        exit;
                    }
                }

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>