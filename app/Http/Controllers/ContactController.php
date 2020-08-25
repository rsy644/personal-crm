<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use Redirect;

use DB;

class ContactController extends Controller
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
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->contact;
        $contact->telephone_number = $request->telephone;
        if(isset($request->agency_name)){
            $agency = DB::table('agencies')->where('name', '=', $request->agency_name)->get();
            $contact->agency_id = $agency[0]->id;
        }
        $contact->save();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['thermos' => $thermos, 'statuses' => $statuses]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($contact_name, $entry_id)
    {
        $contact = DB::table('contacts')->where('name', '=', $contact_name)->select('id')->get();
        $contact_id = $contact[0]->id;
        $contact = Contact::findOrFail($contact_id);
        if($contact->agency_id != null){
            $agency = DB::table('agencies')->where('id', '=', $contact->agency_id)->select('name')->get();

        }
        
        return view('contacts.edit')->with(['contact' => $contact, 'agency' => $agency, 'entry_id' => $entry_id]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact)
    {
        $contact_id = DB::table('contacts')->where('name', '=', $contact)->get('id')[0];
        $contact = Contact::findOrFail($contact_id->id)->delete();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'thermos' => $thermos, 'delete_contact' => true]);
    }
}
