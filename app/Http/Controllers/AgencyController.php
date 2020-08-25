<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;
use App\Contact;

use Redirect;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:agencies', 'max:255']
        ]);
        $agency = new Agency();

        $agency->name = $request->name;
        $agency->save();




        return view('contacts.create')->with(['agency' => $agency]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit($agency_id, $contact_id, $entry_id)
    {
        $agency = Agency::findOrFail($agency_id);
        return view('agencies.edit')->with(['agency' => $agency, 'contact_id' => $contact_id, 'entry_id' => $entry_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $agency_id, $contact_id, $entry_id)
    {
        $agency = Agency::findOrFail($agency_id);
        $contact = Contact::findOrFail($contact_id);
        $agency->name = $request->name;
        $agency->save();
        return view('contacts.edit')->with(['agency' => $agency, 'contact' => $contact, 'entry_id' => $entry_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($agency)
    {
        dd('deleting');
    }
}
