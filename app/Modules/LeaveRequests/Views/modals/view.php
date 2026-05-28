<div class="modal fade" id="viewLeaveModal" tabindex="-1" role="dialog" aria-labelledby="viewLeaveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLeaveModalLabel">Leave Request Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Type:</div>
                    <div class="col-8" id="view_leave_type"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Start Date:</div>
                    <div class="col-8" id="view_start_date"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">End Date:</div>
                    <div class="col-8" id="view_end_date"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Status:</div>
                    <div class="col-8" id="view_status"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Reason:</div>
                    <div class="col-8" id="view_reason"></div>
                </div>
                <div class="row mb-2" id="view_comment_row" style="display:none;">
                    <div class="col-4 font-weight-bold">Approver Comment:</div>
                    <div class="col-8" id="view_approver_comment"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Created At:</div>
                    <div class="col-8" id="view_created_at"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
