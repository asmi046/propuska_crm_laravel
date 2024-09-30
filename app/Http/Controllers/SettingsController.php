<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function send_api_meaasge_get(Request $request) {
        $setting = Settings::where('name', 'send_api_meaasge')->first();
        if (!$setting) return ['send_api_meaasge' => true];
        $result = ($setting->value === "1")?true:false;
        return ['send_api_meaasge' => $result];
    }

    public function send_api_meaasge_set(Request $request, $value) {
        $setting = Settings::where('name', 'send_api_meaasge')->first();
        if (!$setting)
            Settings::create([
                'name' => 'send_api_meaasge',
                'value' => ($value === 'true')?"1":"0"
            ]);
        else
            $setting->update([
                'value' => ($value === 'true')?"1":"0"
            ]);

        return ['send_api_meaasge' => $value];
    }
}
