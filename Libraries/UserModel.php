<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/27/2017
 * Time: 6:31 AM
 */
class UserModel{
    public $UserId;
    public $Email;
    public $Handle;
    public $FirstName;
    public $LastName;
    public $MobileNumber;
    public $Gender;
    public $Birthdate;
    public $UserPost;
    public $ProfileImage;
    public $isFollowed = false;
    public $requests;
    public $isAdmin = 0;


    public static function isEmailRegistered($email)
    {
        //Need not check is verified because this is used in login and if isverified is checked it ll show that the email is not registered
        try{
            $dbInteractor = new DatabaseInteractor();
            $query = 'select email from user where email  = ?';
            $result = $dbInteractor->selectWithQuery($query, array($email));
            return $result;
        }
        catch(Exception $e)
        {
            return null;
        }
    }

    public static function getUserDetails($emailID){
        try{
            $query = "select userId,email, password FROM user where email=?";
            $db=new DatabaseInteractor();
            $result=$db->selectWithQuery($query,array($emailID));
            if(!is_null($result[0][Constants::DB_USER_COL_EMAILID]))
            {
                $resultSet = ["EmailPresent"=>true,"userId"=>$result[0][Constants::DB_USER_COL_USERID]];
                return $resultSet;
            }
            else
            {
                return false;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public static function verifyUser($email, $password)
    {
        try {
            if (isset($email) && isset($password)) {
                $userDetails = self::getUserDetails($email);
                $userId = $userDetails[Constants::DB_USER_COL_USERID];
                if ($userDetails["EmailPresent"]) {

                    if(self::verifyPassword($email,$password)) {
                        $_SESSION [Constants::SESSION_USER] = UserModel::LoadFullUser($userId);
                        $_SESSION[Constants::SESSION_USERPOST] = null;
                        $_SESSION[Constants::SESSION_LASTUPDATETIME] = null;
                        $_SESSION[Constants::SESSION_ISUPDATESUCCESS] = null;
                        $_SESSION[Constants::SESSION_DISPLAYMESSGE] = null;

                        return 1;

                    }
                } else {
                    $_SESSION[Constants::SESSION_USER] = null;
                    $_SESSION[Constants::SESSION_USERPOST] = null; //Let it fetch the new place again
                    return 2;
                }
            } else {
                $_SESSION[Constants::SESSION_USER] = null;
                $_SESSION[Constants::SESSION_USERPOST] = null;
            }
            return 0;
        }catch (Exception $e){
            return 0;
        }
    }

    public static function LoadFullUser($userid){
        try{
            $resultset = UserModel::GetUserResultSet($userid);
            if(!is_null($resultset)){
                $user = new UserModel();
                $user->UserId = $resultset[0][Constants::DB_USER_COL_USERID];
                $user->FirstName = $resultset[0][Constants::DB_USER_COL_FIRSTNAME];
                $user->LastName = $resultset[0][Constants::DB_USER_COL_LASTNAME];
                $user->Email = $resultset[0][Constants::DB_USER_COL_EMAILID];
                $user->MobileNumber = $resultset[0][Constants::DB_USER_COL_MOBILENUMBER];
                $user->Gender = $resultset[0][Constants::DB_USER_COL_GENDER];
                $user->isAdmin = $resultset[0][Constants::DB_USER_COL_ADMIN];

                return $user;
            }
        }catch (Exception $e){
            return null;
        }
    }
    public function getDetails(){
        return $this->UserId;
    }
    public static function GetUserResultSet($userid){
        try{
            $query = "select * from user where userId= ?  ";
            $dbInteractor = new DatabaseInteractor();
            $resultset = $dbInteractor->selectWithQuery($query, array($userid));
            return $resultset;

        }catch (Exception $e){
            return null;
        }
    }
    public static function verifyPassword($emailId,$passwordReceived){
        try {
            $query = "Select Password from user where email=?";
            $db = new DatabaseInteractor();
            $result = $db->selectWithQuery($query, array($emailId));
            return (!is_null($result)) ? ($passwordReceived == $result[0][Constants::DB_USER_COL_PASSWORD]) : false;
        }catch (Exception $e){
            return false;
        }
    }


    public static function LoadDisplayUser($userid)
    {
        try
        {
            $query = "SELECT UserId,FirstName,LastName, Email,FROM user where userid=?  LIMIT 1";
            $dbInteractor = new DatabaseInteractor();
            $resultset = $dbInteractor->selectWithQuery($query, array($userid));
            if(!is_null($resultset))
            {
                $user = new UserModel();
                $user->UserId = $resultset[0][Constants::DB_USER_COL_USERID];
                $user->FirstName = $resultset[0][Constants::DB_USER_COL_FIRSTNAME];
                $user->LastName = $resultset[0][Constants::DB_USER_COL_LASTNAME];
                $user->Email = $resultset[0][Constants::DB_USER_COL_EMAILID];
//                $user->Handle = $resultset[0][Constants::DB_USER_COL_HANDLE];
//                $user->ProfileImage = $resultset[0][Constants::DB_USER_COL_PROFILEIMAGE];
                return $user;
            }
            else
                return null;
        }
        catch (Exception $e)
        {
            return null;
        }
    }
}
?>