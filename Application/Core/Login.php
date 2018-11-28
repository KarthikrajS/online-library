<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 11:23 PM
 */
class Login extends CoreBase{
    protected function addStyleAndScript(){
        try{
            $this->pageStyle = '<link href="Public/CSS/Login.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/Login.js" ></script>';
        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
    public function index()
    {
        try
        {
            if(isset($_SESSION[Constants::SESSION_USER])&& !empty($_SESSION[Constants::SESSION_USER])){
                $user =$_SESSION[Constants::SESSION_USER];
                $userid = $user->UserId;
                $isAdmin = $user->isAdmin;
                Utility::redirect(Constants::DEFAULT_PAGE);
            }
            else
                $this->showPage();
        }
        catch (Exception $e)
        {
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
}
?>