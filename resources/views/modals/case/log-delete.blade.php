<!-- Delete Log Modal -->
<div class="modal fade" id="deleteLogModal" tabindex="-1"
    aria-labelledby="deleteLogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLogModalLabel">Delete Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="deleteLogForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to <b>Delete</b> this log?</p>
                    {{-- <textarea class="form-control" readonly>{{ $log->log }}</textarea> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete log</button>
                </div>
            </form>
        </div>
    </div>
</div>
