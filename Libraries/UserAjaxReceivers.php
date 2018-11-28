<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/27/2017
 * Time: 6:27 AM
 */
include_once "SiteLoader.php";
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
if((isset($_POST[Constants::POST_ARGS_PARAM]) && !empty($_POST[Constants::POST_ARGS_PARAM]))) {
    $args = $_POST[Constants::POST_ARGS_PARAM];
    $action = $args[Constants::AJAX_ACTION];
    if ($action != null && !empty($action)) {
        $param = null;
        if (isset($args[Constants::AJAX_PARAM]))
            $param = $args[Constants::AJAX_PARAM];


        switch ($action) { //Switch case for value of action
            case Constants::USER_AJAX_FN_ISEMAILREGISTERED:
                isEmailRegistered($param);
                break;
            case Constants::USER_AJAX_FN_VERIFY_USER:
                verifyUser($param);
                break;
            case Constants::USER_AJAX_FN_GETSESSIONOBJECTS:
                GetSessionObjects();
                break;
            case Constants::USER_AJAX_FN_LOGOUT :
                Logout();
                break;
            case Constants::CMN_AJAX_ADD_CART:
                addCart($param);
            break;
            case Constants::CMN_AJAX_LOAD_CART : loadCart();break;
        }
    }
}

function GetSessionObjects()
{
    $sessionOb = SessionModel::getSessionObjects();
    echo json_encode($sessionOb);
}
function loadCart()
{
    $result= CartModel::loadCart();
    echo json_encode($result);
}

function addCart($param)
{
    $result = CartModel::AddCart($param);
    echo json_encode($result);
}

function isEmailRegistered($param)
{
    $result  = UserModel::isEmailRegistered($param);
    if(!is_null($result))
    {
        if(count($result[0])>0)
            echo Constants::STR_VALID;
        else
            echo Constants::STR_INVALID;
    }
}

function verifyUser($param)
{
    $result = UserModel::verifyUser($param[Constants::PARAM_USERNAME],$param[Constants::PARAM_PASSWORD]);
    echo $result; //0 for not valid, 1 for valid, 2 for registered but not verified
}

function Logout()
{
    $result = SessionModel::logout();
    if($result)
        echo Constants::STR_VALID;
    else
        echo Constants::STR_INVALID;
}
?>