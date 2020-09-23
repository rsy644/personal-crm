@extends('layouts.main')

@section('content')

<div class="container">
    <a class="btn btn-success add-button" href="{{ route('entries.create') }}">Add an Entry</a>
    <br/>
    <br/>
    @if(count($entries) == 0)

        <h1 style="text-align: center; margin-left: 90px;">Welcome</h1>

        <p style="text-align: center;">Please add an entry using the link above</p>


    @else
        <div class="tile-row">
            <div class="tile-counter">
                <h2>New Submissions</h2>
                <span>{{ count($submissions) == 0 ? '-' : count($submissions) }}</span>
            </div>
            <div class="tile-counter">
                <h2>In Review</h2>
                <span>{{ count($review) == 0 ? '-' : count($review) }}</span>
            </div>
            <div class="tile-counter">
                <h2>At Interview</h2>
                <span>{{ count($interview) == 0 ? '-' : count($interview) }}</span>
            </div>
            <div class="tile-counter">
                <h2>Background Check</h2>
                <span>{{ count($background) == 0 ? '-' : count($background) }}</span>
            </div>
        </div>

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
                <td><a class="btn btn-danger" data-toggle="modal" data-target="#delete_modal_<?php echo $entry->entry_id; ?>" data-model="<?php echo $entry->entry_id; ?>" id="delete-button" value="Delete">Delete</a></td>
                <div class="modal fade" id="delete_modal_<?php echo $entry->entry_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">          
                                <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete entry '<?php echo $entry->company_name; ?>'?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" href="{{route('entries.destroy', $entry->entry_id) }}" data-val="{{ $entry->entry_id }}" class="delete_button btn btn-success">Yes</button>
                                <button type="button" class="btn btn-primary">No</button>
                            </div>
                        </div>
                    </div>
                </div>
           
            </tr>
            @endforeach
        </table>
    @endif
</div>



@endsection