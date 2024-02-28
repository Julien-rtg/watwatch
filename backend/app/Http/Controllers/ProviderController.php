<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $wanted_providers = [
            'Disney Plus', 'Netflix', 'Amazon Prime Video',
            'Apple TV Plus', 'Apple TV', 'Crunchyroll', 'Canal+', 'OCS Go', 'Google Play Movies', 'Sixplay',
            'Orange VOD', 'France TV', 'Arte', 'Microsoft Store', 'YouTube', 'YouTube Premium', 'FILMO',
            'Rakuten TV', 'Amazon Video', 'BrutX Amazon Channel', 'Universal+ Amazon Channel', 'Molotov TV'
        ];
        $providers = Provider::all();
        $providersReturned = [];
        foreach ($providers as $provider) {
            if(in_array($provider->provider_name, $wanted_providers)){
                $providersReturned[] = $provider;
            }
        }
        return $providersReturned;
    }
}
