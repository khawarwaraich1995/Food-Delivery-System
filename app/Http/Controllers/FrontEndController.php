<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outlet;
use File;

class FrontEndController extends Controller
{
    public function index($domain)
    {
        if (!empty($domain)) {
            $outlet = Outlet::select('id', 'name', 'outlet_logo', 'fav_icon', 'email', 'address', 'phone')
                ->where(['url' => $domain, 'status' => 1])
                ->first();
            if ($outlet) {
                if (!empty($outlet->outlet_logo) && File::exists(public_path(ORIGNAL_IMAGE_PATH_OUTLET . $outlet->outlet_logo))) {
                    $outlet->outlet_logo = BASE_URL . MEDIUM_IMAGE_PATH_OUTLET . $outlet->outlet_logo;
                } else {
                    $outlet->outlet_logo = NO_IMAGE;
                }
                if (!empty($outlet->fav_icon) && File::exists(public_path(ORIGNAL_IMAGE_PATH_OUTLET . $outlet->fav_icon))) {
                    $outlet->fav_icon = BASE_URL . MEDIUM_IMAGE_PATH_OUTLET . $outlet->fav_icon;
                } else {
                    $outlet->fav_icon = NO_IMAGE;
                }
            } else {
                abort(419, 'You are not registered with us!');
            }
        }
        return view('app', compact('outlet'));
    }
}
