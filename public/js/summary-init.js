$(document).ready(function () {

    loadSummaryData();

    function loadSummaryData() {
        const endpoint = document.body.getAttribute('data-summary-endpoint') || 'summary/data';
        
        $.ajax({
            url: endpoint,
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function (data) {
                
                if (data.success) {
                    $('#totalRequests').text(data.stats.total || 0);
                    $('#pendingCount').text(data.stats.pending || 0);
                    $('#approvedCount').text(data.stats.approved || 0);
                    $('#deniedCount').text(data.stats.denied || 0);

                    loadRecentRequests(data.recent_requests || []);

                } else {
                    console.error('data.success is false', data);
                }
            },

            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
            }
        });
    }

    function loadRecentRequests(requests) {
        const tbody = $('#recentRequestsTable tbody');

        tbody.empty();

        if (requests.length === 0) {
            tbody.html(`
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                        <strong>No requests</strong>
                    </td>
                </tr>
            `);
            return;
        }

        requests.forEach(req => {

            const createdDate = new Date(req.created_at).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            });

            const typeLabel = req.is_leave ? 'Leave' : 'Internal';

            let statusBadge = '';
            
            if (req.status === 'pending') {
                statusBadge = '<span class="badge badge-warning">Pending</span>';
                
            } else if (req.status === 'approved') {
                statusBadge = '<span class="badge badge-success">Approved</span>';

            } else if (req.status === 'denied') {
                statusBadge = '<span class="badge badge-danger">Denied</span>';
            }

            const row = `
                <tr>
                    <td>#${req.id}</td>
                    <td>${typeLabel}</td>
                    <td>${req.employee_name || 'N/A'}</td>
                    <td>${statusBadge}</td>
                    <td>${createdDate}</td>
                </tr>
            `;
            tbody.append(row);
        });
    }
});
