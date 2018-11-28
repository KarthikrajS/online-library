<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 7:38 PM
 */
class Constants{

    const APP_ENV = 'DEV'; //DEV or PRD

    //Corebase
    const DESIGN_PAGE_EXT = "Design.php";

    //Pages
    const DEFAULT_DIRECTORY = '/';
    const DEFAULT_PAGE = "BooksHome";
    const TERMS_CONDITIONS_PAGE = "TermsConditions";
    const KNOW_HOW_PAGE = "KnowHow";
    const PRIVACY_PAGE = "Privacy";
    const POLICY_VERSIONS = "PolicyVersions";
    const ERROR_PAGE = "LightUperror";
    const URL_STORES_SHOW = 'book/';

    //URL's
    const LIBRARY_PAGE  = '/Librarys';
    const ABOUT_PAGE    = '/about';
    const CONTACT_PAGE  = '/contact';
    const CART_PAGE = '/cart';
    const TEAM_PAGE     = '/team';
    const LOGIN_PAGE = "/login";
    const URL_FEEDBACK='/feedback';


    //Ajax Receivers
    const POST_ARGS_PARAM = "args";

    const AJAX_ACTION = "action";
    const AJAX_PARAM = "param";
    const AJAX_POST = "POST";

    //Common Classes
    const CONSTANTS_CLASS= 'Constants';

    //Common Ajax Receivers
    const CMN_AJAX_FN_GETCONSTANTS = 'GetConstants';
    const CMN_AJAX_ADD_CART = 'addCart';
    const CMN_AJAX_LOAD_CART = 'loadCart';


    //Login
    const PASSWORD_MAX_LENGTH = 8;
    const PARAM_PASSWORD = 'password';
    const PARAM_USERNAME='username';


    //Programming Constants
    const STR_NULL = "null";
    const STR_EMPTY = "";
    const STR_VALID = 'Valid';
    const STR_INVALID = 'Invalid';

    //Router
    const DEFAULT_ACTION = "index";
    const PHP_EXTENSION = ".php";
    const GET_ARRAY_URL = "url";

    //Session
    const SESSION_USER = "user";
    const SESSION_USERPOST = "userpost";
    const SESSION_CITY = "usercity";
    const SESSION_LASTUPDATETIME="lastupdatetime";
    const SESSION_ISUPDATESUCCESS = "isupdatesuccess";
    const SESSION_DISPLAYMESSGE = "displaymessage";
    const SESSION_LANDINGPAGE = "landingpage";
    const SESSION_SHOW_INTRO_BANNER = "showintrobanner";
    const SESSION_SHOW_PLAY_STORE_PROMPT= "showplaystoreprompt";
    const SESSION_TEMP_MAIL='Temp_mail';
    const SESSION_STOREHOME_DATA_OFFSET = "bookhome_data_offset";
    Const SESSION_CITY_ID = "sessionCityId";
    const SESSION_FEED_TO_LOAD = "FeedLoadedForMonth";
    const SESSION_DEFAULT_TIMEZONE = 'Asia/Kolkata';
    const SESSION_USER_TIMEZONE = 'User_TimeZone';

    const USERPOST_LAT = "lat";
    const USERPOST_LNG = "lng";
    const USERPOST_CITY = "city";
    const USERPOST_COUNTRY = "country";


    const EM_INVALID_CREDENTIALS='Burrrppp... Invalid credentials.';
    const EM_GENERAL_ERROR = "We fell and we fell hard. Can you try just once more?";

    //search
    const SEARCH_QUERY = "query";

    //User
    const DB_USER_TABLE = "user";
    const DB_USER_COL_USERID = "userId";
    const DB_USER_COL_EMAILID = "email";
    const DB_USER_COL_FIRSTNAME = 'fName';
    const DB_USER_COL_LASTNAME = 'lName';
    const DB_USER_COL_MOBILENUMBER = "phone";
    const DB_USER_COL_GENDER = "gender";
    const DB_USER_COL_PASSWORD= 'Password';
    const DB_USER_COL_ADMIN ='admin';


    //User Ajax Receivers
    const USER_AJAX_FN_RESET='reset';
    const USER_AJAX_FN_ISEMAILREGISTERED="isEmailRegistered";
    const USER_AJAX_FN_VERIFY_USER="VerifyUser";
    const USER_AJAX_FN_GETSESSIONOBJECTS = "GetSessionObjcets";
    const USER_AJAX_FN_LOGOUT="Logout";

}
?>