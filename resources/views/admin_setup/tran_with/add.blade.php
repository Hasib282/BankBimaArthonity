<div id="addModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading banner">
            <div class="center">
                <h3>Add {{ $name }}</h3>
                <span class="close-modal" data-modal-id="addModal">&times;</span>
            </div>
        </div>

        <!-- form start -->
        <form id="AddForm" method="post">
            @csrf
            <div class="form-input-group">
                <label for="name">Tran With Name <span class="required" title="Required">*</span></label>
                <input type="text" name="name" class="form-input" id="name">
                <span class="error" id="name_error"></span>
            </div>

            @if(Request::segment(1) == 'admin')
                <div class="form-input-group">
                    <label for="role">User Role <span class="required" title="Required">*</span></label>
                    <select name="role" id="role">
                        {{-- options will be import dynamically --}}
                    </select>
                    <span class="error" id="role_error"></span>
                </div>
                <div class="form-input-group">
                    <label for="tranType">Transaction Type <span class="required" title="Required">*</span></label>
                    <select name="tranType" id="tranType">
                        {{-- options will be import dynamically --}}
                    </select>
                    <span class="error" id="tranType_error"></span>
                </div>
                <div class="form-input-group">
                    <label for="tranMethod">Transaction Method <span class="required" title="Required">*</span></label>
                    <select name="tranMethod" id="tranMethod">
                        <option value="">Select Transaction Method</option>
                        <option value="Receive">Receive</option>
                        <option value="Payment">Payment</option>
                        <option value="Both">Both</option>
                    </select>
                    <span class="error" id="tranMethod_error"></span>
                </div>
            @elseif(Request::segment(1) == 'transaction' || Request::segment(1) == 'inventory' || Request::segment(1) == 'pharmacy')
                <div class="form-input-group">
                    <label for="role">User Role <span class="required" title="Required">*</span></label>
                    <select name="role" id="role">
                        <option value="">Select Role</option>
                        <option value="4">Client</option>
                        <option value="5">Supplier</option>
                    </select>
                    <span class="error" id="role_error"></span>
                </div>
                <div class="form-input-group">
                    <label for="tranMethod">Transaction Method <span class="required" title="Required">*</span></label>
                    <select name="tranMethod" id="tranMethod">
                        <option value="">Select Transaction Method</option>
                        <option value="Receive">Receive</option>
                        <option value="Payment">Payment</option>
                        <option value="Both">Both</option>
                    </select>
                    <span class="error" id="tranMethod_error"></span>
                </div>
            @endif

            @if (auth()->user()->user_role == 1)
                <div class="form-input-group">
                    <label for="company">Company <span class="required" title="Required">*</span></label>
                    <input type="text" name="company" class="form-input" id="company" autocomplete="off">
                    <div id="company-list">
                        <ul>

                        </ul>
                    </div>
                    <span class="error" id="company_error"></span>
                </div>
            @else
                <input type="text" name="company" class="form-input" id="company" data-id="{{auth()->user()->company_id}}" style="display: none">
            @endif

            <div class="center">
                <button type="submit" id="Insert" class="btn-blue">Submit</button>
            </div>
        </form>
    </div>
</div>