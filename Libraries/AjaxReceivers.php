<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/27/2017
 * Time: 6:23 AM
 */
include_once "SiteLoader.php";
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
/*
include_once "UserModel.php";
include_once "Utility.php";
include_once "DataBaseInteractor.php"; // Ajax receiver need not be in site loader - it is called from javascript
//But it must use require the db interactor file as it is not coming from the Site Router
*/

//Handle user session here and in js file - pop up login for session

if((isset($_POST[Constants::POST_ARGS_PARAM]) && !empty($_POST[Constants::POST_ARGS_PARAM]))) {
    $args = $_POST[Constants::POST_ARGS_PARAM];
    $action = $args[Constants::AJAX_ACTION];
    if ($action != null && !empty($action)) {
        if (isset($args[Constants::AJAX_PARAM]))
            $param = $args[Constants::AJAX_PARAM];
        switch ($action) { //Switch case for value of action
            case Constants::CMN_AJAX_FN_GETCONSTANTS:getConstants(); break;

        }
    }
}


function getConstants()
{
    $result = Utility::GetClassConstants(Constants::CONSTANTS_CLASS);
    echo json_encode($result);
}



?>