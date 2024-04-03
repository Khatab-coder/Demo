<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;

class CountryController extends Controller
{
    public function getCountries(Request $request)
    {
        $clientId = config('oauth.client_id');
        $clientSecret = config('oauth.client_secret');
        $redirectUri = config('oauth.redirect_uri');
        
        $provider = new GenericProvider([
            "clientId"               => $clientId,
            "clientSecret"           => $clientSecret,
            "redirectUri"            => $redirectUri,
            "urlAuthorize"           => config('oauth.authorize_url'),
            "urlAccessToken"         => config('oauth.access_token_url'),
        ]);
    }
}
