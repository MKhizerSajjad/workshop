<div id="suggestionModal" class="modal fade" tabindex="-1" aria-labelledby="suggestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('suggestion.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="suggestionModalLabel">Your Suggestion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="suggestion_for" class="col-form-label">Suggestion For</label>
                        <select id="suggestion_for" name="suggestion_for" class="form-select @error('first_name') is-invalid @enderror">
                            <option selected="">Choose...</option>
                            <option value="1">Dashboard</option>
                            <option value="2">AI Tools</option>
                            <option value="3">VPN</option>
                            <option value="4">Tools</option>
                            <option value="0">General</option>
                        </select>
                        @error('suggestion_for')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="suggestion_detail" class="col-form-label">Suggestion Detail</label>
                        <textarea id="suggestion_detail" name="suggestion_detail" class="form-control @error('first_name') is-invalid @enderror"></textarea>
                        @error('suggestion_detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
