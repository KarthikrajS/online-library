/**
 * Created by hp on 2/4/2017.
 */

$( document ).ready(function() {
    // alert('cart');
    // loadCart();
});

function loadCart()
{
    if(mySession.user){
        var jsonOb = {args:{action:phpConstants.CMN_AJAX_LOAD_CART}};
        $.ajax({
            url: constants.UserAjaxURL,
            type: phpConstants.AJAX_POST,
            async: false,
            data: jsonOb,
            success: function (data) {
                if($.trim(data)!= false){
                    console.log(data);
                    showAjaxSuccess('success');
                }
                else {
                    showAjaxError(phpConstants.EM_GENERAL_ERROR,data)
                }
            }
        });
    }
    else {
        setError('BuyError','Come on! Let\'s know whose that precious customer :)');
    }
}