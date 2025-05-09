<div id="editModal" class="modal-container">
    <div class="modal-subject" style="width: 40%;">
        <div class="modal-heading banner">
            <div class="center">
                <h3>Edit {{ $name }}</h3>
                <span class="close-modal" data-modal-id="editModal">&times;</span>
            </div>
        </div>
        <!-- form start -->
        <form id="EditForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id">
            <div class="form-input-group">
                <label for="updateName">Bank Name <span class="required" title="Required">*</span></label>
                <input type="text" name="name" class="form-input" id="updateName">
                <span class="error" id="update_name_error"></span>
            </div>
            <div class="form-input-group">
                <label for="updateEmail">Email <span class="required" title="Required">*</span></label>
                <input type="text" name="email" class="form-input" id="updateEmail">
                <span class="error" id="update_email_error"></span>
            </div>
            <div class="form-input-group">
                <label for="updatePhone">Phone <span class="required" title="Required">*</span></label>
                <input type="text" name="phone" class="form-input" id="updatePhone">
                <span class="error" id="update_phone_error"></span>
            </div>
            <div class="form-input-group">
                <label for="updateDivision">Division <span class="required" title="Required">*</span></label>
                <select name="division" id="updateDivision">

                </select>
                <span class="error" id="update_division_error"></span>
            </div>
            <div class="form-input-group">
                <label for="updateLocation">Location <span class="required" title="Required">*</span></label>
                <input type="text" name="location" class="form-input" id="updateLocation" autocomplete="off">
                <div id="update-location">
                    <ul>

                    </ul>
                </div>
                <span class="error" id="update_location_error"></span>
            </div>
            <div class="form-input-group">
                <label for="updateAddress">Address <span class="required" title="Required">*</span></label>
                <input type="text" name="address" class="form-input" id="updateAddress">
                <span class="error" id="update_address_error"></span>
            </div>
            <div class="center">
                <button type="submit" class="btn-blue" id="Update">Update</button>
            </div>
        </form>
    </div>
</div>