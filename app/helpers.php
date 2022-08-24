<?php
// get setting

use App\Models\GeneralSetting;

if (!function_exists('getSetting')) {
  function getSetting($key)
  {
    $setting = GeneralSetting::where('name', $key)->first();

    if ($setting) {
      if ($setting->value == 'true') {
        return true;
      } else if ($setting->value == 'false') {
        return false;
      } else if ($setting->value == 1) {
        return true;
      } else if ($setting->value == 0) {
        return true;
      } else {
        return $setting->value;
      }
    }

    return null;
  }
}
