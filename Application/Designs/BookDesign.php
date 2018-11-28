<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/28/2017
 * Time: 10:34 PM
 */

$bookDetails = $displayObject['book'];
if($bookDetails['count'] > 0) {
    echo $bookDetails['title'] . '<br>' . $bookDetails['publishername'] . '<br> 
    <span><button class="buy " id=' . $bookDetails['book_id'] . '>Buy</button></span>
    <span><button class="rent" id=' . $bookDetails['book_id'] . '>Rent</button></span>
    <span><div class="BuyError"></div></span>';
}
else{
    echo $bookDetails['title'] . '<br>' . $bookDetails['publishername'] . '<br> 
    <span><button class="requestBuy" id=' . $bookDetails['book_id'] . '>Request for Buy</button></span>
    <span><button class="requestRent" id=' . $bookDetails['book_id'] . '>Request for Rent</button></span>
    <span><div class="BuyError"></div></span>';
}
?>

