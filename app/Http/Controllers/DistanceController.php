<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistanceController extends Controller
{

    public $officeLat;
    public $officeLong;

    public function __construct() {
        $this->officeLat = 53.3340285;
        $this->officeLong = -6.2535495;
    }

    public function index()
    {
        $path = storage_path('app/public/affiliates.txt');
        $affiliates = file($path);
        
        $guestList = array();
        
        foreach($affiliates as $affiliate) {
            $data = json_decode($affiliate);

            $lat1 = $data->latitude;
            $lon1 = $data->longitude;

            $lat2 = $this->officeLat;
            $lon2 = $this->officeLong;

            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $kilometers = $miles * 1.609344;
            
            if($kilometers <= 100) {
                $guestList[$data->affiliate_id] = array('id' => $data->affiliate_id, 'name' => $data->name, 'distance' => $kilometers);
            }
        }

        ksort($guestList);
        return view('guest_list', compact('guestList'));
    }

}
