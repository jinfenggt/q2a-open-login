<?php
/* !
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
/**
 * Yahoo OAuth Class
 *
 * @package             HybridAuth providers package
 * @author              Lukasz Koprowski <azram19@gmail.com>
 * @version             0.2
 * @license             BSD License
 */
/**
 * Hybrid_Providers_Yahoo - Yahoo provider adapter based on OAuth1 protocol
 */
class Hybrid_Providers_Agora extends Hybrid_Provider_Model_OAuth2 {
	public $scope = "read";
	/**
	 * {@inheritdoc}
	 */
	function initialize() {
		parent::initialize();

    // Provider api end-points
		$this->api->api_base_url = 'https://oauth.agoralab.co/api/';
		$this->api->authorize_url = 'https://oauth.agoralab.co/oauth/authorize';
		$this->api->token_url = 'https://oauth.agoralab.co/oauth/token';
		$this->api->curl_header = array("Authorization: Bearer " . $this->api->access_token);
		//$this->api->curl_header = array("Content-Type:application/x-www-form-urlencoded");
		//$this->api->curl_authenticate_method = "GET";
	}
	/**
	 * {@inheritdoc}
	 */
	function getUserProfile() {
    $data = $this->api->get("userInfo");

		#$data = $response->profile;
		$this->user->profile->identifier = (property_exists($data, 'email')) ? $data->email : "";
		$this->user->profile->firstName = (property_exists($data, 'displayName')) ? $data->displayName : "";
		$this->user->profile->lastName = (property_exists($data, 'displayName')) ? $data->displayName : "";
		$this->user->profile->displayName = (property_exists($data, 'displayName')) ? trim($data->displayName) : "";

		return $this->user->profile;
	}

}