<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'parent', 'status'];

    public function details()
    {
        return $this->hasMany(ResourceDetail::class, 'parent_id')->where('table', $this->table);
    }

    public function localizedDetails($locale = false)
    {
        if (!$locale) $locale = app()->getLocale();
        $details = $this->details->where('locale', $locale);

        foreach ($details as $detail) {
            $details->{$detail->key} = $detail->value;
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
