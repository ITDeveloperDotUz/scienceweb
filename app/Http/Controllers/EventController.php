<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user,publisher')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($type = null)
    {
        if ($type){
            $events = Event::where('type', $type)
                ->andWhere('start_date', '>', date('Y-m-d H:i:s'))
                ->orderBy('start_date', 'asc')
                ->with('details')
                ->paginate(30);
        } else {
            $events = Event::where('start_date', '>', date('Y-m-d H:i:s'))
                ->orderBy('start_date', 'asc')
                ->with('details')
                ->paginate(30);
        }
        $categories = Category::where('type', 'events')->with('details')->get();

        return view('events.index', compact('events', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create($type = null)
    {
        $categories = Category::where('type', 'events')->with('details')->get();
        return view('events.form', compact('categories'));
    }

    public function createConference()
    {
        $categories = Category::where('type', 'events')->with('details')->get();
        return view('events.conference_form', compact('categories'));
    }

    public function createJournal()
    {
        $categories = Category::where('type', 'events')->with('details')->get();
        return view('events.journal_form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return
     */
    public function show(Event $event)
    {
        dd(
            $event
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
