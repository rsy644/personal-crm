<?php

namespace App\Http\Controllers;

use App\Company;
use App\Contact;
use Illuminate\Http\Request;
use DB;

class CompanyController extends Controller
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
    public function create($contact_id)
    {
        $contact = Contact::findOrFail($contact_id);
        return view('companies.create')->with('contact', $contact);
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
            $company = Company::findOrFail($request->company_id);
            $action = "Updating";
        } else {
            $company = new Company();
            $action = "Creating";
        }
        if($request->contact == ""){
            return view('companies.create')->with('error', 'Please make sure a contact is entered before setting up a company');
        } else {
            $contact = DB::table('contacts')->where('id', '=', $request->contact)->get();

            $company->contact_id = $contact[0]->id;

        }
        
        $company->name = $request->company;
        $company->town = $request->{'company-town'};
        $company->postcode = $request->{'company-postcode'};
        $company->type = $request->{'company-type'};
        $company->save();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        
        if($action == 'Updating'){

            $entry = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->join('actions', 'stages.id', '=', 'actions.stage_id')->select('entries.id as entry_id', 'status', 'contacts.id as contact_id', 'contacts.name as contact_name', 'contacts.telephone_number', 'companies.id as company_id', 'companies.name as company_name', 'roles.name as role_name', 'stages.description as stage_description', 'actions.description')->where('entries.id', '=', $request->entry_id)->get();
            return view('entries.edit')->with(['company' => $company, 'contact' => $contact[0], 'entry' => $entry[0], 'statuses' => $statuses, 'thermos' => $thermos]);
            
        } else {

            return view('entries.create')->with(['company' => $company, 'contact' => $contact[0], 'statuses' => $statuses, 'thermos' => $thermos]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($company_name, $entry_id)
    {
        $company = DB::table('companies')->where('name', '=', $company_name)->select('id')->get();

        $company_id = $company[0]->id;
        $company = Company::findOrFail($company_id);

        if($company->contact_id != null){
            $contact = DB::table('contacts')->where('id', '=', $company->contact_id)->select('name')->get();
            return view('companies.edit')->with(['company' => $company, 'contact' => $contact, 'entry_id' => $entry_id]);
        } else {
           return view('companies.edit')->with(['company' => $company, 'entry_id' => $entry_id]); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($schemas, $type)
    {
        $contact = Contact::findOrFail($contact_id);        

        $company = Company::findOrFail($company_id)->delete();
        
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'contact' => $contact, 'thermos' => $thermos, 'delete_company' => true]);
    }
}
