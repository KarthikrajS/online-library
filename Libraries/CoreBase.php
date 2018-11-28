<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 7:29 PM
 */
    if(!isset($_SESSION))
    {
        session_start();
    }

abstract class CoreBase
{
    protected $design = Constants::ERROR_PAGE;
    protected $userPost = Constants::STR_NULL;
    protected $pageStyle = Constants::STR_EMPTY;
    protected $pageScript = Constants::STR_EMPTY;
    protected $pageTitle = Constants::STR_EMPTY;

    protected abstract function addStyleAndScript();

    public function __construct()
    {
        try
        {
            $this->loadFromSession();

            if(file_exists(Designs.get_class($this).Constants::DESIGN_PAGE_EXT))
            {
                $this->design = get_class($this);
            }
            $this->addStyleAndScript();
        }
        catch (Exception $e)
        {
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }

    protected function loadFromSession(){
    try{
        if(isset($_SESSION[Constants::SESSION_USERPOST])&& !empty($_SESSION[Constants::SESSION_USERPOST]))
        {
            $userpost = $_SESSION[Constants::SESSION_USERPOST];
            $this->userPost =$userpost[Constants::USERPOST_CITY].",".$userpost[Constants::USERPOST_COUNTRY];
        }

        //empty check
        if (!isset($_SESSION[Constants::SESSION_CITY_ID])&& empty($_SESSION[Constants::SESSION_CITY_ID]))
        {
            $_SESSION[Constants::SESSION_CITY_ID] = "1";
        }

    }catch (Exception $e){
        Utility::redirect(Constants::ERROR_PAGE);
    }
    }

    public function showPage($pageObject=null)
    {
        try
        {
            if(isset($pageObject) && !is_null($pageObject))
                $displayObject = $pageObject;

            // Assigning the Individual Page design to the Master Template content place holder
            $content = Designs.$this->design.Constants::DESIGN_PAGE_EXT;
            $userPost = $this->userPost;
            $pageStyle = $this->pageStyle;
            $pageScript = $this->pageScript;
            $pageTitle = $this->pageTitle;
            require_once Commons.SiteTemplateFile;
//            require_once $content;
        }
        catch (Exception $e)
        {
            Utility::redirect(Constants::ERROR_PAGE);
        }

    }
}
?>