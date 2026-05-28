<div class="modal fade" id="createLeaveModal" tabindex="-1" role="dialog" aria-labelledby="createLeaveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLeaveModalLabel">New Leave Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="ajax-create-form" data-module="LeaveRequests" data-route="leave-requests">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="leave_type">Leave Type</label>
                        <select class="form-control" name="leave_type" id="leave_type" required>
                            <option value="sick">Sick</option>
                            <option value="vacation">Vacation</option>
                            <option value="personal">Personal</option>
                            <option value="bereavement">Bereavement</option>
                            <option value="maternity">Maternity</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" id="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="datetime-local" class="form-control" name="end_date" id="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
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
