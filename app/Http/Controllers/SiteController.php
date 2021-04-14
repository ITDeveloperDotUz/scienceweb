<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DBConnection;
use App\Models\OJS\Journal;
use App\Models\Partner;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{



    public function home()
    {
//        dd(auth()->guard('publisher')->check());
//        dd(auth()->guard()->check());
        $submissions = Submission::all();
        return view('pages.home', ['hideTop' => true, 'submissions' => $submissions]);
    }

    public function journals()
    {
        $journalsCollection = [];
        $databases = DBConnection::all();
        foreach ($databases as $database) {
            $model = new Journal;
            $journalsCollection[] = $model->setConnection($database->name)->where('enabled', 1)->get();
        }

        $categories = Category::with('details')->get();
        return view('pages.journals', ['journalsCollection' => $journalsCollection, 'categories' => $categories]);
    }

    public function publishers()
    {
        $publishers = Partner::all();
        return view('pages.partners', ['publishers' => $publishers]);
    }

    public function contacts()
    {
        return view('pages.pages.contacts');
    }
}
