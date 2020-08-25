<?php

namespace Tests\Feature;

use App\Action;
use App\Agency;
use App\Company;
use App\Contact;
use App\Entry;
use App\Role;
use App\Stage;
use App\User;
use BadFunctionCallException;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EntryTest extends TestCase
{
	public function __construct($name = null, array $data = [], $dataName = '')
	{
		parent::refreshApplication();

		$this->app->boot();

		parent::__construct($name, $data, $dataName);
	}

	// test for a new entry
	public function testEntry():
		void 
	{
		DB::connection(env('
			DB_CONNECTION'))->
			beginTransaction();

		try {
			$agency = Agency::create([
				'id' => rand(0, 1000),
				'name' => 'Harold Brigson'
			]);
			$contact = Contact::create([
				'id' => rand(0, 1000),
				'name' => 'Peter Brooks',
				'telephone_number' => 7429311000,
				'agency_id' => $agency->id
			]);
			$entry = Entry::create([
				'id' => rand(0, 1000),
				'status' => 'Open',
				'warmth' => 'Warm',
				'contact_id' => $contact->id,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]);
			$this->assertEquals('Open', $entry->status);
            $this->assertEquals('Warm', $entry->warmth);  
		} finally {
			DB::connection(env('
				DB_CONNECTION'))->
				rollBack();
		}
	}
}