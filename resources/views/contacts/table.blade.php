<div class="table-responsive-sm">
    <table class="table table-striped" id="contacts-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>File</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contacts)
            <tr>
                <td>{{ $contacts->name }}</td>
            <td>{{ $contacts->email }}</td>
            <td>{{ $contacts->phone }}</td>
            <td>{{ $contacts->message }}</td>
            <td><a href="{{ route('contacts.show', [$contacts->id]) }}" class='btn btn-ghost-success'><i class="fa fa-file"></i></a></td>
                <td>
                    {!! Form::open(['route' => ['contacts.destroy', $contacts->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('contacts.edit', [$contacts->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
