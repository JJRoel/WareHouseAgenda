<div class="modal fade" id="dayModal" tabindex="-1" role="dialog" aria-labelledby="dayModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dayModalLabel">Book an Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="form-group">
                        <label for="itemSelect">Item</label>
                        <select class="form-control" id="itemSelect">
                            <option value="" selected disabled>Available</option>
                            <!-- Options will be dynamically loaded -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="itemCode">Code</label>
                        <input type="text" class="form-control" id="itemCode" readonly>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate">
                    </div>
                </form>
                <p id="dayDetails"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBooking">Save changes</button>
            </div>
        </div>
    </div>
</div>
