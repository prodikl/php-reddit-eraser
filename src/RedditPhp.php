<?php
/**
 * Created by PhpStorm.
 * User: KeithDesktop
 * Date: 9/20/2017
 * Time: 8:21 PM
 */

class RedditPhp extends reddit {

    /**
     * Checks whether the client is authorized using the given redirect url.
     * Returns TRUE if authorized and FALSE if not authorized.
     *
     * @param string $redirectUrl               The callback URL to use
     *
     * @return bool                             Whether or not we're logged in or not
     */
    public function isAuthorized(string $redirectUrl) {
        if(array_key_exists("code", $_GET)){
            $_SESSION['oauth'] = $_GET['code'];
        }

        if(array_key_exists('oauth', $_SESSION)){
            $this->setOAuthToken($_SESSION['oauth'], $this->getLoginUrl($redirectUrl));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Forwards the app to the reddit login / auth page.
     *
     * @param string $callbackUrl               The callback URL to use
     */
    public function login(string $callbackUrl) {
        $url = $this->getLoginUrl($callbackUrl, 'edit mysubreddits read save subscribe');
        header("Location:" . $url);
    }
}