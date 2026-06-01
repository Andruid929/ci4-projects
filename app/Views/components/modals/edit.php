<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $modalId ?>Label"><?= esc($title) ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form class="ajax-edit-form" data-module="<?= esc($module) ?>" data-route="<?= esc($route) ?>">
                
                <input type="hidden" name="id" id="edit_id_<?= $type ?>">
                <input type="hidden" name="id" id="edit_id">
                
                <div class="modal-body">
                    
                    <?php
                    if ($type === 'internal'): ?>
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
                    
                    <?php
                    else: ?>
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
                    
                    <?php
                    endif; ?>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
