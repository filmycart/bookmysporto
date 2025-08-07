<?php require_once('./private/init.php'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../admin/dist/css/richtext.min.css">
<script src="../admin/dist/js/jquery.richtext.js"></script>
        <script>
            jQuery.noConflict();
            (function( $ ) {
              $(function() {
                /*$('.content').richText({
                    useTabForNext: true,
                    maxlength: 1000,
                    maxlengthIncludeHTML: true
                });*/

                $('.content2').richText({
                    useTabForNext: true
                });
              });
            })(jQuery);
        </script>
<?php
    $eventDetail = array();
    $event = new Event();

    $sort_by = "title";
    $sort_type = "ASC";
    $eventId = "";

    if(Helper::is_post()) {
        if((isset($_POST["eventId"])) && (!empty($_POST["eventId"]))) {
            $eventId = $_POST["eventId"];
        }

        $eventDetail = (array) $event->where(["id" => $eventId])->orderBy($sort_by)->orderType($sort_type)->one();
    }

    /*print"<pre>";
    print_r($eventDetail['description']);
    exit;*/
?>
<textarea id="eventDescription" name="eventDescription" rows="5" class="content2 form-group" data-target="#eventDescription"><?=(!empty($eventDetail['description'])?$eventDetail['description']:'')?></textarea>  
