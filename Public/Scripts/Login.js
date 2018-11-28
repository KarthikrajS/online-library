/**
 * Created by hp on 1/26/2017.
 */
$(document).ready(function(e){
    dropdown();
    try{
        //$('#loginSpan, #AddBusiness, #loginSpanMobile, #AddBusinessMobile').remove();
        $('#loginSpan, #Options').remove();
        $('#lpageContent').load(constants.UserPartials +" #LoginPageContent", function(){
            validateLoginPage();
        });
    }
    catch(err){
        logAndExit(err);
    }


});
