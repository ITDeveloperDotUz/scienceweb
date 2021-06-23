<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScopusProfile extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'first_name', 'last_name', 'orcid', 'institution',
        'h_index', 'email', 'documents_count', 'co_authors', 'cited_by_count', 'citations_count',
        'author_id', 'subject_areas', 'chart', 'publications'
    ];

    public function getChart()
    {
        $chart = json_decode($this->chart, true);
        $chart_data = [];
        for($i = 0; $i <= $chart['xAxisHigh'] - $chart['xAxisLow']; $i++){
            if (isset($chart['docObj'][$i])){
                $year = (string) $chart['docObj'][$i]['x'];
                if (isset($chart_data[$year])){
                    $chart_data[$year][0] = $chart['docObj'][$i]['y'];
                } else {
                    $chart_data[$year] = [$chart['docObj'][$i]['y'], 0];
                }
            }

            if (isset($chart['citeObj'][$i])){
                $year = $chart['citeObj'][$i]['x'];
                if (isset($chart_data[$year])){
                    $chart_data[$year][1] = $chart['citeObj'][$i]['y'];
                } else {
                    $chart_data[$year] = [0, $chart['citeObj'][$i]['y']];
                }
            }
        }
        ksort($chart_data);
        return $chart_data;
    }


}
