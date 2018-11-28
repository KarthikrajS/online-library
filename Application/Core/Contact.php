<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/28/2017
 * Time: 9:40 PM
 */
class Contact extends CoreBase{
    protected function addStyleAndScript()
    {
        try{

            $this->pageStyle = '<link href="Public/CSS/Contact.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/Contact.js" ></script>';

        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
    public function index($paramType = null, $paramVal = null)
    {
        $text['new'] = 'Contact';
        $this->showPage($text);
    }
}