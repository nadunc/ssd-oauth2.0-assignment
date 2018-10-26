<?php

class OAuth
{
    private $CLIENT_ID = "1804269406330276";
    private $CLIENT_SECRET = "7ef6905ab9d2c0c60845d494f9f90102";
    private $RESPONSE_TYPE = "code";
    private $GRANT_TYPE = "authorization_code";
//    private $PERMISSIONS = "id,first_name,last_name,picture";
    private $PERMISSIONS = "id,first_name,last_name,name";
//    private $SCOPE = "default";

    private $AUTHORIZATION_ENDPOINT = "https://www.facebook.com/v3.2/dialog/oauth";
    private $TOKEN_ENDPOINT = "https://graph.facebook.com/v3.2/oauth/access_token";
    private $RESOURCE_ENDPOINT = "https://graph.facebook.com/me";

    private $REDIRECT_URI = "http://localhost/oauth/callback.php";

    public function getAuthorizationEndpointURI()
    {
//        return $this->AUTHORIZATION_ENDPOINT."?client_id=$this->CLIENT_ID&redirect_uri=$this->REDIRECT_URI&scope=$this->SCOPE&response_type=$this->RESPONSE_TYPE";
        return $this->AUTHORIZATION_ENDPOINT . "?client_id=$this->CLIENT_ID&redirect_uri=$this->REDIRECT_URI&response_type=$this->RESPONSE_TYPE";
    }


//    public function getTokenEndpointURI($authorization_code)
//    {
//        return $this->TOKEN_ENDPOINT . "?client_id=$this->CLIENT_ID&redirect_uri=$this->REDIRECT_URI&client_secret=$this->CLIENT_SECRET&code=$authorization_code";
//    }


    public function requestAccessToken($authorization_code)
    {

        $data = array(
            'client_id' => $this->CLIENT_ID,
            'client_secret' => $this->CLIENT_SECRET,
            'redirect_uri' => $this->REDIRECT_URI,
            'code' => $authorization_code,
            'grant_type' => $this->GRANT_TYPE
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($this->TOKEN_ENDPOINT, false, $context);

        $json = json_decode($result, true);
        return $json['access_token'];
    }


    public function requestProfileInfo($access_token)
    {
//        $uri = $this->RESOURCE_ENDPOINT."?fields=$this->PERMISSIONS&access_token=$access_token";
//
//        $result = file_get_contents($uri);
//        $json = json_decode($result, true);


        $data = array(
            'fields' => $this->PERMISSIONS,
            'access_token' => $access_token
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($this->RESOURCE_ENDPOINT, false, $context);

        $json = json_decode($result, true);

        return $json;


    }
}