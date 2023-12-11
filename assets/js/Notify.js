Notify = function (text, callback, close_callback, style) {

    var time = '15000';
    var $container = $('#notifications');
    var icon = '<i class="fa fa-info-circle "></i>';

    if (typeof style == 'undefined') style = 'warning';

    var html = $('<div class="alert alert-' + style + '  hide">' + icon + " " + text + '</div>');

    $('<a>', {
        text: '×',
        class: 'button close',
        style: 'padding-left: 10px;',
        href: '#',
        click: function (e) {
            e.preventDefault()
            close_callback && close_callback()
            remove_notice();
            // Save the dismissed alert in local storage
            saveDismissedAlert(text);
        }
    }).prependTo(html)

    $container.prepend(html)
    html.removeClass('hide').hide().fadeIn('slow')

    function remove_notice() {
        html.stop().fadeOut('slow').remove()
    }

    var timer = setInterval(remove_notice, time);

    $(html).hover(function () {
        clearInterval(timer);
    }, function () {
        timer = setInterval(remove_notice, time);
    });

    html.on('click', function () {
        clearInterval(timer)
        callback && callback()
        remove_notice();
        // Save the dismissed alert in local storage
        saveDismissedAlert(text);
    });
}

// Function to clear notifications when navigating to a new page
function clearNotifications() {
    $('#notifications').empty();
}

// Clear notifications when navigating to a new page
$(window).on('beforeunload', function () {
    clearNotifications();
});

// Function to save dismissed alerts in local storage
function saveDismissedAlert(alertText) {
    // Get the dismissed alerts array from local storage
    var dismissedAlerts = JSON.parse(localStorage.getItem('dismissedAlerts')) || [];

    // Add the current alert text to the dismissed alerts array
    dismissedAlerts.push(alertText);

    // Save the dismissed alerts array back to local storage
    localStorage.setItem('dismissedAlerts', JSON.stringify(dismissedAlerts));
}

// Function to check if an alert has been dismissed
function isAlertDismissed(alertText) {
    // Get the dismissed alerts array from local storage
    var dismissedAlerts = JSON.parse(localStorage.getItem('dismissedAlerts')) || [];

    // Check if the current alert text is in the dismissed alerts array
    return dismissedAlerts.includes(alertText);
}
