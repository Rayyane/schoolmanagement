<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::all();

        return view('admin.sessions.index', ['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:sessions', 'starts_from' => 'required', 'ends_to' => 'required']);
        $data = $request->only('name', 'starts_from', 'ends_to');
        $session = Session::create($data);
        //Session:flash('message', 'Area added');
        return redirect('/sessions')->with('message', 'session added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //$session = Session::all();
        return view('admin.sessions.show', ['session' => $session]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::find($id);

        return view('admin.sessions.edit', ['session' => $session]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $data = $request->only('name', 'starts_from', 'ends_to');
        $session->update($data);

        return redirect('/sessions')->with('message', 'Session updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::find($id);
        try {
            $session->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/sessions')->with('message', 'This session cannot be Deleted');
        }

        return redirect('/sessions')->with('message', 'Session Deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $session = new Session();

        return $session->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
