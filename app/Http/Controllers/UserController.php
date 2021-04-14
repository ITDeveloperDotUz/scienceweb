<?php

namespace App\Http\Controllers;

use App\Providers\GoogleScholarProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        auth()->user()->update($request->input());

        return redirect()->route('profile.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload_avatar(Request $request)
    {
        $filename = auth()->user()->id .'-'. uniqid() . '.' . $request->file('avatar')->extension();
        $request->file('avatar')->storeAs('public/avatars', $filename);

        auth()->user()->profile()->update(['avatar' => 'storage/avatars/' . $filename]);

        return back();
    }
}
