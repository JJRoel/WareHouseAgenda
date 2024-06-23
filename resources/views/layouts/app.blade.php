<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>

    @include('layouts.popup')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            // Items passed from the backend
            var items = @json($items);

            // Append "Available" as the first option
            $('#itemSelect').append(new Option("Available", ""));

            // Append items dynamically
            items.forEach(function(item) {
                $('#itemSelect').append(new Option(`${item.code}: ${item.name}`, item.id));
            });

            $('#itemSelect').on('change', function() {
                var selectedItem = items.find(item => item.id == this.value);
                $('#itemCode').val(selectedItem ? selectedItem.code : '');
                console.log('Selected item:', selectedItem); // Log selected item
            });

            // Function to show the popup with day details
            function showDayModal(day, month, year) {
                $('#dayDetails').text('Details for ' + day + '/' + month + '/' + year);
                $('#startDate').val(year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day));
                $('#endDate').val(year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day));
                $('#dayModal').modal('show');
            }

            // Attach click event to table cells with day numbers
            $('.day-cell').on('click', function() {
                var day = $(this).data('day');
                var month = $(this).data('month');
                var year = $(this).data('year');
                showDayModal(day, month, year);
            });

            $('#saveBooking').on('click', function() {
                var bookingData = {
                    item_id: $('#itemSelect').val(),
                    user_id: 1, // hardcoded for now, change to dynamic value later
                    start_date: $('#startDate').val(),
                    end_date: $('#endDate').val(),
                    _token: '{{ csrf_token() }}'
                };

                console.log('Booking data:', bookingData); // Log booking data

                $.ajax({
                    url: '{{ route("bookings.store") }}',
                    type: 'POST',
                    data: bookingData,
                    success: function(response) {
                        alert('Booking saved');
                        $('#dayModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection

</body>
</html>
