<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 8/8/2017
 * Time: 12:29 PM
 */
class Stylist extends CoreBase{
    protected function addStyleAndScript()
    {
        try{

            $this->pageStyle = '<link href="Public/CSS/Librarys.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/Librarys.js" ></script>';

        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
}
?>