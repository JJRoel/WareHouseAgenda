@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        @php
            $prevMonth = $thisMonth - 1;
            $prevYear = $thisYear;
            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear -= 1;
            }
            $nextMonth = $thisMonth + 1;
            $nextYear = $thisYear;
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear += 1;
            }
            $prevMonthName = \Carbon\Carbon::create($prevYear, $prevMonth)->format('F');
            $nextMonthName = \Carbon\Carbon::create($nextYear, $nextMonth)->format('F');
        @endphp

        <a href="{{ url('/items/' . $item->name . '?thismonth=' . $prevMonth . '&thisyear=' . $prevYear) }}" class="btn btn-secondary">{{ $prevMonthName }}</a>
        <h1 class="text-center">{{ $monthName }} {{ $thisYear }}</h1>
        <a href="{{ url('/items/' . $item->name . '?thismonth=' . $nextMonth . '&thisyear=' . $nextYear) }}" class="btn btn-secondary">{{ $nextMonthName }}</a>
    </div>
    <h1 class="mt-4 mb-4">{{ $item->name }}</h1>
    
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Maandag</th>
                <th>Dinsdag</th>
                <th>Woensdag</th>
                <th>Donderdag</th>
                <th>Vrijdag</th>
                <th>Zaterdag</th>
                <th>Zondag</th>
            </tr>
        </thead>
        <tbody>
            @php
                $firstDayOfMonth = \Carbon\Carbon::create($thisYear, $thisMonth, 1)->dayOfWeek;
                // Adjust firstDayOfMonth to start from Monday as 0
                $firstDayOfMonth = ($firstDayOfMonth + 6) % 7;
                $daysInMonth = \Carbon\Carbon::create($thisYear, $thisMonth)->daysInMonth;
                $dayCounter = 1;
                $printedDays = 0;
            @endphp
            @for ($week = 0; $week < 6; $week++)
                <tr>
                    @for ($day = 0; $day < 7; $day++)
                        @if ($week == 0 && $day < $firstDayOfMonth)
                            <td></td>
                        @elseif ($dayCounter > $daysInMonth)
                            <td></td>
                        @else
                            <td class="text-center day-cell" data-day="{{ $dayCounter }}" data-month="{{ $thisMonth }}" data-year="{{ $thisYear }}">
                                <strong>{{ $dayCounter }}</strong>
                                <ul class="list-unstyled">
                                    @foreach ($agendaItems as $agendaItem)
                                        @if (\Carbon\Carbon::create($thisYear, $thisMonth, $dayCounter)->isSameDay($agendaItem->start_date))
                                            <li>{{ $agendaItem->titre }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            @php $dayCounter++; $printedDays++; @endphp
                        @endif
                    @endfor
                @if ($printedDays >= $daysInMonth)
                    @break
                @endif
                </tr>
            @endfor
        </tbody>
    </table>

    <h2 class="mt-5">Your Bookings for {{ $monthName }} {{ $thisYear }}</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userBookings as $booking)
                <tr>
                    <td>{{ $booking->item->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No bookings for this month.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ url('/') }}" class="btn btn-primary">Terug naar Items</a>

    <!-- Add the booking modal here -->
    <div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dayModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="itemSelect" class="form-label">Select Item</label>
                            <select class="form-select" id="itemSelect">
                                <!-- Options will be appended here by JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                        <button type="button" id="saveBooking" class="btn btn-primary">Save Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

            // Add hover effect to day cells
            $('.day-cell').css('cursor', 'pointer');

            $('#saveBooking').on('click', function() {
                var itemSelectVal = $('#itemSelect').val();
                var bookingData = {
                    user_id: 1, // hardcoded for now, change to dynamic value later
                    start_date: $('#startDate').val(),
                    end_date: $('#endDate').val(),
                    _token: '{{ csrf_token() }}'
                };

                if (itemSelectVal) {
                    bookingData.item_id = itemSelectVal;
                } else {
                    bookingData.item_name = '{{ $item->name }}';
                }

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
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message); // Show custom error message
                    }
                });
            });
        });
    </script>
@endsection
