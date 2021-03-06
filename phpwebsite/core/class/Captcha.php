<?php
/**
 * Small class that assists in loading CAPTCHA routines
 *
 * @version $Id: Captcha.php 7359 2010-03-16 20:51:34Z matt $
 * @author Matthew McNaney <mcnaney at gmail dot com>
 */

if (!defined('CAPTCHA_NAME')) {
    define('CAPTCHA_NAME', '');
}

class Captcha {

    public function get()
    {
        $dirname = 'captcha/' . CAPTCHA_NAME . '/';

        if (is_dir('javascript/' . $dirname)) {
            return javascript($dirname);
        } else {
            return null;
        }
    }

    public function verify($return_value=false)
    {
        $file = 'javascript/captcha/' . CAPTCHA_NAME . '/verify.php';

        if (!is_file($file)) {
            return true;
        }

        include $file;

        if (!function_exists('verify')) {
            return false;
        }

        return verify($return_value);
    }

    public function isGD()
    {
        return extension_loaded('gd');
    }

}
?>