var storedAlertTimes = []; // Array to track stored alert times

function checkForAlerts() {
    $.ajax({
        url: 'notification/get_notifications.php',
        method: 'GET',
        dataType: 'json',
        success: function (items) {
            if (Object.keys(items).length === 0) {
                return;
            } else {
                items.forEach(function (data) {
                    var notificationMessage = '';
                    console.log('General air Id' + data.air_id);
                    const modifiedTime = removeSecondsFromTime(data.time);

                    if (data.type === 'combined') {
                        notificationMessage = '<h6>جودة الهواء منخفضة و درجة الحرارة مرتفعة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>' +
                            '<p> درجة الحرارة ' + data.temperature + ' °C</p>';
                    } else if (data.type === 'temperature') {
                        notificationMessage =
                            '<h6>درجة الحرارة مرتفعة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>' +
                            '<p> درجة الحرارة ' + data.temperature + ' °C</p>';
                    } else if (data.type === 'air_quality') {
                        notificationMessage = '<h6>جودة الهواء منخفضة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>';
                    }

                    storeAlertInDatabase({
                        time: modifiedTime,
                        date: data.date,
                        room: data.room,
                        notification: notificationMessage
                    });

                    // Check if the user has navigated between pages
                    if (!sessionStorage.getItem('pageNavigated')) {
                        // Pass the string as the message to the Notify function
                        Notify(notificationMessage, null, null, 'danger');
                    }
                });

                // Set sessionStorage to indicate that the user has not navigated between pages
                sessionStorage.setItem('pageNavigated', false);
            }
        }
    });
}

function storeAlertInDatabase(data) {
    // Check if an alert with the same time already exists
    if (!isDuplicateAlert(data.time)) {
        // If not a duplicate, store the alert in the database
        $.ajax({
            url: 'notification/store_alert.php',
            method: 'POST',
            data: {
                time: data.time,
                date: data.date,
                room: data.room,
                notification: data.notification
            },
            success: function (response) {
                console.log(response);
                // Add the stored time to the array
                storedAlertTimes.push(data.time);
            },
            error: function (xhr, status, error) {
                console.error('Error storing alert in the database:', error);
            }
        });
    } else {
        console.log('Duplicate alert found. Skipping storage.');
    }
}

function isDuplicateAlert(alertTime) {
    // Check if the alert time is in the array of stored alert times
    return storedAlertTimes.includes(alertTime);
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

// Initialize by checking for alerts immediately
checkForAlerts();

// Periodically check for alerts (every 5 minutes in this example)
setInterval(checkForAlerts, 300000); // 300,000 milliseconds = 5 minutes

// Event listener for page navigation
$(window).on('beforeunload', function () {
    // Set sessionStorage to indicate that the user has navigated between pages
    sessionStorage.setItem('pageNavigated', true);
});
