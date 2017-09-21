<?php
/**
 * Created by PhpStorm.
 * User: KeithDesktop
 * Date: 9/20/2017
 * Time: 8:21 PM
 */

class RedditPhp extends reddit {

    const deleteMessage = "[deleted]";

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
            $token = $this->getOAuthToken($_REQUEST['code'],$redirectUrl);

            $matches = [];
            preg_match('/"access_token": *"([^"]*)"/', $token, $matches);
            $accessToken = $matches[1];

            $matches = [];
            preg_match('/"refresh_token": *"([^"]*)"/', $token, $matches);
            $refreshToken = $matches[1];

            $_SESSION['accessToken'] = $accessToken;
            $_SESSION['refreshToken'] = $refreshToken;

            $this->setOAuthToken($accessToken);
            return true;
        } else if(array_key_exists("accessToken", $_SESSION)) {
            $accessToken = $_SESSION['accessToken'];
            $this->setOAuthToken($accessToken);
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
        $url = $this->getLoginUrl($callbackUrl, 'edit mysubreddits read save subscribe history');
        header("Location:" . $url);
    }
}