<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/28/2017
 * Time: 6:40 PM
 */
class About extends CoreBase{
    protected function addStyleAndScript()
    {
        try{

            $this->pageStyle = '<link href="Public/CSS/About.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/About.js"></script>';

        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }

    public  function index(){
        $this->showPage();
        echo 'About Page';
    }
}

?>