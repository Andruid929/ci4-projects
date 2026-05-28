<div class="modal fade" id="editRequestModal" tabindex="-1" role="dialog" aria-labelledby="editRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRequestModalLabel">Edit Internal Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="editRequestForm" class="ajax-edit-form" data-module="InternalRequest" data-route="internal-requests">
                <input type="hidden" name="id" id="edit_request_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_request_type">Request Type</label>
                        <select class="form-control" name="request_type" id="edit_request_type" required>
                            <option value="career_advancement">Career Advancement</option>
                            <option value="compensation">Compensation</option>
                            <option value="operational">Operational</option>
                            <option value="administrative">Administrative</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_subject">Subject</label>
                        <input type="text" class="form-control" name="subject" id="edit_subject" maxlength="30" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" name="description" id="edit_description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
