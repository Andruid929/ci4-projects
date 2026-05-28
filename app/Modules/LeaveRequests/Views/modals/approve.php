<div class="modal fade" id="approveLeaveModal" tabindex="-1" role="dialog" aria-labelledby="approveLeaveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveLeaveModalLabel">Approve/Deny Leave Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form data-module="LeaveRequests" data-route="leave-requests">
                <input type="hidden" name="id" class="approve-id">
                <div class="modal-body">
                    <div class="approve-info mb-3"></div>
                    <div class="form-group">
                        <label for="leave_approver_comment">Comment</label>
                        <textarea class="form-control approver-comment" name="approver_comment" id="leave_approver_comment" rows="3" required></textarea>
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
