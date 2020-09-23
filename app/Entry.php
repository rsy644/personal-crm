<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entries';
    protected $fillable = ['id', 'status', 'warmth', 'contact_id', 'created_at', 'updated_at'];

    public static function get_list_entries(){

        $entries = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->join('actions', 'stages.id', '=', 'actions.stage_id')->select('entries.id as entry_id', 'status', 'warmth', 'contacts.name as contact_name', 'contacts.telephone_number', 'companies.name as company_name', 'roles.name as role_name', 'stages.description as stage_description', 'actions.description')->get();

        $submissions = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->select('companies.name as company_name')->where('stages.description', '=', 'New Submission')->get();

        $review = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->select('companies.name as company_name')->where('stages.description', '=', 'In Review')->get();

        $interview = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->select('companies.name as company_name')->where('stages.description', '=', 'First Interview')->orwhere('stages.description', '=', 'Second Interview')->groupBy('company_name')->get();

        $background = DB::table('entries')->join('contacts', 'entries.contact_id', '=', 'contacts.id')->join('companies', 'contacts.id', '=', 'companies.contact_id')->join('roles', 'companies.id', '=', 'roles.company_id')->join('stages', 'roles.id', '=', 'stages.role_id')->select('companies.name as company_name')->where('stages.description', '=', 'Background Check')->get();

        return(['entries' => $entries, 'submissions' => $submissions, 'review' => $review, 'interview' => $interview, 'background' => $background]);
    }
}
