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
        @if($docketlogs->total() > 0)
            @foreach($docketlogs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->activity }}</td>
                    <td>{{ $log->comment }}</td>
                    <td>{{ $log->users->full_name }}</td>
                    <td>{{ getCustomLocalTime($log->created_at) }}</td>
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
        {{ $docketlogs->links() }}
    </div>
</div>
