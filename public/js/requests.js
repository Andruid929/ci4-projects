$(document).ready(function() {
    const baseUrl = window.location.origin;

    // Helper to get configuration from an element or its parent
    function getConfig(el) {
        const $el = $(el);
        const $container = $el.closest('[data-module]');
        return {
            module: $container.data('module'),
            route: $container.data('route')
        };
    }

    // Generic Create Request
    $(document).on('submit', '.ajax-create-form', function(e) {
        e.preventDefault();
        const config = getConfig(this);
        $.ajax({
            url: baseUrl + '/' + config.route + '/create',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON?.messages?.error || 'Unknown error'));
            }
        });
    });

    // Generic View Request
    $(document).on('click', '.btn-view-generic', function() {
        const id = $(this).data('id');
        const config = getConfig(this);
        const modalId = $(this).data('target');
        
        $.ajax({
            url: baseUrl + '/' + config.route + '/view/' + id,
            method: 'GET',
            success: function(request) {
                // Auto-fill text elements by ID mapping: view_{field_name}
                for (let key in request) {
                    $(`${modalId} #view_${key}`).text(request[key]);
                }
                
                // Special handling for approver comment row
                if (request.approver_comment) {
                    $(`${modalId} #view_comment_row`).show();
                } else {
                    $(`${modalId} #view_comment_row`).hide();
                }
                
                $(modalId).modal('show');
            }
        });
    });

    // Generic Edit Request (Load data)
    $(document).on('click', '.btn-edit-generic', function() {
        const id = $(this).data('id');
        const config = getConfig(this);
        const modalId = $(this).data('target');

        $.ajax({
            url: baseUrl + '/' + config.route + '/view/' + id,
            method: 'GET',
            success: function(request) {
                // Auto-fill input elements by ID mapping: edit_{field_name}
                $(`${modalId} [name="id"]`).val(request.id);
                for (let key in request) {
                    $(`${modalId} #edit_${key}`).val(request[key]);
                    $(`${modalId} [name="${key}"]`).val(request[key]);
                }
                $(modalId).modal('show');
            }
        });
    });

    // Generic Submit Edit
    $(document).on('submit', '.ajax-edit-form', function(e) {
        e.preventDefault();
        const config = getConfig(this);
        const id = $(this).find('[name="id"]').val();
        
        $.ajax({
            url: baseUrl + '/' + config.route + '/edit/' + id,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                alert('Error updating request');
            }
        });
    });

    // Generic Delete Request
    $(document).on('click', '.btn-delete-generic', function() {
        if (confirm('Are you sure you want to delete this item?')) {
            const id = $(this).data('id');
            const config = getConfig(this);
            $.ajax({
                url: baseUrl + '/' + config.route + '/delete/' + id,
                method: 'POST',
                success: function(response) {
                    alert(response.message);
                    location.reload();
                }
            });
        }
    });

    // Generic Approve/Deny (Load info)
    $(document).on('click', '.btn-approve-generic', function() {
        const id = $(this).data('id');
        const config = getConfig(this);
        const modalId = $(this).data('target');
        
        $.ajax({
            url: baseUrl + '/' + config.route + '/view/' + id,
            method: 'GET',
            success: function(request) {
                $(`${modalId} .approve-id`).val(request.id);
                
                // Module specific info display could be handled here or by a callback
                let infoHtml = '';
                for (let key in request) {
                    if (['id', 'status', 'approver_comment', 'updated_at', 'deleted_at'].includes(key)) continue;
                    infoHtml += `<strong>${key.replace('_', ' ').toUpperCase()}:</strong> ${request[key]}<br>`;
                }
                $(`${modalId} .approve-info`).html(infoHtml);
                $(modalId).modal('show');
            }
        });
    });

    $(document).on('click', '.btn-action-approve, .btn-action-deny', function() {
        const isApprove = $(this).hasClass('btn-action-approve');
        const config = getConfig(this);
        const $modal = $(this).closest('.modal');
        const id = $modal.find('.approve-id').val();
        const comment = $modal.find('.approver-comment').val();
        
        if (!comment) { alert('Comment is required'); return; }
        
        const action = isApprove ? 'approve' : 'deny';
        
        $.ajax({
            url: baseUrl + '/' + config.route + '/' + action + '/' + id,
            method: 'POST',
            data: { approver_comment: comment },
            success: function(response) {
                alert(response.message);
                location.reload();
            }
        });
    });
});
