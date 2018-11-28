<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/28/2017
 * Time: 10:33 PM
 */
if(!isset($_SESSION))
{
    session_start();
}

class Book extends CoreBase{
    protected function addStyleAndScript()
    {
        try{

            $this->pageStyle = '<link href="Public/CSS/Book.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/Book.js" ></script>';

        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
    public function index(){
        $link = ($_GET[Constants::GET_ARRAY_URL]);
        $bookDetails['book'] = BookModel::bookInfo(array(utility::URLlast($link)));
        $this->showPage($bookDetails);
    }
}