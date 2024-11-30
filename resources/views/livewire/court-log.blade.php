<div>
    <table class="table table-bordered table-hover mb-0">
        <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Comment</th>
            <th>User</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @if($courtlogs->total() > 0)
            @foreach($courtlogs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->activity }}</td>
                    <td>{{ $log->comment }}</td>
                    <td>{{ $log->users->full_name }}</td>
                    <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach

        @else
            <tr>
                <td colspan="5" class="text-center text-muted">No logs found for this will.</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="mt-3">
        {{ $courtlogs->links() }}
    </div>
</div>
