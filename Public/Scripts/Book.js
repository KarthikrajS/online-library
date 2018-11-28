/**
 * Created by hp on 1/28/2017.
 */

$( document ).ready(function() {
    addToCart();
});

function addToCart(){
    $('.buy').click(function () {
        if(mySession.user){
            var jsonOb = {args:{action:phpConstants.CMN_AJAX_ADD_CART,param:{URL:window.location.href,type:'buy'}}};
            $.ajax({
                url: constants.UserAjaxURL,
                type: phpConstants.AJAX_POST,
                async: false,
                data: jsonOb,
                success: function (data) {
                    if($.trim(data)!= false){
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
});
    $('.rent').click(function () {
        if(mySession.user){
            var jsonOb = {args:{action:phpConstants.CMN_AJAX_ADD_CART,param:{URL:window.location.href,type:'rent'}}};
            $.ajax({
                url: constants.UserAjaxURL,
                type: phpConstants.AJAX_POST,
                async: false,
                data: jsonOb,
                success: function (data) {

                }
            });
        }
        else {
            setError('BuyError','Come on! Let\'s know whose that precious customer :)');
        }
    });
}
