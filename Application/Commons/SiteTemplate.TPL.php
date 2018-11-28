<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 7:41 PM
 */

?>
<html>
<head>
    <?php
    if(isset($pageTitle) && !Utility::stringEmpty($pageTitle))
        echo "<title>".$pageTitle."</title>";
    else
        echo "<title>Light Up - Best stop to Share and Gain Knowledge </title>";
    ?>
    <title>Light Up - Best stop to Share and Gain Knowledge </title>
    <meta name="description" content="Light Up is a simple, light and easy way of Knowledge Sharing platform.With Light Up  you can search less and Gain more." />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo "http://".$_SERVER['HTTP_HOST'].Constants::DEFAULT_DIRECTORY; ?>">
    <link href="Public/CSS/Master.css" rel="stylesheet" />
    <?php echo $pageStyle; ?>
        <script type="text/javascript" src="Public/Scripts/jquery-1.11.1.min.js" ></script>
        <script type="text/javascript" src="Public/Scripts/jquery-ui.js" ></script>
        <script type="text/javascript" src="Public/Scripts/MasterClientScript.js"></script>
        <script type="text/javascript" src="Public/Scripts/Libraries.js"></script>
    <?php echo $pageScript; ?>

</head>
<body>
<?php
$user= null; $name = null; $profileHTML = null;
if(isset($_SESSION[Constants::SESSION_USER])&& !empty($_SESSION[Constants::SESSION_USER]))
{

    if(!empty($_SESSION['user']))
    {$user = $_SESSION['user'];}
if($user != null){
    $Userinitials = strtoupper($user->FirstName.'.'.$user->LastName);
        $name ="Howdy,".     $user->FirstName ." ".$user->LastName;
}
else{
    $UserInitials = Constants::STR_EMPTY;
}
    $profile =($user->isAdmin == 1) ?"Admin Profile" : "Profile" ;
    $profileHTML ='<div class="borderBottom" id="userProfile">'.$profile.'</div> ';
}
?>
<div id="Header">
    <section  title="Home" class="left" id="Logo">
        <div><a id="headLogo" href="<?php echo Constants::DEFAULT_DIRECTORY; ?>"><img class="round" src="Public/Images/headlogo"'  alt="Light Up" style="width:0%; height:100%; padding: 0; border-radius:50%; vertical-align: super;"></a> </div>
<!--        <div id="coName">Light Up</div>-->
    </section>
    <section class="left">
        <form>
            <input class="sb-search-input" placeholder="Enter your search term..." type="search" value="" name="search" id="search">
            <div class="sb-search-submit" type="submit" value=""/>
            <span class="sb-icon-search"></span>
        </form>
    </section>

    <section class="right" id="headerRight">

        <span id="Options"><a href="<?php echo Constants::LIBRARY_PAGE?>">Library</a></span>
        <span id="Options"><a href="<?php echo Constants::ABOUT_PAGE?>">About</a></span>
<!--        <span id="Options"><a href  ="--><?php //echo Constants::TEAM_PAGE?><!--">Team</a></span>-->
        <span id="Options"><a href="<?php echo Constants::CONTACT_PAGE?>">Contact</a></span>
        <span id="Options"><a href="<?php echo Constants::CART_PAGE?>">Cart</a></span>
        <?php

                            if(!is_null($user)){
                                $displayHTML ='<span id = "UserSpan"><a id="loginSpan" class=" dropdownLauncher curvedBox"  >';
                                echo $displayHTML.$name.'</a></span>';
                            }

                            else {
                                echo '<span id="loginSpan" class="poplauncher"><a class="page-scroll poplauncher curvedBox" >Login</a></span>';
                            }
                            echo '<span id="userDropdown">
                                    <div id="noteboard" class=" borderLeft"></div>
                                    <div id="userboardpointer"></div>
                                    <div id="userboard" class="borderBottom borderLeft">
                                    '.$profileHTML.'
                                    <div class="borderBottom" id="logout">Logout</div>
                                </div>
                                </span>';
                        ?>
    </section>
</div>
<div id="Content">
        <?php require_once $content;?>

</div>
<div id="Footer">
    <a href="TermsConditions">Terms and Conditions | </a><a href="Privacy">Privacy Policy</a>
    <div><a href="<?php echo Constants::URL_FEEDBACK?>">Feedback</a></div>
    <div >&copy; 2017 Copyrighted by Light Up Inc.,</div>
</div>
</html>












<div id="overlay" class="VisibilityOff"></div>
<div id="ipopContainer" class="VisibilityOff content animated fadeInDown">
    <div id="some" class="ipop VisibilityOff">
        <div id="popcontent" class="curvedBox"></div>
    </div>
</div>