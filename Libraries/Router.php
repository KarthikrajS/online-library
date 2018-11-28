<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 1/26/2017
 * Time: 7:25 PM
 */
class Router{

    private $core = Constants::DEFAULT_PAGE;
    private $action = Constants::DEFAULT_ACTION;
    private $args;

    //Returns the URL if set as an array
    private function parseUrl()
    {
        try
        {
            if(isset($_GET[Constants::GET_ARRAY_URL]))
            {
                $url = $_GET[Constants::GET_ARRAY_URL];

                //Remove the Additional Slashes and Separate the url
                return explode('/',filter_var(rtrim($url,'/')), FILTER_SANITIZE_URL);
            }
        }
        catch (Exception $e)
        {
            return null;
        }
    }

    public function __construct()
    {
        try{
            $url = $this->parseUrl();
            if(isset($url[0]))
            {
                //If url is AboutUs/JuralPolicies/KnowHow - just redirect
                $skipPages = array(strtolower(Constants::TERMS_CONDITIONS_PAGE),strtolower(Constants::KNOW_HOW_PAGE), strtolower(Constants::PRIVACY_PAGE), strtolower(Constants::POLICY_VERSIONS));
                if(in_array(strtolower($url[0]), $skipPages))
                {
                    require_once Core.$url[0].Constants::PHP_EXTENSION;
                    return;
                }

                if(file_exists(Core.$url[0].Constants::PHP_EXTENSION))
                {
                    $this->core = $url[0];
                    unset($url[0]);
                }
                else
                    // If the requested core doesnt exist - move to error file not found
                    $this->core = Constants::ERROR_PAGE;
            }

            // Include the class before creating an object for it
            require_once Core.$this->core.Constants::PHP_EXTENSION;
            $this->core = new $this->core;

            //Check if Action inside core exists
            if(isset($url[1]))
            {
                if(method_exists($this->core, $url[1]))
                {
                    $this->action = $url[1];
                    unset($url[1]);
                }
            }
            $this->args = $url ? array_values($url) : array();
            call_user_func_array(array($this->core, $this->action), $this->args);
        }catch (Exception $e){
            Utility::redirect(Constants::ERROR_PAGE);
        }
    }
}
?>