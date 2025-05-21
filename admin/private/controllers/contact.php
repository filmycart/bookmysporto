<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $pgContactId = "";
    $pgContactAction = "";
    if((isset($_GET["id"])) && (!empty($_GET["id"]))) {
        $pgContactId = $_GET['id'];
    } elseif((isset($_POST["contactId"])) && (!empty($_POST["contactId"]))) {
        $pgContactId = $_POST['contactId'];
    } 

    if((isset($_GET["contactAction"])) && (!empty($_GET["contactAction"]))) {
        $pgContactAction = $_GET['contactAction'];
    } elseif((isset($_POST["contactAction"])) && (!empty($_POST["contactAction"]))) {
        $pgContactAction = $_POST['contactAction'];
    }

    $viewContact = new Contact();
    $viewContactArray = array();

    if((Helper::is_get()) && (!empty($pgContactId)) && ($pgContactAction == "edit")) {
        $viewContact->id = $pgContactId;
        $viewContactArray = (array) $viewContact->where(["id" => $viewContact->id])->one();
        echo json_encode($viewContactArray);
        exit;
    }

    if(empty($admin)) {
        Helper::redirect_to("admin_login.php");
    } else {
        $errors = new Errors();
        $message = new Message();
        $contact = new Contact();

        if (Helper::is_post()) {
            if((!empty($pgContactId)) && ($pgContactAction == "update")) {
                $viewContact = new Contact();
                $viewContact->name = trim($_POST['contactName']);
                $viewContact->id = $pgContactId;
                $viewContactArray = (array) $viewContact->where(["id" => $viewContact->id])->one();

                $contact->id = $pgEventId;
                $contact->name = trim($_POST['contactName']);
                $contact->email = $_POST['contactEmail'];
                $contact->mobile = $_POST['contactPhone'];
                $contact->message = $_POST['contactMessage'];

                $errors = $contact->get_errors();

                if($errors->is_empty()) {
                    if($contact->update()) {
                        Helper::redirect_to("../../contacts.php?msg=2");
                        exit;
                    }
                }
            }
        }
        elseif(Helper::is_get()) {
            if((!empty($pgContactId)) && ($pgContactAction == "delete")) {
                $contact->id = $pgContactId;

                if(!empty($contact->id)){
                    if($contact->where(["id" => $contact->id])->delete()) {
                        $message->set_message("Successfully Deleted.");
                    }else $errors->add_error("Error Occurred While Deleting");            
                }else $errors->add_error("Invalid Notification.");

                if(!$message->is_empty())  Session::set_session($message);
                else Session::set_session($errors);

                $delContactMsg = 1;
                $message->set_message($delContactMsg);
                Helper::redirect_to("../../contacts.php?msg=3");
                exit;
            }
        }
    }
?>