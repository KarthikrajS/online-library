<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 4/7/2017
 * Time: 10:21 AM
 */
class CartModel{
    private $cart_model;

    public function __construct()
    {
        $this->cart_model = new CartModel();
    }

    public static function AddCart($param)
    {
        try{
            var_dump('hi');
                $result = false;
                $bookId = Utility::URLlast($param['URL']);
                $type = $param['type'];
                if(isset($_SESSION['cart'])){
                array_push($_SESSION['cart'],array($bookId,$type));
                $result = true;
            }
            else{
                $_SESSION['cart'] = array(array($bookId,$type));
                $result = true;
            }
                return $result;
            }
            catch (Exception $e){
                return false;
            }
        }

    public static function buildcartCardHTML(){
        try{
                $cartHTML = null;
                $details = self::loadCart();
                if(sizeof($details)> 0 && $details !=null) {
                    foreach ($details as $singleDetail) {
                        $val = 0;
                        $cartHTML .= '<div id="cartCard" class="' . $val . '">
                        <div id="type"><span>To : ' . $singleDetail[1] . '</span><span   id = "cost"> Rs.'.$singleDetail[0][0]['price'].'</span></div>
                        <div id = "details">
                        <div class="bookHomeCardItem boxShadow curvedBox"  data-genre="' . $singleDetail[0][0]['genre'] . '" data-handle="' . $singleDetail[0][0]['book_id'] . '">
                <div class = "cardItem">
                <div class="cardItemInfo borderBottom">
                <div class="storeHomeCardStoreName"><h2><a href="' . Constants::URL_STORES_SHOW . $singleDetail[0][0]['book_id']. '" title="' . $singleDetail[0][0]['title'] . '">' . $singleDetail[0][0]['title'] . '</a></h2><h4>Author : ' . $singleDetail[0][0]['lname'] . $singleDetail[0][0]['fname'] . '</h4><h4>Publisher : ' . $singleDetail[0][0]['publishername'] . '</h4></div></div></div></div>
                    </div></div>';
                    }
                }
                else
                    $cartHTML =  '<div id="notFount">The cart is empty.</div>';
                return $cartHTML;
            }catch (Exception $e){
            return null;
        }
    }

    Public static function loadCart(){
        try
        {
            if($_SESSION)
            if(isset($_SESSION['cart'])) {
                $total = $_SESSION['cart'];
                $query = 'SELECT bo.*,pu.*,au.* FROM book bo join publisher pu on pu.publisherId = bo.publisherId join author au on au.author_id = bo.author_id where book_id=?';
                $databaseInteractor = new DatabaseInteractor();
                $result = array();
                foreach($total as $book){
                    array_push($result,array($databaseInteractor->selectWithQuery($query,array($book[0])),$book[1]));
                }
                return $result;
            }
            else
            {
                return null;
            }
        }catch (Exception $e){
                return null;
        }
    }
}
?>