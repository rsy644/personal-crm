<?php

namespace App\Http\Controllers;

use App\Action;
use App\Contact;
use App\Company;
use App\Role;
use App\Stage;
use Illuminate\Http\Request;

use DB;

class ActionController extends Controller
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
    public function create($contact_id, $company_id, $role_id, $stage_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $company = Company::findOrFail($company_id);
        $role = Role::findOrFail($role_id);
        $stage = Stage::findOrFail($stage_id);
        return view('actions.create')->with(['contact' => $contact, 'company' => $company, 'role' => $role, 'stage' => $stage]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = new Action();
        $action->description = $request->action;
        if($request->stage == ""){
            return view('actions.create')->with('error', 'Please make sure a stage is entered before setting up an action');
        } else {
            $contact = Contact::findOrFail($request->contact);
            $company = Company::findOrFail($request->company);
            $role = Role::findOrFail($request->role);
            $stage = Stage::findOrFail($request->stage);
            $action->stage_id = $stage->id;
        }
        $action->save();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['contact' => $contact, 'company' => $company, 'role' => $role, 'stage' => $stage, 'action' => $action, 'statuses' => $statuses, 'thermos' => $thermos]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit($contact_id, $company_id, $role_id, $stage_id, $description)
    {

        return view('actions.edit')->with(['contact_id' => $contact_id, 'company_id' => $company_id, 'role_id' => $role_id, 'stage_id' => $stage_id, 'description' => $description]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id, $company_id, $role_id, $stage_id, $action_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $company = Company::findOrFail($company_id);
        $role = Role::findOrFail($role_id);
        $stage = Stage::findOrFail($stage_id);
        $action = Action::findOrFail($action_id)->delete();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'contact' => $contact, 'company' => $company, 'role' => $role, 'stage' => $stage, 'thermos' => $thermos, 'delete_action' => true]);
    }
}
