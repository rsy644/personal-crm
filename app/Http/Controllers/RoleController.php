<?php

namespace App\Http\Controllers;

use App\Role;
use App\Contact;
use App\Company;
use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
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
    public function create($contact_id, $company_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $company = Company::findOrFail($company_id);
        return view('roles.create')->with(['contact' => $contact, 'company' => $company]);
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
            $role = Role::findOrFail($request->role_id);
            $action = "Updating";
        } else {
            $role = new Role();
            $action = "Creating";
        }

        $role->name = $request->role;

        if($request->company == ""){
            return view('roles.create')->with('error', 'Please make sure a company is entered before setting up a role');
        } else {
            $contact = DB::table('contacts')->where('id', '=', $request->contact)->get();
            $company = DB::table('companies')->where('id', '=', $request->company)->get();                  
            $role->company_id = $company[0]->id;

        }

        $role->save();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];

        if($action == "Updating"){

            $entry = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->join('actions', 'stages.id', '=', 'actions.stage_id')->select('entries.id as entry_id', 'status', 'contacts.name as contact_name', 'contacts.telephone_number', 'companies.name as company_name', 'roles.name as role_name', 'stages.description as stage_description', 'actions.description')->where('entries.id', '=', $request->entry_id)->get();
            return view('entries.edit')->with(['statuses' => $statuses, 'contact' => $contact[0], 'company' => $company[0], 'role' => $role, 'entry' => $entry[0], 'thermos' => $thermos]);
        } else {
            return view('entries.create')->with(['statuses' => $statuses, 'contact' => $contact[0], 'company' => $company[0], 'role' => $role, 'thermos' => $thermos]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($role_name, $entry_id)
    {
        $role = DB::table('roles')->where('name', '=', $role_name)->get();
        if($role[0]->company_id != null){
            $company = DB::table('companies')->where('id', '=', $role[0]->company_id)->select('name')->get();
            return view('roles.edit')->with(['role' => $role[0], 'company' => $company, 'entry_id' => $entry_id]);
        } else {
            return view('roles.edit')->with(['role' => $role, 'entry_id' => $entry_id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id, $company_id, $role_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $company = Company::findOrFail($company_id);
        $role = Role::findOrFail($role_id)->delete();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'contact' => $contact, 'company' => $company, 'thermos' => $thermos, 'delete_role' => true]);
    }
}
