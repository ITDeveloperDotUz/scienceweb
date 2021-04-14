<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale', 'slug', 'link', 'type', 'start_date', 'end_date', 'submissions_deadline', 'event_date',
        'lat', 'long', 'location', 'year', 'month', 'abbrev', 'user_id', 'category_id', 'section_id'
    ];

    protected $dates = ['start_date', 'end_date', 'submissions_deadline', 'event_date', 'created_at', 'updated_at'];

    public function details()
    {
        return $this->hasMany(ResourceDetail::class, 'parent_id')->where('table', $this->table);
    }

    public function localizedDetails($locale = false)
    {
        if (!$locale) $locale = app()->getLocale();
        $default = $this->details->where('locale', $this->locale);

        $details = count($this->details->where('locale', $locale)) > 0 ? $this->details->where('locale', $locale) : $default;

        $details->flags = [];

        foreach ($details as $detail) {
            if ($detail->value != null){
                $details->{$detail->key} = $detail->value;
            } else {
                $details->{$detail->key} = $default->where('key', $detail->key)->first()->value;
                $details->flags[$detail->key] = $this->locale;
            }
        }

        return $details;
    }

    public function allLocalizedDetails()
    {
        $details = [];
        foreach ($this->details as $detail){
            $details[$detail->locale] = isset($details[$detail->locale]) ? $details[$detail->locale] : [];
            $details[$detail->locale][$detail->key] = $detail->value;
        }
        return $details;
    }
}
