@extends('layouts.main')

@section('content')

<div class="container">
    <a class="btn btn-success add-button" href="{{ route('entries.create') }}">Add an Entry</a>
    <br/>
    <br/>
    <table class="crm-entries">
        <tr>
            <th>Status</th>
            <th>Warmth</th>
            <th>Name</th>
            <th>Number</th>
            <th>Company</th>
            <th>Role</th>
            <th>Stage</th>
            <th>Action Required</th>
            <th></th>
            <th></th>
        </tr>
        @foreach($entries as $entry)
        <tr>
            <td>{{ $entry->status }}</td>  
            @if($entry->warmth == 'Cold')
                <td class="cold">{{ $entry->warmth }}</td>
            @elseif($entry->warmth == 'Warm')
                <td class="warm">{{ $entry->warmth }}</td>
            @elseif($entry->warmth == 'Hot')
                <td class="hot">{{ $entry->warmth }}</td>
            @elseif($entry->warmth == 'Smokin')
                <td class="smokin">{{ $entry->warmth }}</td>
            @endif
            <td>{{ $entry->contact_name }}</td>
            <td>{{ $entry->telephone_number }}</td>
            <td>{{ $entry->company_name }}</td>
            <td>{{ $entry->role_name }}</td>
            <td>{{ $entry->stage_description }}</td>
            <td>{{ $entry->description }}</td>
            <td class="button"><a class="btn btn-success" href="{{route('entries.edit', $entry->entry_id) }}" id="edit-button" value="Edit">Edit</a></td>
            <td><a class="btn btn-danger" id="delete-button" value="Delete" href="{{route('entries.destroy', $entry->entry_id) }}">Delete</a></td>
        </tr>
        @endforeach
    </table>
</div>



@endsection