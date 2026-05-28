<div class="modal fade" id="approveRequestModal" tabindex="-1" role="dialog" aria-labelledby="approveRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveRequestModalLabel">Approve/Deny Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="approveRequestForm" data-module="InternalRequest" data-route="internal-requests">
                <input type="hidden" name="id" class="approve-id">
                <div class="modal-body">
                    <div class="approve-info mb-3"></div>
                    <div class="form-group">
                        <label for="approver_comment">Comment</label>
                        <textarea class="form-control approver-comment" name="approver_comment" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger btn-action-deny" type="button">Deny</button>
                    <button class="btn btn-success btn-action-approve" type="button">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
