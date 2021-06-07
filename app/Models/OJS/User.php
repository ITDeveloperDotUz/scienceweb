<?php

namespace App\Models\OJS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function settings()
    {
        return $this->setConnection('i-edu.uz')->hasMany(UserSetting::class, 'user_id', 'user_id');
    }

    public function localizedSettings()
    {
        $settings = [];

        foreach ($this->settings as $setting) {
            if (!isset($settings[$setting->locale])) $settings[$setting->locale] = [];

            $settings[$setting->locale][$setting->setting_name] = $setting->setting_value;
        }

        return $settings;
    }

    public function authors()
    {
        return $this->setConnection('i-edu.uz')->hasMany(Author::class, 'email', 'email')->with('publications');
    }


}
