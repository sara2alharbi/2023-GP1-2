// Function to check for new sensor data and display alerts
var newNotificationsCount = 0;
var displayedNotificationIdsTemps = [];
var displayedNotificationIdsAir = [];

function checkForAlerts() {
    $.ajax({
        url: 'notification/get_notifications.php',
        method: 'GET',
        dataType: 'json', // Expect JSON response
        success: function (items) {
            if (Object.keys(items).length === 0) {
                return;
            } else {
                items.forEach(function (data) {

                    if (data.type === "temperature") {
                        if (displayedNotificationIdsTemps.includes(data.temperature_id)) {
                            return; // Skip if already displayed
                        }
                        displayedNotificationIdsTemps.push(data.temperature_id);
                    } else {
                        if (displayedNotificationIdsAir.includes(data.air_id)) {
                            return; // Skip if already displayed
                        }
                        displayedNotificationIdsAir.push(data.air_id);
                    }
                    // Increment the notification count
                    newNotificationsCount++;


                    // Update the notification count
                    $('#notification-count').text(newNotificationsCount);
                    $('#notification-count').show();

                    // Append the new notification to the dropdown list
                    var alertHtml = '';
                    var notificationMessage = '';
                    console.log('General air Id' + data.air_id);
                    const modifiedTime = removeSecondsFromTime(data.time);

                    if (data.type === 'combined') {
                        alertHtml = '<tr class="table-alert">' +
                            '<td>' +
                                modifiedTime +
                                '</td>' +
                            '<td>' +
                                data.room +
                                '</td>' +
                            '<td>' +
                                'جودة الهواء منخفضة ودرجة الحرارة مرتفعة' +
                            '</td>' +
                        '</tr>';
                    
                        notificationMessage = '<h6>درجة الحرارة مرتفعة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>' +
                            '<p> درجة الحرارة ' + data.temperature + ' °C</p>';
                    
                    } else if (data.type === 'temperature') {
                        alertHtml = '<tr class="table-alert">' +
                            '<td>' +
                                modifiedTime +
                                '</td>' +
                            '<td>' +
                                data.room +
                                '</td>' +
                            '<td>' +
                                'درجة الحرارة مرتفعة' +
                            '</td>' +
                        '</tr>';
                    
                        notificationMessage =
                            '<h6>درجة الحرارة مرتفعة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>' +
                            '<p> درجة الحرارة ' + data.temperature + ' °C</p>';
                    
                    } else if (data.type === 'air_quality') {
                        alertHtml = '<tr class="table-alert">' +
                            '<td>' +
                                modifiedTime +
                                '</td>' +
                            '<td>' +
                                data.room +
                                '</td>' +
                            '<td>' +
                                'جودة الهواء منخفضة' +
                            '</td>' +
                        '</tr>';
                    
                        notificationMessage = '<h6>جودة الهواء منخفضة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>';
                    }
                    
                    // Pass the string as the message to the Notify function
                    Notify(notificationMessage, null, null, 'danger');
                    
                    // Append the new row to the table
                    $('#alerts-table').append(alertHtml);
                });
            }
        }
    });
}

function removeSecondsFromTime(timeString) {
    // Split the time string into hours, minutes, and seconds
    const [hours, minutes] = timeString.split(':').map(Number);

    // Determine if it's AM or PM
    const period = hours < 12 ? 'AM' : 'PM';

    // Convert hours to 12-hour format
    const hours12 = hours % 12 || 12;

    // Construct the new time string in AM/PM format
    const newTime = `${hours12}:${minutes} ${period}`;

    console.log(newTime);
    return newTime;
}


// Function to remove a notification from the dropdown list
function removeNotification(button) {
    var type = (typeof $(button).data('type') !== 'undefined') ? $(button).data('type') : 'defaultType';

    var temperatureId = $(button).data('id');
    var airId = $(button).data('air');
    if (temperatureId === 'undefined') {
        temperatureId = 0;
    }

    if (airId === 'undefined') {
        airId = 0;
    }

    // Now you can use the 'temperatureId' and 'airId' values in your function
    console.log("Temperature ID1: " + temperatureId);
    console.log("Air ID: " + airId);
    console.log("Notification Type : " + type);

    $.ajax({
        url: 'delete_notification.php', // Replace with the URL of your PHP script
        method: 'POST', // You can use POST or GET depending on your needs
        data: {
            temperature_id: temperatureId,
            air_id: airId,
            type: type,
        },
        success: function (response) {
            console.log('Data added to the database:', response);
        },
        error: function (xhr, status, error) {
            console.error('Error adding data to the database:', error);
        }
    });

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
setInterval(checkForAlerts, 30000); // 10,000 milliseconds = 10 seconds