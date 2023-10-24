var loading = '<span id="loadingBtn" class="spinner-border spinner-border-sm"\n' +
    'role="status" aria-hidden="true"></span>';

var alreadyFound = false;
var reqType = 0;

function searchRooms(type, capacity, day, startDate, endDate) {

    document.getElementById('closeModalButton').addEventListener('click', closeModal);
    reqType = 1;
    var generalRes;
    $(document).ready(function () {
        const noDataMessage = document.getElementById("noDataMessage");
        document.getElementById('searchButton').disabled = true;
        document.getElementById('searchButton').innerHTML = loading + 'جاري البحث';
        noDataMessage.style.display = 'none';

        $.ajax({
            type: "POST", // Use POST or GET based on your needs
            url: "get_rooms.php",
            data: {
                type: type,
                capacity: capacity,
                day: day,
                startDate: startDate,
                endDate: endDate
            }, // Send data to the server
            success: function (response) {
                if (response.length === 0) {
                    noDataMessage.style.display = 'block';
                    //   document.getElementById("table").style.display = 'none'; // Hide the table

                    document.getElementById('searchButton').textContent = 'بحث';
                    document.getElementById('searchButton').disabled = false;

                    if (alreadyFound) {
                        document.getElementById("table_wrapper").style.display = 'none';
                    }
                } else {
                    console.log(response);
                    generalRes = response;

                    const tableBody = document.getElementById("table-body");
                    tableBody.innerHTML = "";

                    response.forEach(function (item, index) {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = index + 1;
                        row.insertCell(1).textContent = item.roomNo;
                        row.insertCell(2).textContent = item.floor;
                        row.insertCell(3).textContent = item.capacity;

                        // Add a button in the last cell
                        const actionCell = row.insertCell(4);
                        const button = document.createElement("button");
                        button.className = "btn btn-primary";
                        button.textContent = "حجز";
                        actionCell.appendChild(button);
                    });

                    document.getElementById("table").style.visibility = 'visible';
                    document.getElementById('searchButton').textContent = 'بحث';
                    document.getElementById('searchButton').disabled = false;

                    $(document).ready(function () {

                        if (alreadyFound) {
                            console.log('Already found ');
                            var dataTable = $('#table').DataTable();
                            dataTable.destroy();
                        }
                        $('#table').DataTable({
                            paging: true, // Enable pagination
                            pageLength: 10, // Number of rows per page
                            lengthMenu: [5, 10, 15, 25, 50, 100], // Page length options
                            pagingType: 'full_numbers', // Pagination style
                            order: [], // Disable initial sorting
                            language: {
                                paginate: {
                                    first: 'الأولى',
                                    previous: 'السابقة',
                                    next: 'التالية',
                                    last: 'الأخيرة'
                                },
                                lengthMenu: "عرض _MENU_ في الصفحة",
                                search: "بحث:",
                                info: "عرض _START_ - _END_ من إجمالي _TOTAL_ عناصر",
                                infoEmpty: "عرض 0 إلى 0 من إجمالي 0 عناصر",
                                infoFiltered: "(تمت تصفيتها من إجمالي _MAX_ عناصر)"

                            }
                        });
                    });

                    alreadyFound = true;

                }
            },
            error: function () {
                alert("Error occurred during the request.");
            }
        });
    });
    document.getElementById('searchButton').textContent = 'بحث';

    document.getElementById('searchButton').disabled = false;


    $(document).ready(function () {
        // Handler for the "Action" button

        $("#table").on("click", ".btn-primary", function () {
            const rowIndex = $(this).closest("tr").index();
            const item = generalRes[rowIndex];

            const roomNumber = $(this).closest("tr").find("td:eq(1)").text();


            $("#roomNo1").val(roomNumber);
            $("#roomNumber").text(roomNumber);


            console.log('Room');
            console.log(roomNumber);
            $("#day1").val(day);  // Replace dayValue with the actual value
            $("#startTime1").val(startDate); // Replace startTimeValue

            $("#endTime1").val(endDate);     // Replace endTimeValue
            $("#course").val("");     // Replace endTimeValue
            $("#sectionNumber").val("");     // Replace endTimeValue

            // Show the modal
            $("#roomModal").modal("show");

        });
    });

}

