<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 7:22 PM
 */
define("DS", DIRECTORY_SEPARATOR);

define("ROOT","..\\");

//Constants for Folders Inside Application
define("Application","Application".DS);
define("Core",Application."Core".DS);
define("Designs",Application."Designs".DS);
define("Commons",Application."Commons".DS);

//Constants for Folders inside Libraries
define("Libraries",ROOT."Libraries".DS);

//Constants for Folders inside Public
define("PublicFolder",ROOT."Public".DS);
define("Images",PublicFolder."Images".DS);
define("Scripts",PublicFolder."Scripts".DS);
define("CSS",PublicFolder."CSS".DS);
?>