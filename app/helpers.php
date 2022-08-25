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

// get random color
if (!function_exists('getRandomColor')) {
  function getRandomColor()
  {
    $colors = [
      'green',
      'red',
      'cyan',
      'indigo',
      'pink',
      'orange',
    ];
    return $colors[rand(0, count($colors) - 1)];
  }
}
