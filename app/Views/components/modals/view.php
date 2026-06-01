<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $modalId ?>Label"><?= esc($title) ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Type:</div>
                    <div class="col-8" id="view_<?= $type === 'internal' ? 'request' : 'leave' ?>_type"></div>
                </div>

                <?php
                if ($type === 'internal'): ?>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold">Subject:</div>
                        <div class="col-8" id="view_subject"></div>
                    </div>
                
                <?php
                else: ?>
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold">Start Date:</div>
                        <div class="col-8" id="view_start_date"></div>
                    </div>
                
                    <div class="row mb-2">
                        <div class="col-4 font-weight-bold">End Date:</div>
                        <div class="col-8" id="view_end_date"></div>
                    </div>
                
                <?php
                endif; ?>

                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Status:</div>
                    <div class="col-8" id="view_status"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-4 font-weight-bold"><?= $type === 'internal' ? 'Description' : 'Reason' ?>:</div>
                    <div class="col-8" id="view_<?= $type === 'internal' ? 'description' : 'reason' ?>"></div>
                </div>

                <div class="row mb-2" id="view_comment_row" style="display:none;">
                    <div class="col-4 font-weight-bold">Approver Comment:</div>
                    <div class="col-8" id="view_approver_comment"></div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Date Created:</div>
                    <div class="col-8" id="view_created_at"></div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>
