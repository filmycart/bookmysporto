<?php require_once('../../admin/private/init.php'); ?>
<?php
    $response = new Response();
    $errors = new Errors();
    $send_mail = false;

    if(Helper::is_post()) {
        
        $api_token = Helper::post_val("api_token");

        if($api_token) {
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                if(isset($_POST["contactName"]) && isset($_POST["contactEmail"]) && isset($_POST["contactPhone"]) && isset($_POST["contactMessage"]) && isset($_POST["contactSubject"])) {
                    $contact = new Contact();
                    $contact->name = Helper::post_val("contactName");
                    $contact->email = Helper::post_val("contactEmail");
                    $contact->mobile = Helper::post_val("contactPhone");
                    $contact->subject = Helper::post_val("contactSubject");
                    $contact->message = Helper::post_val("contactMessage");
                    $contact->status = 1;

                    $errors = $contact->get_errors();
                    if($errors->is_empty()) {
                        $contact->id = $contact->save();
                        if(!empty($contact->id)) {
                            $response->create(200, "Contact Submitted Successfully.", $contact->response()->to_valid_array());
                        }else $response->create(201, "Something Went Wrong", null);                    
                    } else $response->create(201, "Invalid Contact", null);
                }else $response->create(201, "Invalid Parameter", null);
            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Foudddnd", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>
