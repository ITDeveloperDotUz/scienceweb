<?php

namespace App\Models\OJS;

use App\Models\DBConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;
    public $database = '';
    protected $connection = '';
    protected $table = 'journals';

    public function settings(){
        return $this->hasMany(JournalSetting::class, 'journal_id', 'journal_id');
    }

    public function locSettings($locale, $settings)
    {
        $data = [];
        foreach ($settings as $item) {
            if ($item->locale == $locale or $item->locale == ''){
                $data[$item->setting_name] = $item->setting_value;
            }
        }
        return $data;
    }

    public function setConnection($name)
    {
        $this->database = $name;
        $this->connection = $name;
        return $this;
    }
}
