<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 10:31 PM
 */
class Librarys extends CoreBase{

    protected function addStyleAndScript()
    {
        try{

            $this->pageStyle = '<link href="Public/CSS/Librarys.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/Librarys.js" ></script>';

        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
    public function index($paramType = null, $paramVal = null){
        $_SESSION[Constants::SESSION_STOREHOME_DATA_OFFSET] = 0;
        try{
            $books = BookModel::getBookInfo();
            $bookDisplay['bookCard'] = BookModel::getBookHTML($books);
            $bookDisplay['filterCard']='<div id="yearAll" class="filter selected">All</div>
                                        <div id="year1"  class="filter notSelected">1st year</div>
                                        <div id="year2" class="filter notSelected">2nd year</div>
                                        <div id="year3" class="filter notSelected">3rd year</div>
                                        <div id="year4" class="filter notSelected">4th year</div>';
            $this->showPage($bookDisplay);

        }catch(Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }}