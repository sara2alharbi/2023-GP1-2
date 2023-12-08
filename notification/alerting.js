// Function to check for new sensor data and display alerts
var newNotificationsCount = 0;
var displayedNotificationIdsTemps = [];
var displayedNotificationIdsAir = [];

function checkForAlerts() {
  $.ajax({
      url: 'notification/get_notifications.php',
      method: 'GET',
      dataType: 'json',
      success: function (items) {
        console.log("Received items:", items);  // Log the received data
          if (Object.keys(items).length === 0) {
            console.log("No alerts to display");
              // Hide the table if there are no alerts
              $('#alerts-table').hide();
              return;
          } else {
            console.log("Processing alerts...");
              // Show the table if there are alerts
              $('#alerts-table').show();

              // Clear existing rows from the table
              $('#alerts-table tbody').empty();

              items.forEach(function (data) {
                console.log("Processing data:", data);  // Log the data being processed
                  // Append the new notification to the table
                  const modifiedTime = removeSecondsFromTime(data.time);

                  var alertRow = '<tr>' +
                      '<td>' + modifiedTime + '</td>' +
                      '<td>' + data.room + '</td>' +
                      '<td>' + data.notification + '</td>' +
                      '</tr>';

                  // Append the row to the table body
                  $('#alerts-table tbody').append(alertRow);
                  console.log("Row appended to the table");
              });

              // Display a notification message if needed
              if (items.length > 0) {
                  var notificationMessage = getNotificationMessage(items[0]); // You can customize the message
                  Notify(notificationMessage, null, null, 'danger');
              }
          }
      }
  });
}

  
  
  // Function to get the notification message
  function getNotificationMessage(data) {
    const modifiedTime = removeSecondsFromTime(data.time);
  
    return  ' الوقت ' + modifiedTime +
      ' في الغرفة رقم ' + data.room +
      ' الاشعار ' + data.notification;
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
        url: 'delete_notification.php', 
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

// Initialize by checking for alerts immediately
checkForAlerts();

// Periodically check for alerts (every 10 seconds in this example)
setInterval(checkForAlerts, 30000); // 10,000 milliseconds = 10 seconds