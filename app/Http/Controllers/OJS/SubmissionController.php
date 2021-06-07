<?php

namespace App\Http\Controllers\OJS;

use App\Http\Controllers\Controller;
use App\Models\Citation;
use App\Models\OJS\Publication;
use App\Models\OJS\Submission\Submission;
use App\Models\OJS\User;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{

    public function index()
    {
        $users = User::on('i-edu.uz')->with('settings')->paginate(100);
//        dd($publications);
        return view('ojs.authors.list', compact('users'));
    }

    public function showUser($login)
    {
        $user = User::on('i-edu.uz')->where('username', $login)->with('authors')->first();
        $publications = [];
        foreach ($user->authors as $author) {
            $publication = $author->publications->first();
            $publication->settingsList = $publication->getSettings();
            $publications[] = $publication;
        }

        return view('ojs.submissions.list', compact('user', 'publications'));
    }

    public function showPublication($id)
    {
        $publication = Publication::on('i-edu.uz')->where('publication_id', $id)->with('settings')->first();
        $settings = $publication->getSettings();

        $citations = $publication->searchCitations($publication->getTitles());
        return view('ojs.submissions.show', compact('publication', 'settings', 'citations'));
    }

    public function deleteCitation($id)
    {
        $citation = Citation::on('i-edu.uz')->where('citation_id', $id)->delete();

        return back();
    }
}
