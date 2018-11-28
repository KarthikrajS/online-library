/**
 * Created by hp on 1/26/2017.
 */
$( document ).ready(function() {

    topRightSetup();
    popperSetup();
    dropdown();
        $("#logout").click(function(){
            Logout();
        });


});

jQuery.fn.center = function () {
    var screenWidth = document.body.clientWidth;
    var elementWidth = $(this).width();
    var screenHeight = document.body.clientHeight;
    var elementHeight = $(this).height();

    if(elementHeight > 0) {
        if (elementHeight > (screenHeight * 0.80)) {
            elementSpace = "10%";
            $('div#ipopContainer').css({overflow: 'auto'});
        }
        else {
            //Idea is small div no scroll
            elementSpace = (screenHeight - elementHeight) / 2 + "px";
            $('div#ipopContainer').css({overflow: 'hidden'});
        }
        this.css({"top": elementSpace, "left": "50%", "margin-bottom": elementSpace});
        this.css({"transform": "translateX(-50%) translateZ(0)"});
    }
    else{
        this.css({"top": "50%", "left": "50%" });
        this.css({"transform": "translate(-50%, -50%) translateZ(0)"});
    }
    this.css({'opacity': 1,'filter': 'alpha(opacity=100)'});
    return this;
}

function dropdown(){

    $("span#UserSpan").click(function(){

    if(!$('#userboard').is(':visible'))
    {
        $("#userboardpointer").show(300);
        $("#userboard").slideDown(300);
    }
    else
    {
        $("#userboardpointer").hide(300);
        $("#userboard").slideUp(300);
    }
});

    $(document).mouseup(function (e) {
        var container = $("#userboard");
        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $("#userboardpointer").hide(300);
            $("#userboard").slideUp(300);
        }
    });
}

function popperSetup() {

    $(".poplauncher").click(function () {
        openPop();
    });
    $("#ipopContainer").click(function(e){
        var container = $("div.ipop");
        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            //Check if this is not from a date-picker - and is not the net or prev button inside date-picker header
            //Only this is causing problems as of now
            if (!$(e.target).is('.ui-datepicker') && $(e.target).parents('.ui-datepicker-header').length === 0) {
                closePop();
            }
        }
    });
}
function topRightSetup()
{
    $("span#loginSpan").click(function(){
        $('#popcontent').load(constants.UserPartials + "#LoginPageContent", function(){
            validateLoginPage();
        });
    });
}

function openPop()
{
    $('body').css({overflow:'hidden'});
    $.when($(".ipop, #ipopContainer, #overlay").fadeIn('300')).done( function() {
        $(".ipop, #ipopContainer, #overlay").removeClass('PopHide');
        $(".ipop, #ipopContainer, #overlay").addClass('PopVisible');
        $("div.ipop").center();
    });
    $(document).keydown(function(e) {
        if (e.keyCode == 27) {
            closePop();
        }
    });
}

function closePop(){
    $(".ipop, #ipopContainer, #overlay").fadeOut(300, function() {
        $('#popcontent').empty();
        $('div.ipop').removeAttr("style");
        $(".ipop, #ipopContainer, #overlay").removeClass('PopVisible').addClass('PopHide');
    });
    $('body').css({overflow:'auto'});
}



function Logout() {
    var jsonOb = {args:{action:phpConstants.USER_AJAX_FN_LOGOUT}};
    $.ajax({
        url:constants.UserAjaxURL,
        type: phpConstants.AJAX_POST,
        async: false,
        data: jsonOb,
        success:function(data) {
            if ($.trim(data)==phpConstants.STR_VALID) {
                window.location.href=phpConstants.DEFAULT_PAGE;
            }
            else
            {
                showAjaxError(phpConstants.EM_GENERAL_ERROR,data);
            }
        },
        error:function(jqXHR,textStatus){
            showAjaxError(phpConstants.EM_GENERAL_ERROR, "error--"+textStatus);
        }
    });
}