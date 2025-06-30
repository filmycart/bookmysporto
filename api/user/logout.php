<?php require_once('././admin/private/init.php'); ?>
<?php
	$response = new Response();
	$errors = new Errors();

	if(Helper::is_get()) {
		
		unset($_SESSION['userId']);
		unset($_SESSION['userName']);
		unset($_SESSION['verificationToken']);
		unset($_SESSION['mobile']);

		header("Location: ../../sportifyv2");

	}else $response->create(201, "Invalid Request Method", null);

	echo $response->print_response();
?>
