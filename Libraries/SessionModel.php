<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 8:50 PM
 */
class SessionModel{
public function __get($property) {
    if (property_exists($this, $property)) {
        return $this->$property;
    }
}

public function __set($property, $value) {
    if (property_exists($this, $property)) {
        $this->$property = $value;
    }
}

public static function refreshSession()
{
    $_SESSION[Constants::SESSION_USERPOST] = $_SESSION[Constants::SESSION_USERPOST] ;
    $_SESSION[Constants::SESSION_USER] =$_SESSION[Constants::SESSION_USER];
    $_SESSION[Constants::SESSION_LASTUPDATETIME] = null;
    $_SESSION[Constants::SESSION_ISUPDATESUCCESS] = null;
    $_SESSION[Constants::SESSION_DISPLAYMESSGE] = null;
    $_SESSION[Constants::SESSION_STOREHOME_DATA_OFFSET] = 0;
}
public static function getSessionObjects()
{
    try{
        $newObject = [Constants::SESSION_LASTUPDATETIME => isset($_SESSION[Constants::SESSION_LASTUPDATETIME]) ? $_SESSION[Constants::SESSION_LASTUPDATETIME] : Constants::STR_EMPTY,
            Constants::SESSION_ISUPDATESUCCESS => isset($_SESSION[Constants::SESSION_ISUPDATESUCCESS]) ? $_SESSION[Constants::SESSION_ISUPDATESUCCESS] : Constants::STR_EMPTY,
            Constants::SESSION_DISPLAYMESSGE => isset($_SESSION[Constants::SESSION_DISPLAYMESSGE]) ? $_SESSION[Constants::SESSION_DISPLAYMESSGE] : Constants::STR_EMPTY,
            Constants::SESSION_USER => isset($_SESSION[Constants::SESSION_USER]) ? true : false,
            Constants::SESSION_USERPOST => isset($_SESSION[Constants::SESSION_USERPOST]) ? $_SESSION[Constants::SESSION_USERPOST] : Constants::STR_EMPTY,
            Constants::SESSION_LANDINGPAGE =>isset($_SESSION[Constants::SESSION_LANDINGPAGE]) ? $_SESSION[Constants::SESSION_LANDINGPAGE] : Constants::STR_EMPTY,];
        return $newObject;
    }catch (Exception $e){
        return $e;
    }
}
public static function logout()
{
    try{
        session_destroy();
        $_SESSION[Constants::SESSION_USERPOST] = null ;
        $_SESSION[Constants::SESSION_USER] = null;
        $_SESSION[Constants::SESSION_LASTUPDATETIME] = null;
        $_SESSION[Constants::SESSION_ISUPDATESUCCESS] = null;
        $_SESSION[Constants::SESSION_DISPLAYMESSGE] = null;
        $_SESSION[Constants::SESSION_LANDINGPAGE] = null;
        $_SESSION[Constants::SESSION_STOREHOME_DATA_OFFSET] = 0;
        return true;
    }
    catch(Exception $e)
    {
        return false;
    }
}

public static function clearSession()
{
    $_SESSION[Constants::SESSION_LASTUPDATETIME] = null;
    $_SESSION[Constants::SESSION_ISUPDATESUCCESS] = null;
    $_SESSION[Constants::SESSION_DISPLAYMESSGE] = null;
}

public static function sessionSetError($errMsg)
{
    $_SESSION[Constants::SESSION_LASTUPDATETIME] = time();
    $_SESSION[Constants::SESSION_ISUPDATESUCCESS] = false;
    $_SESSION[Constants::SESSION_DISPLAYMESSGE] = $errMsg;
}

public static function sessionSetSuccess($displayMsg)
{
    $_SESSION[Constants::SESSION_LASTUPDATETIME] = time();
    $_SESSION[Constants::SESSION_ISUPDATESUCCESS] = true;
    $_SESSION[Constants::SESSION_DISPLAYMESSGE] = $displayMsg;
}

}
?>