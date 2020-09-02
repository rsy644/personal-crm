<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Entry;

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
        if($request->update == "Y"){

            $contact = Contact::findOrFail($request->contact_id);
            $action = "Updating";
        } else {
            $contact = new Contact();
            $action = "Creating";

        }

        $contact->name = $request->contact;
        $contact->telephone_number = $request->telephone;
        if(isset($request->agency_id)){           
            $contact->agency_id = $request->agency_id;
        }
        $contact->save();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        if($action == "Updating"){

            $entry = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->join('actions', 'stages.id', '=', 'actions.stage_id')->select('entries.id as entry_id', 'status', 'contacts.name as contact_name', 'contacts.telephone_number', 'companies.name as company_name', 'roles.name as role_name', 'stages.description as stage_description', 'actions.description')->where('entries.id', '=', $request->entry_id)->get();
            return view('entries.edit')->with(['thermos' => $thermos, 'contact' => $contact, 'entry' => $entry[0], 'statuses' => $statuses]);
        } else {
            return view('entries.create')->with(['thermos' => $thermos, 'contact' => $contact, 'statuses' => $statuses]);
        }
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
            return view('contacts.edit')->with(['contact' => $contact, 'agency' => $agency, 'entry_id' => $entry_id]);
        } else {
           return view('contacts.edit')->with(['contact' => $contact, 'entry_id' => $entry_id]); 
        }
        
            
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
    public function destroy($type)
    {
        dd($type);
        $return_array = array();

        foreach($schema as $key => $id){
            if($key == 'contact'){
                $contact = Contact::findOrFail($id)->delete();
            }
            if($key == 'company'){
                $company = Company::findOrFail($id);
                $return_array['company'] = $company;
            }
            if($key == 'role'){
                $role = Role::findOrFail($id);
                $return_array['role'] = $role;
            }
            if($key == 'stage'){
                $stage = Stage::findOrFail($id);
                $return_array['stage'] = $stage;
            }
            if($key == 'action'){
                $action = Action::findOrFail($id);
                $return_array['action'] = $action; 
            }
        }

        dd($return_array);
        
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'thermos' => $thermos, 'delete_contact' => true]);
    }
}
