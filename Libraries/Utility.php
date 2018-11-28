<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 7:37 PM
 */
class Utility{
    static function redirect($url) {
        ob_start();
        header("Location: http://".$_SERVER['HTTP_HOST'].Constants::DEFAULT_DIRECTORY.$url);
        ob_end_flush();
        die();
    }
    static function isEmpty($object)
    {
        $array = (array)$object;
        return empty($array);
    }
    static function URLlast($param){
        if(!is_null($param)) {
            $return_array = explode('/', $param);
            return $return_array[sizeof($return_array) - 1];
        }
        else
            return null;
    }

    static function stringEmpty($strVal)
    {
        if(is_null($strVal)){
            return true;
        }
        else{
            return trim($strVal) == '';
        }
    }
    static function GetClassConstants($className)
    {
        $c = new ReflectionClass($className);
        return ($c->getConstants());
    }

//build card for book
    static function buildCardForBook($books){

        try{
            $bookCardHTML = null;

            if(!is_null($books)) {
                foreach ($books as $book) {
//                    $bookCardHTML = $bookCardHTML . "<div class='storeHomeCardItem boxShadow curvedBox'  data-genre='".$book->bookGenre."' data-handle='" . $book->bookId . "' data-auth='" . $book->bookAuthId . "' data-pub='" . $book->bookPublisher . "'></div>";
                    $bookCardHTML = $bookCardHTML."
                <div class='bookHomeCardItem boxShadow curvedBox'  data-genre='" . $book->bookGenre . "' data-handle='" . $book->bookId . "'>
                <div class = 'cardItem'>
                <div class='cardItemInfo borderBottom'>
                <div class='storeHomeCardStoreName'><h2><a href='" . Constants::URL_STORES_SHOW . $book->bookId . "' title='" . $book->bookTitle . "'>" . $book->bookTitle . "</a></h2><h4>Author : " . $book->bookAuthName . "</h4><h4>Publisher : " . $book->bookPubName . "</h4></div></div></div></div>";

                }
            }
            return $bookCardHTML;

        }catch(Exception $e){
            return Constants::STR_EMPTY;
        }
    }

}
?>