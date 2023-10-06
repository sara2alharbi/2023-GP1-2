// Function to check for new sensor data and display alerts
var newNotificationsCount = 0 ;
function checkForAlerts() {
    $.ajax({
        url: 'check.php',
        method: 'GET',
        dataType: 'json', // Expect JSON response
        success: function (data) {
            if (Object.keys(data).length === 0) {
                return;
            } else {
                // Increment the notification count
                newNotificationsCount++;
                

                // Update the notification count
                $('#notification-count').text(newNotificationsCount);
                $('#notification-count').show();

                // Append the new notification to the dropdown list
                var alertHtml = '';

                if (data.type === 'combined') {
                    alertHtml = '<li class="dropdown-item">' +
                        '<h6>جودة الهواء منخفضة ودرجة الحرارة مرتفعة</h6>' +
                        '<p>التاريخ ' + data.date + '</p>' +
                        '<p>الوقت ' + data.time + '</p>' +
                        '<p> في الغرفة رقم ' + data.room + '</p>' +
                        '<p> درجة الحرارة ' + data.temperature + ' °C</p>' +
                        '<button class="remove-btn" onclick="removeNotification(this)">حذف</button>' +
                        '</li>';
                } else if (data.type === 'temperature') {
                    alertHtml = '<li class="dropdown-item">' +
                        '<h6>درجة الحرارة مرتفعة</h6>' +
                        '<p>التاريخ ' + data.date + '</p>' +
                        '<p>الوقت ' + data.time + '</p>' +
                        '<p> في الغرفة رقم ' + data.room + '</p>' +
                        '<p> درجة الحرارة ' + data.temperature + ' °C</p>' +
                        '<button class="remove-btn" onclick="removeNotification(this)">حذف</button>' +
                        '</li>';
                } else if (data.type === 'air_quality') {
                    alertHtml = '<li class="dropdown-item">' +
                        '<h6>جودة الهواء منخفضة</h6>' +
                        '<p>التاريخ ' + data.date + '</p>' +
                        '<p>الوقت ' + data.time + '</p>' +
                        '<p> في الغرفة رقم ' + data.room + '</p>' +
                        '<button class="remove-btn" onclick="removeNotification(this)">حذف</button>' +
                        '</li>';
                }

                $('#alerts-dropdown').append(alertHtml);
            }
        }
    });
}

// Function to remove a notification from the dropdown list
function removeNotification(button) {
    $(button).parent().remove();

    // Decrease the notification count
    newNotificationsCount = parseInt($('#notification-count').text()) || 0;
    newNotificationsCount--;

    if (newNotificationsCount === 0) {
        $('#notification-count').hide();
        $('#alerts-container').hide();
    } else {
        $('#notification-count').text(newNotificationsCount);
    }
}

// Function to toggle the visibility of the alerts dropdown
function toggleAlerts() {
    $('#alerts-dropdown').toggle();
    $('#alerts-container').show();
}

// Initialize by checking for alerts immediately
checkForAlerts();

// Periodically check for alerts (every 10 seconds in this example)
setInterval(checkForAlerts, 10000); // 10,000 milliseconds = 10 seconds