// Function to check for new sensor data and display alerts
var newNotificationsCount = 0 ;
var displayedNotificationIdsTemps = [];
var displayedNotificationIdsAir = [];

function checkForAlerts() {
    $.ajax({
        url: 'check.php',
        method: 'GET',
        dataType: 'json', // Expect JSON response
        success: function (data) {
            if (Object.keys(data).length === 0) {
                return;
            } else {
                if(data.type ==="temperature") {
                    if (displayedNotificationIdsTemps.includes(data.temperature_id)) {
                        return; // Skip if already displayed
                    }
                    displayedNotificationIdsTemps.push(data.temperature_id);
                }
                else  {
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

                console.log('General air Id'+data.air_id);
                if (data.type === 'combined') {
                    alertHtml = '<li class="dropdown-item">' +
                        '<h6>جودة الهواء منخفضة ودرجة الحرارة مرتفعة</h6>' +
                        '<p>التاريخ ' + data.date + '</p>' +
                        '<p>الوقت ' + data.time + '</p>' +
                        '<p> في الغرفة رقم ' + data.room + '</p>' +
                        '<p> درجة الحرارة ' + data.temperature + ' °C</p>' +
                        '<button class="remove-btn" data-id="'+data.temperature_id+'" data-air="'+data.air_id+'" data-type="'+data.type+'" onclick="removeNotification(this)">حذف</button>' +
                        '</li>';
                } else if (data.type === 'temperature') {
                    alertHtml = '<li class="dropdown-item">' +
                        '<h6>درجة الحرارة مرتفعة</h6>' +
                        '<p>التاريخ ' + data.date + '</p>' +
                        '<p>الوقت ' + data.time + '</p>' +
                        '<p> في الغرفة رقم ' + data.room + '</p>' +
                        '<p> درجة الحرارة ' + data.temperature + ' °C</p>' +
                        '<button class="remove-btn" data-id="'+data.temperature_id+'" data-air="'+data.air_id+'" data-type="'+data.type+'" onclick="removeNotification(this)">حذف</button>' +
                        '</li>';
                } else if (data.type === 'air_quality') {
                    alertHtml = '<li class="dropdown-item">' +
                        '<h6>جودة الهواء منخفضة</h6>' +
                        '<p>التاريخ ' + data.date + '</p>' +
                        '<p>الوقت ' + data.time + '</p>' +
                        '<p> في الغرفة رقم ' + data.room + '</p>' +
                        '<button class="remove-btn" data-id="'+data.temperature_id+'" data-air="'+data.air_id+'" data-type="'+data.type+'" onclick="removeNotification(this)">حذف</button>' +
                        '</li>';
                }

                $('#alerts-dropdown').append(alertHtml);
            }
        }
    });
}

// Function to remove a notification from the dropdown list
function removeNotification(button) {
    var type = (typeof $(button).data('type') !== 'undefined') ? $(button).data('type') : 'defaultType';

    var temperatureId=$(button).data('id');
    var airId=$(button).data('air');
    if(temperatureId==='undefined'){
        temperatureId = 0;
    }

    if(airId==='undefined'){
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
setInterval(checkForAlerts, 10000); // 10,000 milliseconds = 10 seconds