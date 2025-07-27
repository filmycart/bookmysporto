<?php require_once('../init.php'); ?>
<?php
    $admin = Session::get_session(new Admin());

    $pgContactId = "";
    $pgContactAction = "";
    if((isset($_GET["contactId"])) && (!empty($_GET["contactId"]))) {
        $pgContactId = $_GET['contactId'];
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

    if((Helper::is_get()) && (!empty($pgContactId)) && ($pgContactAction == "view")) {
        $viewContact->id = $pgContactId;
        $viewContactArray = (array) $viewContact->where(["id" => $viewContact->id])->one();
        echo json_encode($viewContactArray);
        exit;
    }elseif((Helper::is_get()) && (!empty($pgContactId)) && ($pgContactAction == "edit")) {
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
        $updContact = new Contact();
        $delContact = new Contact();

        if (Helper::is_post()) {
            if((!empty($pgContactId)) && ($pgContactAction == "update")) {
                $viewEditContact = new Contact();
                $viewEditContact->name = trim($_POST['contactName']);
                $viewEditContact->id = $pgContactId;
                //$viewEditContactArray = (array) $viewEditContact->where(["name" => $viewEditContact->name])->not(["id" => $viewEditContact->id])->one();
                $viewEditContactArray = (array) $viewEditContact->where(["id" => $viewEditContact->id])->one();

                $updContact->id = $pgContactId;
                $updContact->name = trim($_POST['contactName']);
                $updContact->email = $_POST['contactEmail'];
                $updContact->mobile = $_POST['contactPhone'];
                $updContact->subject = $_POST['contactSubject'];
                $updContact->message = $_POST['contactMessage'];
                $updContact->status = (isset($_POST['contacStatus'])) ? 1 : 1;

                $errors = $updContact->get_errors();

                if($errors->is_empty()){
                    if($updContact->where(["id"=>$updContact->id])->update()){
                        Helper::redirect_to("../../contacts.php?msg=2");
                        exit;
                    }
                }   
            }
        }elseif(Helper::is_get()) {
            if((!empty($pgContactId)) && ($pgContactAction == "delete")) {
                $delContact->id = $pgContactId;
                if(!empty($delContact->id)){
                    if($delContact->where(["id" => $delContact->id])->delete()) {
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