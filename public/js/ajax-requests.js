// Reponse modal
function showResponseModal(title, message, isSuccess = true) {
    const modal = $('#responseModal');
    const header = modal.find('.modal-header');
    const titleElement = modal.find('#responseModalLabel');
    const bodyElement = modal.find('#responseModalBody');

    header.removeClass('bg-success bg-danger');
    titleElement.removeClass('text-white').text('');
    
    if (isSuccess) {
        header.addClass('bg-success');
        titleElement.addClass('text-white');
    } else {
        header.addClass('bg-danger');
        titleElement.addClass('text-white');
    }

    titleElement.text(title);
    bodyElement.text(message);
    
    modal.modal('show');
}

async function sendAjaxRequest(url, options, requestButton = null, loadingText = 'Processing...') {
    let originalContent = '';

    if (requestButton) {
        originalContent = requestButton.innerHTML;

        requestButton.disabled = true;
        requestButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${loadingText}`;
    }

    try {
        const response = await fetch(url, {
            ...options,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                ...options.headers
            }
        });

        const data = await response.json();

        if (data.success) {
            if (requestButton) {
                requestButton.disabled = false;
                requestButton.innerHTML = originalContent;
            }

            if (data.message) {
                showResponseModal('Success', data.message, true);
            }

            return data;

        } else {
            const errorMessage = data.message || data.error || 'An error occurred on our end, try again later';
            showResponseModal('Error', errorMessage, false);

            if (requestButton) {
                requestButton.disabled = false;
                requestButton.innerHTML = originalContent;
            }

            return data;
        }

    } catch (error) {
        console.error('Error:', error);

        showResponseModal('Error', 'An unexpected error occurred. Please try again.', false);

        if (requestButton) {
            requestButton.disabled = false;
            requestButton.innerHTML = originalContent;
        }

        throw error;
    }
}

// Formatting Helpers
function formatStatus(status) {
    if (!status) return '';
    return status.charAt(0).toUpperCase() + status.slice(1).toLowerCase();
}

function formatType(type) {
    if (!type) return '';
    const map = {
        'career_advancement': 'Career Advancement',
        'compensation': 'Compensation',
        'operational': 'Operational',
        'administrative': 'Administrative',
        'sick': 'Sick Leave',
        'vacation': 'Vacation',
        'personal': 'Personal Leave',
        'bereavement': 'Bereavement Leave',
        'maternity': 'Maternity Leave',
        'unpaid': 'Unpaid Leave'
    };
    return map[type.toLowerCase()] || type.toLowerCase()
        .replace(/[_-]/g, ' ')
        .replace(/\b\w/g, l => l.toUpperCase());
}

function formatDate(dateStr, includeTime = false) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    if (isNaN(date.getTime())) return dateStr;

    const options = {
        year: 'numeric',
        month: 'short',
        day: '2-digit'
    };

    if (includeTime) {
        options.hour = '2-digit';
        options.minute = '2-digit';
    }

    return date.toLocaleDateString('en-US', options);
}

document.addEventListener('DOMContentLoaded', function () {

    // Create operation
    $(document).on('submit', '.ajax-create-form', async function (e) {

        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]')[0];
        const route = form.data('route');
        const url = `/${route}/create`;

        const formData = new FormData(this);
        const options = {
            method: 'POST',
            body: formData
        };

        try {
            const result = await sendAjaxRequest(url, options, submitBtn);

            if (result.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Create error:', error);
        }
    });

    // Delete operation
    $(document).on('click', '.btn-delete-generic', async function (e) {
        e.preventDefault();

        if (!confirm('Are you sure you want to delete this item?')) return;

        const btn = $(this);
        const id = btn.data('id');
        const container = btn.closest('[data-route]');
        const route = container.data('route');
        const url = `/${route}/delete/${id}`;

        const options = {
            method: 'POST'
        };

        try {
            const result = await sendAjaxRequest(url, options, btn[0]);
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Delete error:', error);
        }
    });

    // Restore - Admin only
    $(document).on('click', '.btn-restore-generic', async function (e) {
        e.preventDefault();

        if (!confirm('Are you sure you want to restore this request?')) return;

        const btn = $(this);
        const id = btn.data('id');
        const container = btn.closest('[data-route]');
        const route = container.data('route');
        const url = `/${route}/restore/${id}`;

        const options = {
            method: 'POST'
        };

        try {
            const result = await sendAjaxRequest(url, options, btn[0]);
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Restore error:', error);
        }
    });

    // Edit - Load data into modal
    $(document).on('click', '.btn-edit-generic', async function (e) {
        e.preventDefault();

        const btn = $(this);
        const id = btn.data('id');
        const targetModal = btn.data('target');
        const container = btn.closest('[data-route]');
        const route = container.data('route');
        const url = `/${route}/view/${id}`;

        try {
            const result = await sendAjaxRequest(url, { method: 'GET' }, btn[0]);

            if (result.success) {
                const data = result.data;
                const modal = $(targetModal);
                
                for (const key in data) {
                    const input = modal.find(`[name="${key}"]`);

                    if (input.length) {
                        input.val(data[key]);
                    }
                    const prefixedInput = modal.find(`#edit_${key}`);
                    if (prefixedInput.length) {
                        prefixedInput.val(data[key]);
                    }
                }
                
                modal.modal('show');
            }
        } catch (error) {
            console.error('Load edit data error:', error);
        }
    });

    // Update operation
    $(document).on('submit', '.ajax-edit-form', async function (e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]')[0];
        const route = form.data('route');
        const id = form.find('[name="id"]').val();
        const url = `/${route}/edit/${id}`;

        const formData = new FormData(this);
        const options = {
            method: 'POST',
            body: formData
        };

        try {
            const result = await sendAjaxRequest(url, options, submitBtn);
            
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Update error:', error);
        }
    });

    // View operation
    $(document).on('click', '.btn-view-generic', async function (e) {
        e.preventDefault();
        const btn = $(this);
        const id = btn.data('id');
        const targetModal = btn.data('target');
        const container = btn.closest('[data-route]');
        const route = container.data('route');
        const url = `/${route}/view/${id}`;

        try {
            const result = await sendAjaxRequest(url, { method: 'GET' }, btn[0]);
            if (result.success) {
                const data = result.data;
                const modal = $(targetModal);
                
                // Populate view fields
                for (const key in data) {
                    const element = modal.find(`#view_${key}`);
                    if (element.length) {
                        let val = data[key];
                        if (key.endsWith('_type')) val = formatType(val);
                        if (key === 'status') val = formatStatus(val);
                        if (key === 'created_at') val = formatDate(val, true);
                        if (key.endsWith('_date')) val = formatDate(val);
                        
                        element.text(val);
                    }
                }
                
                // Special handling for comment row
                if (data.approver_comment) {
                    modal.find('#view_comment_row').show();
                } else {
                    modal.find('#view_comment_row').hide();
                }
                
                modal.modal('show');
            }
        } catch (error) {
            console.error('View error:', error);
        }
    });

    // Approve/Deny - Load data
    $(document).on('click', '.btn-approve-generic', async function (e) {
        e.preventDefault();

        const btn = $(this);

        const id = btn.data('id');
        const targetModal = btn.data('target');
        const container = btn.closest('[data-route]');
        const route = container.data('route');

        const url = `/${route}/view/${id}`;

        try {
            const result = await sendAjaxRequest(url, { method: 'GET' }, btn[0]);

            if (result.success) {
                const data = result.data;
                const modal = $(targetModal);
                
                modal.find('.approve-id').val(data.id);

                const type = formatType(data.request_type || data.leave_type);
                const subject = data.subject || data.reason;

                modal.find('.approve-info').html(`
                    <strong>Type:</strong> ${type}<br>
                    <strong>Subject/Reason:</strong> ${subject}
                `);
                
                modal.modal('show');
            }
        } catch (error) {
            console.error('Load approve data error:', error);
        }
    });

    // Approve action
    $(document).on('click', '.btn-action-approve', async function (e) {
        const btn = $(this);
        const form = btn.closest('form');
        const route = form.data('route');
        const id = form.find('.approve-id').val();
        const url = `/${route}/handle/${id}`;
        
        const formData = new FormData(form[0]);
        formData.append('status', 'approved');

        const options = {
            method: 'POST',
            body: formData
        };

        try {
            const result = await sendAjaxRequest(url, options, btn[0], 'Approving...');
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Approve error:', error);
        }
    });

    // Deny action
    $(document).on('click', '.btn-action-deny', async function (e) {
        const btn = $(this);
        const form = btn.closest('form');
        const route = form.data('route');
        const id = form.find('.approve-id').val();
        const url = `/${route}/handle/${id}`;
        
        const formData = new FormData(form[0]);
        formData.append('status', 'denied');

        const options = {
            method: 'POST',
            body: formData
        };

        try {
            const result = await sendAjaxRequest(url, options, btn[0], 'Denying...');
            if (result.success) {
                location.reload();
            }
        } catch (error) {
            console.error('Deny error:', error);
        }
    });
});
