<div id="editModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading banner">
            <div class="center">
                <h3 class="card-title">Edit {{ $name }}</h3>
                <span class="close-modal" data-modal-id="editModal">&times;</span>
            </div>
        </div>

        <!-- form start -->
        <form id="EditForm" method="post">
            @csrf
            @method('PUT')
            {{-- id  --}}
            <input type="hidden" name="id" id="id">
            {{-- name --}}
            <div class="form-input-group">
                <label for="updateName">Tran With Name <span class="required" title="Required">*</span></label>
                <input type="text" name="name" class="form-input" id="updateName">
                <span class="error" id="update_name_error"></span>
            </div>

            @if(Request::segment(1) == 'admin' || Request::segment(1) == 'inventory' || Request::segment(1) == 'pharmacy') 
                {{-- role --}}
                <div class="form-input-group">
                    <label for="updateRole">User Role <span class="required" title="Required">*</span></label>
                    <select name="role" id="updateRole">
                        <option value="">Select Role</option>
                        <option value="4">Client</option>
                        <option value="5">Supplier</option>
                    </select>
                    <span class="error" id="update_role_error"></span>
                </div>
                {{-- method  --}}
                <div class="form-input-group">
                    <label for="updateTranMethod">Transaction Method <span class="required" title="Required">*</span></label>
                    <select name="tranMethod" id="updateTranMethod">
                        <option value="">Select Transaction Method</option>
                        <option value="Receive">Receive</option>
                        <option value="Payment">Payment</option>
                        <option value="Both">Both</option>
                    </select>
                    <span class="error" id="update_tranMethod_error"></span>
                </div>
            @endif

            

            <div class="center">
                <button type="submit" id="Update" class="btn-blue">Update</button>
            </div>
        </form>
    </div>
</div>