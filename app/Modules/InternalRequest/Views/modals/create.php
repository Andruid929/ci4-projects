<div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="createRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRequestModalLabel">New Internal Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="createRequestForm" class="ajax-create-form" data-module="InternalRequest" data-route="internal-requests">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="request_type">Request Type</label>
                        <select class="form-control" name="request_type" id="request_type" required>
                            <option value="career_advancement">Career Advancement</option>
                            <option value="compensation">Compensation</option>
                            <option value="operational">Operational</option>
                            <option value="administrative">Administrative</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" maxlength="30" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
