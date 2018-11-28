<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 8:23 PM
 */
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
class BooksHome extends CoreBase{
    protected function addStyleAndScript()
    {
        try{

            $this->pageStyle = '<link href="Public/CSS/BooksHome.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/BooksHome.js" ></script>';

        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }

    public function index($paramType = null, $paramVal = null){
        $_SESSION[Constants::SESSION_STOREHOME_DATA_OFFSET] = 0;
        try{
                $books = BookModel::getBookInfo();
                $bookDisplay['bookCard'] = BookModel::getBookHTML($books);
                $this->showPage($bookDisplay);

        }catch(Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
}
?>
