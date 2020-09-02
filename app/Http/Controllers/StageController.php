<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Company;
use App\Role;
use App\Stage;
use Illuminate\Http\Request;

use DB;

class StageController extends Controller
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
    public function create($contact_id, $company_id, $role_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $company = Company::findOrFail($company_id);
        $role = Role::findOrFail($role_id);
        return view('stages.create')->with(['contact' => $contact, 'company' => $company, 'role' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stage = new Stage();
        $stage->description = $request->stage;
        if($request->role == ""){
            return view('stages.create')->with('error', 'Please make sure a role is entered before setting up a stage');
        } else {
            $contact = Contact::findOrFail($request->contact);
            $company = Company::findOrFail($request->company);
            $role = DB::table('roles')->where('id', '=', $request->role)->get();

            $stage->role_id = $role[0]->id;
        }
        $stage->feedback = $request->feedback;
        $stage->save();

        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' =>$statuses, 'contact' => $contact, 'company' => $company, 'role' => $role[0], 'stage' => $stage, 'thermos' => $thermos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit($stage_name, $entry_id)
    {
        $stage = DB::table('stages')->where('description', '=', $stage_name)->get();

        if($stage[0]->role_id != null){
            $role = DB::table('roles')->where('id', '=', $stage[0]->role_id)->select('name')->get();
            return view('stages.edit')->with(['role' => $role[0], 'stage' => $stage[0], 'entry_id' => $entry_id]);
        } else {
            return view('stages.edit')->with(['role' => $role, 'entry_id' => $entry_id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_id, $company_id, $role_id, $stage_id)
    {
        $contact = Contact::findOrFail($contact_id);
        $company = Company::findOrFail($company_id);
        $role = Role::findOrFail($role_id);
        $stage = Stage::findOrFail($stage_id)->delete();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'contact' => $contact, 'company' => $company, 'role' => $role, 'thermos' => $thermos, 'delete_stage' => true]);
    }
}
