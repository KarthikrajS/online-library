<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2/4/2017
 * Time: 7:31 AM
 */
if(!isset($_SESSION))
{
    session_start();
}
?>
<?php
class Cart extends CoreBase
{
    protected function addStyleAndScript()
    {
        try {

            $this->pageStyle = '<link href="Public/CSS/Cart.css" rel="stylesheet" />';
            $this->pageScript = '<script type="text/javascript" src="Public/Scripts/Cart.js" ></script>';

        } catch (Exception $e) {
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
    public function index($paramType = null, $paramVal = null)
    {
        $cartDetails['booksToLoad'] = CartModel::buildcartCardHTML();
        $this->showPage($cartDetails);
    }
}
?>
