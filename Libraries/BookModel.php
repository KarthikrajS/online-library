<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 8:42 PM
 */
class BookModel implements \JsonSerializable{
    private $bookId;
    private $bookTitle;
    private $bookAuthId;
    private $bookPublisher ;
    private $bookGenre ;
    private $bookISBN ;
    private $bookPubName ;
    private $bookCountry ;
    private $bookAuthName ;
    private $bookBuy;
    private $bookRent;

    public function JsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }


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

    public static function selection($year){

    }

    public static function bookInfo($bookId)
    {
        try {
            $query = 'SELECT bo.*,pu.*,au.* FROM book bo join publisher pu on pu.publisherId = bo.publisherId join author au on au.author_id = bo.author_id where book_id=?';
            $dbInteractor = new  DatabaseInteractor();
            $result = $dbInteractor->selectWithQuery($query, $bookId);
            return (!is_null($result)) ? $result[0] : null;
        }catch (Exception $e){
            return null;
        }
    }
    public static function getBookInfo()
    {
        try {
            $query = "SELECT bo.*,pu.*,au.* FROM book bo join publisher pu on pu.publisherId = bo.publisherId join author au on au.author_id = bo.author_id";
            $dbInteractor = new  DatabaseInteractor();
            $result = $dbInteractor->selectWithQuery($query);
            return  (!is_null($result)) ? $result :  null;
        }catch (Exception $e){
            return null;
        }
    }

    //get HTML for Book Home
    public static function getBookHTML($bookListResult){
        try{
            $bookList = array();
            if(!is_null($bookListResult) && count($bookListResult) >0) {
                foreach ($bookListResult as $book) {
                    $bookM = new BookModel();
                    $bookM->bookId = $book['book_id'];
                    $bookM->bookTitle = $book['title'];
                    $bookM->bookAuthId = $book['author_id'];
                    $bookM->bookPublisher = $book['publisherId'];
                    $bookM->bookGenre = $book['genre'];
                    $bookM->bookISBN = $book['isbn'];
                    $bookM->bookPubName = $book['publishername'];
                    $bookM->bookCountry = $book['country'];
                    $bookM->bookAuthName = $book['fname'] . " " . $book['lname'];
                    array_push($bookList,$bookM);
                }

                $html = Utility::buildCardForBook($bookList);
            }
            else
                {
                $html = "<div id='NoBooks'>No Books To Display</div>";
                }
            return $html;
        }catch(Exception $e){
                return Constants::STR_EMPTY;
        }

    }


}
?>