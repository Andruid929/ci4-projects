/**
 * Helper to handle AJAX requests with IU
 * @param {string} url - The link to send the request to
 * @param {Object} options - Request params options (method, body, headers, etc.)
 * @param {HTMLElement} requestButton - The button element that triggered the request
 * @param {string} loadingText - Text to show on the button while loading
 * @returns {Promise} - The request promise
 */
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

            if (data.message) {
                alert(data.message);
            }

            if (data.redirect) {
                window.location.href = data.redirect;
            }

            return data;

        } else {
            alert(data.message || 'An error occurred.');

            if (requestButton) {
                requestButton.disabled = false;
                requestButton.innerHTML = originalContent;
            }

            return data;
        }

    } catch (error) {
        console.error('Error:', error);

        alert('An unexpected error occurred. Please try again.');

        if (requestButton) {
            requestButton.disabled = false;
            requestButton.innerHTML = originalContent;
        }

        throw error;
    }
}
