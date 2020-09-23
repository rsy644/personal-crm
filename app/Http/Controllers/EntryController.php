<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use DB;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Entry::get_list_entries();

        return view('entries.index')->with(['entries' => $results['entries'], 'submissions' => $results['submissions'],
        'review' => $results['review'], 'interview' => $results['interview'], 'background' => $results['background']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
        session_destroy();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'thermos' => $thermos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->update == "Y"){
            $entry = Entry::findOrFail($request->entry_id);
        } else {
            $entry = new Entry();
        }
        $entry->status = $request->input('status');
        $entry->warmth = $request->input('warmth');
        if($request->contact == ""){
            return view('entries.create')->with('error', 'Please make sure a contact is entered before setting up an entry');
        } else {
            
            if($request->update == "Y"){
               $contact = DB::table('contacts')->where('name', '=', $request->contact)->get('id')[0];
            } else {
               $contact = DB::table('contacts')->where('id', '=', $request->contact)->get('id')[0]; 
            }

            $entry->contact_id = $contact->id;
        }
        $entry->save();

        $results = Entry::get_list_entries();

        return view('entries.index')->with(['entries' => $results['entries'], 'submissions' => $results['submissions'], 'review' => $results['review'], 'interview' => $results['interview'], 'background' => $results['background']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit($entry_id)
    {
        $entry = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->join('actions', 'stages.id', '=', 'actions.stage_id')->select('entries.id as entry_id', 'status', 'contacts.id as contact_id', 'contacts.name as contact_name', 'contacts.telephone_number', 'companies.id as company_id', 'companies.name as company_name', 'roles.id as role_id', 'roles.name as role_name', 'stages.id as stage_id', 'stages.description as stage_description', 'actions.description')->where('entries.id', '=', $entry_id)->get();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.edit')->with(['entry' => $entry[0], 'statuses' => $statuses, 'thermos' => $thermos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $entry_id)
    {
        $entry = Entry::findOrFail($entry_id);
        $entry->status = $request->input('status');
        $entry->warmth = $request->input('warmth');
        if($request->contact == ""){
            return view('entries.create')->with('error', 'Please make sure a contact is entered before setting up an entry');
        } else {
            $contact_id = DB::table('contacts')->where('name', '=', $request->contact)->get('id')[0];
            $entry->contact_id = $contact_id->id;
        }
        $entry->save();
        return view('home')->with('success', 'Entry was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy($entry_id)
    {
        $entry = Entry::findOrFail($entry_id)->delete();

        $results = Entry::get_list_entries();

        return view('entries.index')->with(['entries' => $results['entries'], 'submissions' => $results['submissions'], 'review' => $results['review'], 'interview' => $results['interview'], 'background' => $results['background']]);
    }    
}
