/**
 * Created by hp on 1/26/2017.
 */


var constants = {
    'emailValid': /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    'addressValid': /^[a-zA-Z0-9 -#,]*$/,
    'alphanumericValid':/^[a-zA-Z0-9]*$/,
    'alphanumericwithspace':/^[a-zA-Z0-9\s]*$/,
    'handleValid':/^[a-zA-Z0-9_]*$/,
    'websiteValid':/^[a-zA-Z0-9\-\.]+\.(com|org|net|mil|edu|COM|ORG|NET|MIL|EDU|in|IN|uk|UK|sa|SA|uk|UK)$/,
    'lettersValid': /^[a-zA-Z]+$/,
    'letterswithspace':/^[a-zA-Z\s]*$/,
    'numericValid' : /^[0-9]+$/,
    'nonEmptyValid':/^(?!\s*$).+/,
    'mobileValid': /^[+][0-9 -]+$/,
    'monthValid': /(^[January]{7}$|^[February]{8}$|^[March]{5}$|^[April]{5}$|^[May]{3}$|^[June]{4}$|^[July]{4}$|^[August]{6}$|^[September]{9}$|^[October]{7}$|^[November]{8}$|^[December]{8}$)/g,
    'latitudeValid':/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,8}/,
    'longitudeValid':/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}/,
    'StorePartials':'Libraries/StorePartialTemplates.html',
    'UserPartials': 'Libraries/UserPartialTemplates.html',
    'UserAjaxURL':'libraries/UserAjaxReceivers.php',
    'CommonAjaxURL':'libraries/ajaxReceivers.php',
    'StoreAjaxURL':'libraries/StoreAjaxReceivers.php',
    'BrandAjaxURL':'libraries/BrandAjaxReceivers.php',
    'baseURL':window.location.protocol+"//"+window.location.host+"/"
};


var phpConstants = getConstants();
var mySession = getSession();

function popLogin(e)
{
    var key = e.keyCode || e.charCode;

    if( key == 27)
    {
        closePop();
    }
    $("span#loginSpan").trigger('click');
    e.preventDefault();
}

function getConstants() {
    var myConstants = null;
    var jsonOb = {args:{action:'GetConstants'}};
    $.ajax({
        url:constants.CommonAjaxURL,
        type: "POST",
        async: false,
        data: jsonOb,
        success:function(data) {
            myConstants = $.parseJSON(data);
        },
        error:function(jqXHR,textStatus){
            console.log(textStatus);
        }
    });
    return myConstants
}

function showAjaxSuccess(msg)
{
    $('#UserMessage').empty().append(msg).addClass('Success').fadeTo(0,1);
    $('#UserMessage').delay(2000).fadeTo(400, 0,function(){$('#UserMessage').empty().removeClass('Success');});
}

function showAjaxError(errMsg, data)
{
    $('#UserMessage').empty().append(errMsg).addClass('Error').fadeTo(0,1);
    $('#UserMessage').delay(2000).fadeTo(400, 0, function(){$('#UserMessage').empty().removeClass('Error');});

    if (phpConstants.APP_ENV == 'DEV') {
        console.log(data);
    }
}
function getSession()
{
    var mySession = null;
    var jsonOb = {args:{action:phpConstants.USER_AJAX_FN_GETSESSIONOBJECTS}};
    $.ajax({
        url:constants.UserAjaxURL,
        type: phpConstants.AJAX_POST,
        async: false,
        data: jsonOb,
        success:function(data) {
            console.log(data);
            mySession = $.parseJSON(data);
        },
        error:function(jqXHR,textStatus){
            console.log(textStatus);
        }
    });
    return mySession;
}


function logAndExit(exception) {
    if (phpConstants.APP_ENV == 'DEV') {
        console.log(exception);
    }
    redirectError();
}

function setEmailError(elementName, emailExists)
{
    if (emailExists) {
        removeError(elementName);
    }
    else{
        setError(elementName,phpConstants.EM_INVALID_USERNAME);
    }
}
//Validates the element with the value  and the regular expression - For Textboxes
function validateElementValue(elementName, elementValue, matchExp, error)
{
    if(elementValue!=undefined) {
        elementValue = elementValue.trim(); //Regular Expressions do not check for empty strings
        if (elementValue != '' && elementValue.match(matchExp)) {
            //No error
            removeError(elementName);
            return true;
        }
        else {
            setError(elementName, error);
            return false;
        }
    }
    else{
        return false;
    }
}

