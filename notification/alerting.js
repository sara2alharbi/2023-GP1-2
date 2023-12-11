
var storedAlertTimes = []; // Array to track stored alert times

// Function to generate a unique key for the alert
function getAlertKey(data) {
    return `${data.type}_${data.date}_${data.time}_${data.room}`;
}

// Function to save dismissed alerts in session storage
function saveDismissedAlert(alertKey) {
    // Get the dismissed alerts array from session storage
    var dismissedAlerts = JSON.parse(sessionStorage.getItem('dismissedAlerts')) || [];

    // Add the current alert key to the dismissed alerts array
    dismissedAlerts.push(alertKey);

    // Save the dismissed alerts array back to session storage
    sessionStorage.setItem('dismissedAlerts', JSON.stringify(dismissedAlerts));
}

// Function to check if an alert has been dismissed
function isAlertDismissed(alertKey) {
    // Get the dismissed alerts array from session storage
    var dismissedAlerts = JSON.parse(sessionStorage.getItem('dismissedAlerts')) || [];

    // Check if the current alert key is in the dismissed alerts array
    return dismissedAlerts.includes(alertKey);
}

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
                    const alertKey = getAlertKey(data);
                    if (!isAlertDismissed(alertKey)) {
                        var notificationMessage = '';
                        const modifiedTime = removeSecondsFromTime(data.time);

                    if (data.type === 'combined') {                    
                        notificationMessage = '<h6>جودة الهواء منخفضة و درجة الحرارة مرتفعة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>' +
                            '<p> درجة الحرارة ' + data.temperature + ' °C</p>';
                        
                        message = "جودة الهواء منخفضة و درجة الحرارة مرتفعة";
                    
                    } else if (data.type === 'temperature') {
                        notificationMessage =
                            '<h6>درجة الحرارة مرتفعة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>' +
                            '<p> درجة الحرارة ' + data.temperature + ' °C</p>';
                        message = "درجة الحرارة مرتفعة";

                    
                    } else if (data.type === 'air_quality') {                    
                        notificationMessage = '<h6>جودة الهواء منخفضة</h6>' +
                            '<p>الوقت ' + modifiedTime + '</p>' +
                            '<p> في الغرفة رقم ' + data.room + '</p>';
                        message = "جودة الهواء منخفضة";
                    }

                    storeAlertInDatabase({
                        time: modifiedTime,
                        date: data.date,
                        room: data.room,
                        notification: message
                    });

                    Notify(notificationMessage, null, null, 'danger');
                        saveDismissedAlert(alertKey);
                }
                });
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


// Function to clear dismissed alerts when navigating to a new page
function clearDismissedAlerts() {
    sessionStorage.removeItem('dismissedAlerts');
}

// Clear dismissed alerts when navigating to a new page
$(window).on('beforeunload', function () {
    clearDismissedAlerts();
});

// Initialize by checking for alerts immediately
checkForAlerts();

// Periodically check for alerts (every 5 minutes in this example)
setInterval(checkForAlerts, 300000); // 300,000 milliseconds = 5 minutes
