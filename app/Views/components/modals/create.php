<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $modalId ?>Label"><?= esc($title) ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form class="ajax-create-form" data-module="<?= esc($module) ?>" data-route="<?= esc($route) ?>">
                
                <div class="modal-body">
                    
                    <?php
                    if ($type === 'internal'): ?>
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
                    
                    <?php
                    else: ?>
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
                    
                    <?php
                    endif; ?>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Submit Request</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