/*Business Commons*/
function DoesEmailExist(emailToCheck) {
    var valueToReturn = false;
    var jsonOb = {args:{action:phpConstants.USER_AJAX_FN_ISEMAILREGISTERED,param:emailToCheck}};
    $.ajax({
        url:constants.UserAjaxURL,
        type: phpConstants.AJAX_POST,
        async:false,
        data: jsonOb,
        success:function(data) {
            if ($.trim(data)==phpConstants.STR_VALID) {
                valueToReturn = true; // Mail already exusts
            }
            else
                valueToReturn = false;
        },
        error:function(jqXHR,textStatus){
            console.log(textStatus);
            valueToReturn = false;
        }
    });
    return valueToReturn;
}

function verifyUser(emailVal, passwordVal)
{
    var valueToReturn = false;
    var jsonOb = {args:{action:phpConstants.USER_AJAX_FN_VERIFY_USER,param:{username:emailVal,password:passwordVal}}};
    $.ajax({
        url:constants.UserAjaxURL,
        type: phpConstants.AJAX_POST,
        async:false,
        data: jsonOb,
        success:function(data) {
            //alert($.trim(data));
            if ($.trim(data)=="1"){
                var windowPath = window.location.href;
                var pageURL = windowPath.toUpperCase().replace(constants.baseURL.toUpperCase(),"");
                if (pageURL == phpConstants.LOGIN_PAGE.toUpperCase()) {
                    if (mySession.landingpage.toUpperCase() == phpConstants.ERROR_PAGE.toUpperCase()) {
                        window.location.href = phpConstants.DEFAULT_PAGE;
                    }
                    else{
                        window.location.href = mySession.landingpage;
                    }
                }
                else{
                    location.reload();
                }
            }
            else{
                setError('general',phpConstants.EM_INVALID_CREDENTIALS);
            }
        },
        error:function(jqXHR,textStatus){
            console.log(textStatus);
        }
    });
    console.log(valueToReturn);
}
function setError(elementName, errorMessage)
{
    if (errorMessage && errorMessage.trim() != '') {
        $('.'+elementName).html(errorMessage).removeClass('ErrorOff');
        $('.'+elementName).addClass('ErrorOn');
    }
    $('#'+elementName).removeClass('textBoxNative').addClass('textBoxError');
}
function removeError(elementName) {
    $('.'+elementName).removeClass('ErrorOn').addClass('ErrorOff');
    $('#'+elementName).removeClass('textBoxError').addClass('textBoxNative');
}


function validateLoginPage() {
    $('#dialog input').on('keydown',function (e) {
        var key = e.keyCode || e.charCode;
        if(key == 13){
            $('#btnLogin').trigger('click');
        }
    });

    $('input').blur(function() {
        var elementName = $(this).attr('name');
        var elementValue= $(this).val().trim();
        console.log(elementValue + " "+elementName);
        var errMsg;
        var fieldValid;
        if ($(this).attr('type')=="password") {
            if (elementName == 'txtPassword') {
                if ($(this).val().length >= parseInt(phpConstants.PASSWORD_MAX_LENGTH)) {
                    //No error
                    removeError(elementName);
                    fieldValid =  true;
                }
                else
                {
                    setError(elementName,phpConstants.STR_EMPTY);
                    fieldValid =  false;
                }
            }
        }
        else if($(this).attr('type')=="text" ){
            if (elementName == 'txtEmail') {
                errMsg = phpConstants.STR_EMPTY;
                fieldValid = elementValue.match(constants.emailValid);
                if (!fieldValid) {
                    setError(elementName,errMsg);
                }
                else{//If email is a valid field - then check if it exists
                    removeError(elementName);
                    var isExists = DoesEmailExist(elementValue);
                    setEmailError(elementName, isExists);
                }
            }
        }
    });

    $('#btnLogin').click(function(){
            var isFieldValid = true;
        var emailVal = $('#txtEmail').val();
        var passwordVal = $('#txtPassword').val();

        var emailValid = validateElementValue($('#txtEmail').attr('name'), emailVal, constants.emailValid, phpConstants.STR_EMPTY);

        if (emailValid) {
            var isEmaiLRegistered = DoesEmailExist(emailVal);
            console.log('DEE '+isEmaiLRegistered);
            setEmailError($('#txtEmail').attr('name'), isEmaiLRegistered);
            isFieldValid = isFieldValid & isEmaiLRegistered;
        }

        if (passwordVal == '' || passwordVal.length < 8) {
            setError($('#txtPassword').attr('name'),phpConstants.STR_EMPTY);
            isFieldValid = isFieldValid & false;
        }

        if (isFieldValid) {
            verifyUser(emailVal, passwordVal);
        }
        else{
            setError('general',phpConstants.EM_INVALID_CREDENTIALS);
        }
    });
}