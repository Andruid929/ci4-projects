<div class="modal fade" id="editLeaveModal" tabindex="-1" role="dialog" aria-labelledby="editLeaveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeaveModalLabel">Edit Leave Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="ajax-edit-form" data-module="LeaveRequests" data-route="leave-requests">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_leave_type">Leave Type</label>
                        <select class="form-control" name="leave_type" id="edit_leave_type" required>
                            <option value="sick">Sick</option>
                            <option value="vacation">Vacation</option>
                            <option value="personal">Personal</option>
                            <option value="bereavement">Bereavement</option>
                            <option value="maternity">Maternity</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_start_date">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" id="edit_start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_end_date">End Date</label>
                        <input type="datetime-local" class="form-control" name="end_date" id="edit_end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_reason">Reason</label>
                        <textarea class="form-control" name="reason" id="edit_reason" rows="3" required></textarea>
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
