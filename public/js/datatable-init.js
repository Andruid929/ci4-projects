$(document).ready(function () {

    //This is the function to check if the table has data rows (excluding the "No requests" placeholder)
    function hasDataRows(tableSelector) {
        var $table = $(tableSelector);
        if (!$table.length) return false;
        
        var $rows = $table.find('tbody tr');
        if ($rows.length === 0) return false;
        
        if ($rows.length === 1) {
            return !$rows.find('td').attr('colspan');
        }
        
        return true;
    }

    if (hasDataRows('#dataTableInternal')) {
        try {
            $('#dataTableInternal').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": -1}
                ],
                "order": [[3, "desc"]]
            });
        } catch (e) {
            console.error("Error initializing Internal Requests table:", e);
        }
    }

    
    if (hasDataRows('#dataTableLeave')) {
        try {
            $('#dataTableLeave').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": -1}
                ],
                "order": [[4, "desc"]]
            });
        } catch (e) {
            console.error("Error initializing Leave Requests table:", e);
        }
    }
});


