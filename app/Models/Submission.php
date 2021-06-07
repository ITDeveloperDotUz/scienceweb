<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['submitted_at', 'issued_at', 'published_at', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['doi', 'submitted_at', 'issued_at', 'published_at', 'status', 'locale', 'file', 'preview', 'thumb', 'category_id', 'section_id', 'user_id'];


    public function citationMetaTags()
    {
        $prefix = 'citation_';
        $authors = [];
        $tags = [];
        if(!$this->author->profile->public_name){
            $authors[] = $this->author->first_name . ' ' . $this->author->last_name;
        } else {
            $authors[] = $this->author->profile->public_name;
        }
        foreach ($this->coauthors as $coauthor) {
            if ($coauthor->profile){
                if (!$coauthor->profile->public_name){
                    $authors[] = $coauthor->first_name . ' ' . $coauthor->last_name;
                } else {
                    $authors[] = $coauthor->public_name;
                }
            } else {
                $authors[] = $coauthor->first_name . ' ' . $coauthor->last_name;
            }
        }
        foreach ($authors as $author){
            $tags[] = mt($prefix.'author', $author);
        }

        foreach ($this->allLocalizedDetails() as $detail => $val) {
            if ($val['title']){
                $tags[] = mt($prefix . 'title', $val['title'], ['xml:lang' => $detail]);
            }
            if ($val['abstract']) {
                $tags[] = mt($prefix . 'abstract', $val['abstract'], ['xml:lang' => $detail]);
            }
            if ($val['keywords']) {
                $tags[] = mt($prefix . 'keywords', $val['keywords'], ['xml:lang' => $detail]);
            }
            if ($val['publisher']) {
                $tags[] = mt($prefix . 'publisher', $val['publisher'], ['xml:lang' => $detail]);
            }
        }
        $tags[] = mt($prefix.'abstract_html_url', route('publication.show', $this->id));
        $tags[] = mt($prefix.'public_url', route('publication.show', $this->id));
        $tags[] = mt($prefix.'language', $this->locale);
        $tags[] = mt($prefix.'pdf_url', url($this->file));
        $tags[] = mt($prefix.'journal_title', '');
        $tags[] = mt($prefix.'journal_abbrev', '');
        $tags[] = mt($prefix.'issn', '');
        $tags[] = mt($prefix.'doi', $this->doi);
        $tags[] = mt($prefix.'date', $this->published_at->format('Y/m/d'));
        $tags[] = mt($prefix.'year', $this->published_at->format('Y'));
        $tags[] = mt($prefix.'firstpage', 1);
        $tags[] = mt($prefix.'lastpage', 10);
        $tags[] = mt($prefix.'price', 0);

//        foreach ($this->allLocalizedDetails()){
//
//        }
//        foreach ()
//
//
//        <meta name="citation_journal_abbrev" content="SWOAJ">
//    <meta name="citation_issn" content="0000-0000">
//    <meta name="citation_author" content="{{ $publication->author->profile->public_name }}">
//    <meta name="citation_title" content="{{ $details->title }}">
//    <meta name="citation_date" content="{{ $publication->created_at->format('Y/m/d') }}">
//    <meta name="citation_abstract_html_url" content="{{ route('publication.show', $publication->id) }}">
//    <meta name="citation_language" content="{{ $publication->locale }}">
//    <meta name="citation_pdf_url" content="{{ url($publication->file) }}">

        return $tags;
    }

    public function dcMetaTags()
    {
        $prefix = 'DC.';
        $tags = [];
        $authors = [];
        if(!$this->author->profile->public_name){
            $authors[] = $this->author->first_name . ' ' . $this->author->last_name;
        } else {
            $authors[] = $this->author->profile->public_name;
        }
        foreach ($this->coauthors as $coauthor) {
            if ($coauthor->profile){
                if (!$coauthor->profile->public_name){
                    $authors[] = $coauthor->first_name . ' ' . $coauthor->last_name;
                } else {
                    $authors[] = $coauthor->public_name;
                }
            } else {
                $authors[] = $coauthor->first_name . ' ' . $coauthor->last_name;
            }
        }
        foreach ($authors as $author){
            $tags[] = mt($prefix.'Creator.PersonalName', $author);
        }
        $tags[] = mt($prefix.'created', $this->created_at->format('Y-m-d'));
        $tags[] = mt($prefix.'dateSubmitted', $this->submitted_at->format('Y-m-d'));
        $tags[] = mt($prefix.'issued', $this->published_at->format('Y-m-d'));
        $tags[] = mt($prefix.'modified', $this->updated_at->format('Y-m-d'));
        $tags[] = mt($prefix.'Format', 'application/pdf', ['scheme' => 'IMT']);
        $tags[] = mt($prefix.'Identifier', $this->id);
        $tags[] = mt($prefix.'Identifier.URI', route('publication.show', $this->id));
        $tags[] = mt($prefix.'Language', $this->locale, ['schema' => 'ISO639-1']);
        $tags[] = mt($prefix.'Rights', $this->localizedDetails($this->locale)->publisher);
        $tags[] = mt($prefix.'Publisher', $this->localizedDetails($this->locale)->publisher);
        $tags[] = mt($prefix.'Source', 'Journal name');
        $tags[] = mt($prefix.'Source.ISSN', '0000-0000');
        $tags[] = mt($prefix.'Source.URI', route('publication.show', $this->id));
        $tags[] = mt($prefix.'Type', 'Text.Serial.Journal');
        $tags[] = mt($prefix.'Type.articleType', 'article');

//        $tags[] = mt($prefix.'bibliographicCitation', route('publication.show', $this->id));

        foreach ($this->allLocalizedDetails() as $detail => $val) {
            if ($val['title']){
                if ($detail == $this->locale){
                    $tags[] = mt($prefix.'Title', $val['title']);
                } else {
                    $tags[] = mt($prefix.'Title.Alternative', $val['title'], ['xml:lang' => $detail]);
                }
            }
            if ($val['abstract']) {
                $tags[] = mt($prefix . 'Abstract', $val['abstract'], ['xml:lang' => $detail]);
                $tags[] = mt($prefix . 'Description', $val['abstract'], ['xml:lang' => $detail]);
            }
            foreach (explode(',', $val['keywords']) as $kw) {
                $tags[] = mt($prefix . 'Subject', $kw, ['xml:lang' => $detail]);
            }
        }

        return $tags;
    }

    public function details()
    {
        return $this->hasMany(SubmissionDetail::class, 'submission_id');
    }

    public function coauthors()
    {
        return $this->belongsToMany(Coauthor::class, 'authors_submissions', 'submission_id', 'author_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function references()
    {
        return $this->hasMany(Citation::class, 'submission_id');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'keywords_submissions', 'submission_id', 'keyword_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function localizedDetails($locale = false)
    {
        if (!$locale) $locale = app()->getLocale();
        $default = $this->details->where('locale', $this->locale);
        $details = $this->details->where('locale', $locale);

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

    public function scopePublished($query){
        return $query->where('status', 1);
    }
}