function searchSingleRooms(roomNumber, day, startDate, endDate) {
    reqType = 1;
    const noDataMessage = document.getElementById("noDataMessage");
    document.getElementById('bookRoom').disabled = true;
    document.getElementById('bookRoom').innerHTML = loading + 'جاري البحث';
    noDataMessage.style.display = 'none';
    var generalRes;
    $(document).ready(function () {
        $.ajax({
            type: "POST", // Use POST or GET based on your needs
            url: "get_single_room.php",
            data: {
                roomNo: roomNumber,
                day: day,
                startDate: startDate,
                endDate: endDate
            }, // Send data to the server
            success: function (response) {
                if (response.length === 0) {

                    document.getElementById('bookRoom').textContent = 'احجز';
                    document.getElementById('bookRoom').disabled = false;

                    if (alreadyFound) {
                        document.getElementById("table_wrapper").style.display = 'none';
                    }

                } else {
                    console.log(response);
                    generalRes = response;

                    const tableBody = document.getElementById("table-body");
                    tableBody.innerHTML = "";

                    response.forEach(function (item, index) {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = index + 1;
                        row.insertCell(1).textContent = item.roomNo;
                        row.insertCell(2).textContent = item.floor;
                        row.insertCell(3).textContent = item.capacity;

                        // Add a button in the last cell
                        const actionCell = row.insertCell(4);
                        const button = document.createElement("button");
                        button.className = "btn btn-primary";
                        button.textContent = "حجز";
                        actionCell.appendChild(button);
                    });


                    document.getElementById("table").style.visibility = 'visible';
                    document.getElementById('bookRoom').textContent = 'بحث';
                    document.getElementById('bookRoom').disabled = false;

                    $(document).ready(function () {

                        if (alreadyFound) {
                            console.log('Already found ');
                            var dataTable = $('#table').DataTable();
                            dataTable.destroy();
                        }
                        $('#table').DataTable({
                            paging: true, // Enable pagination
                            pageLength: 10, // Number of rows per page
                            lengthMenu: [5, 10, 15, 25, 50, 100], // Page length options
                            pagingType: 'full_numbers', // Pagination style
                            order: [], // Disable initial sorting
                            language: {
                                paginate: {
                                    first: 'الأولى',
                                    previous: 'السابقة',
                                    next: 'التالية',
                                    last: 'الأخيرة'
                                },
                                lengthMenu: "عرض _MENU_ في الصفحة",
                                search: "بحث:",
                                info: "عرض _START_ - _END_ من إجمالي _TOTAL_ عناصر",
                                infoEmpty: "عرض 0 إلى 0 من إجمالي 0 عناصر",
                                infoFiltered: "(تمت تصفيتها من إجمالي _MAX_ عناصر)"

                            }
                        });
                    });


                    alreadyFound = true;
                }
            },
            error: function (xhr) {
                var message;
                if (xhr.status === 404) {
                    message = "لايوجد غرفة بهذا الرقم";
                } else if (xhr.status === 409) {
                    message = "الغرفة ليست متاحة في هذا الوقت";
                } else {
                    message = "Server Error happened";
                }
                document.getElementById("table").style.visibility = 'hidden';

                noDataMessage.textContent = message;
                noDataMessage.style.display = 'block';
                document.getElementById("table").style.visibility = 'hidden';
                noDataMessage.style.color = 'red';
                document.getElementById('bookRoom').textContent = 'بحث';
                document.getElementById('bookRoom').disabled = false;

            }
        });
    });

    $("#table").on("click", ".btn-primary", function () {
        const rowIndex = $(this).closest("tr").index();

        const roomNumber = $(this).closest("tr").find("td:eq(1)").text();


        $("#roomNo1").val(roomNumber);
        $("#roomNumber").text(roomNumber);


        console.log('Room');
        console.log(roomNumber);
        $("#day1").val(day);  // Replace dayValue with the actual value
        $("#startTime1").val(startDate); // Replace startTimeValue

        $("#endTime1").val(endDate);     // Replace endTimeValue
        $("#course").val("");     // Replace endTimeValue
        $("#sectionNumber").val("");     // Replace endTimeValue

        // Show the modal
        $("#roomModal").modal("show");

    });


}

function closeModal() {
    $('#roomModal').modal('hide');
}

function reserveRoom() {
    console.log('Clicked');
    var formData = $('#reservationForm').serialize();

    const reserveBtn = document.getElementById('reserveButton');
    reserveBtn.disabled = true;
    reserveBtn.innerHTML = loading + 'جاري الحجز';


    // Make an AJAX request to reserve_room.php
    $.ajax({
        type: 'POST',
        url: 'reserve_room.php',
        data: formData,
        success: function (response) {
            // Handle the response from the server as needed
            console.log(response);
            $.notify(
                {
                    icon: 'bi bi-exclamation-circle',
                    title: 'Reserved Successfully'

                }, {
                    type: "success",
                    delay: 3000,
                    animate: {
                        enter: 'animate__animated animate__bounceInUp',
                        exit: 'animate__animated animate__bounceOutDown'
                    },

                });

            // Close the modal
            closeModal();
            if (reqType === 1) {
                var tr = document.getElementsByTagName("tr")[1];

                var lastTd = tr.lastChild;


                if (lastTd && lastTd.querySelector("button")) {
                    // Change the text of the button
                    var button = lastTd.querySelector("button");
                    button.textContent = "تم الحجز";
                    button.disabled = true;
                }
            }
        },
        error: function (error) {
            console.error('Error:', error);
            reserveBtn.disabled = false;
            reserveBtn.innerHTML = 'حجز';

        }
    });


    document.getElementById('closeModalButton').addEventListener('click', closeModal);
}