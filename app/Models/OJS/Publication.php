<?php

namespace App\Models\OJS;

use App\Models\OJS\Submission\Submission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    public function settings()
    {
        return $this->setConnection('i-edu.uz')->hasMany(PublicationSetting::class, 'publication_id', 'publication_id');
    }

    public function citations()
    {
        return $this->setConnection('i-edu.uz')->hasMany(Citation::class, 'publication_id', 'publication_id');
    }

    public function submission()
    {
        return $this->setConnection('i-edu.uz')->hasOne(Submission::class, 'current_publication_id', 'submission_id');
    }
    public function getSettings()
    {
        $settings = [];
        foreach ($this->settings as $setting) {
            if ($setting->locale != ''){
                if (!isset($settings[$setting->locale])) $settings[$setting->locale] = [];
                $settings[$setting->locale][$setting->setting_name] = $setting->setting_value;
            }
        }
        return $settings;
    }

    public function getTitles()
    {
        $titles = [];
        foreach ($this->getSettings() as $setting) {
            if (isset($setting['title']) and $setting['title'] != '') {
                $titles[] = $setting['title'];
            }
        }
        return $titles;
    }

    public function searchCitations($titles)
    {
        $citationsList = [];
        foreach ($titles as $title) {
            $citations = Citation::on('i-edu.uz')->where('raw_citation', 'like', '%'. $title .'%')->with('publication')->get();
            foreach ($citations as $citation) {
                $citationsList[] = [
                    'titles' => $citation->publication->getTitles(),
                    'citation' => $citation->raw_citation,
                    'citation_id' => $citation->citation_id,
                    'publication_id' => $citation->publication_id,
                ];
            }

        }
        return $citationsList;
    }
}
