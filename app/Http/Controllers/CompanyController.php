<?php

namespace App\Http\Controllers;

use App\Company;
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
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company();
        if($request->contact == ""){
            return view('companies.create')->with('error', 'Please make sure a contact is entered before setting up a company');
        } else {
            $contact = DB::table('contacts')->where('name', '=', $request->contact)->get();
            $company->contact_id = $contact[0]->id;
        }
        $company->name = $request->company;
        $company->town = $request->{'company-town'};
        $company->postcode = $request->{'company-postcode'};
        $company->type = $request->{'company-type'};
        $company->save();
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['company' => $company, 'statuses' => $statuses, 'thermos' => $thermos]);
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
    public function edit(Company $company)
    {
        //
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
    public function destroy($company)
    {
        if(isset(DB::table('companies')->where('name', '=', $company)->get('id')[0])){
            $company_id = DB::table('companies')->where('name', '=', $company)->get('id')[0];

            $company = Company::findOrFail($company_id->id)->delete();
        }
        $statuses = ['Open', 'Closed', 'On Hold', 'Waiting For An Update'];
        $thermos = ['Cold', 'Warm', 'Hot', 'Smokin'];
        return view('entries.create')->with(['statuses' => $statuses, 'thermos' => $thermos, 'delete_company' => true]);
    }
}
