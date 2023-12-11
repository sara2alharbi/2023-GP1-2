Notify = function(text, callback, close_callback, style) {

    var time = '15000';
    var $container = $('#notifications');
    var icon = '<i class="fa fa-info-circle "></i>';

    if (typeof style == 'undefined' ) style = 'warning'

    var html = $('<div class="alert alert-' + style + '  hide">' + icon +  " " + text + '</div>');

    $('<a>',{
        text: '×',
        class: 'button close',
        style: 'padding-left: 10px;',
        href: '#',
        click: function(e){
            e.preventDefault()
            close_callback && close_callback()
            remove_notice()
        }
    }).prependTo(html)

    $container.prepend(html)
    html.removeClass('hide').hide().fadeIn('slow')

    function remove_notice() {
        html.stop().fadeOut('slow').remove()
    }

    var timer =  setInterval(remove_notice, time);

    $(html).hover(function(){
        clearInterval(timer);
    }, function(){
        timer = setInterval(remove_notice, time);
    });

    html.on('click', function () {
        clearInterval(timer)
        callback && callback()
        remove_notice()
    });


}

// Function to fetch and display notifications
function fetchNotifications() {
    $.ajax({
        url: 'notification/get_notifications.php', 
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            displayNotifications(data);
        },
        error: function (error) {
            console.error('Error fetching notifications:', error);
        }
    });
}

// Function to display notifications
function displayNotifications(notifications) {
    // Clear existing notifications
    $('#notifications').empty();

    // Iterate through the notifications and display them
    notifications.forEach(function (notification) {
        // Display only notifications with timestamps in the last 5 minutes
        var currentTime = new Date().getTime() / 1000; // Current time in seconds
        if (currentTime - notification.timestamp <= 300) {
            Notify(
                notification.text,
                function () {
                    // Handle notification click
                    console.log('Notification clicked:', notification);
                },
                function () {
                    // Handle notification close
                    console.log('Notification closed:', notification);
                },
                notification.style
            );
        }
    });
}

// Function to clear notifications when navigating to a new page
function clearNotifications() {
    $('#notifications').empty();
}

// Fetch and display notifications when the page loads
$(document).ready(function () {
    fetchNotifications();
});

// Clear notifications when navigating to a new page
$(window).on('beforeunload', function () {
    clearNotifications();
});

// Periodically fetch and display notifications (every 5 minutes in this example)
setInterval(function () {
    fetchNotifications();
}, 300000); // 300,000 milliseconds = 5 minutes


