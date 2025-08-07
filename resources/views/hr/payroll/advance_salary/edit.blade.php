<div id="editModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading banner">
            <div class="center">
                <h3 class="card-title">Edit {{ $name }}</h3>
                <span class="close-modal" data-modal-id="editModal">&times;</span>
            </div>
        </div>
        <!-- form start -->
        <form id="EditForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- id  --}}
            <input type="hidden" name="id" id="id">
            {{-- Payment Date --}}
            <div class="form-input-group">
                <label for="updatePayment_date">Payment Date</label>
                <input type="date" name="payment_date" class="form-input" id="updatePayment_date" autocomplete="off"><hr>
                <span class="error" id="update_payment_date_error"></span>
            </div>
            {{-- employee type --}}
            <div class="form-input-group">   
                <label for="updateType">Employee Type <span class="required" title="Required">*</span></label>
                <select name="type" id="updateType">
                    
                </select>
                <span class="error" id="update_type_error"></span>
            </div>
            {{-- name --}}
            <div class="form-input-group">
                <label for="updateUser">Employee Name</label>
                <input type="text" name="user" class="form-input" id="updateUser" autocomplete="off"><hr>
                <div id="update-user"></div>
                <span class="error" id="update_emp_id_error"></span>
            </div>
            {{-- amount --}}
            <div class="form-input-group">
                <label for="updateAmount">Amount</label>
                <input type="text" name="amount" class="form-input" id="updateAmount">
                <span class="error" id="update_amount_error"></span>
            </div>
            {{-- Months --}}
            <div class="form-input-group">
                <label>Select Months</label>
                <div class="rows">
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="1"> January</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="2"> February</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="3"> March</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="4"> April</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="5"> May</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="6"> June</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="7"> July</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="8"> August</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="9"> September</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="10"> October</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="11"> November</label><br>
                    <label class="c-3"><input type="checkbox" class="months" name="months[]" value="12"> December</label><br>
                </div>
                <span class="error" id="update_months_error"></span>
            </div>
            {{-- Month --}}
            <div class="form-input-group">
                <label for="updateMonth">Select Start Month</label>
                <select name="month" id="updateMonth">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <span class="error" id="update_month_error"></span>
            </div>
            {{-- repayment method --}}
            <div class="form-input-group">
                <label for="updateMethod">Repayment Method</label>
                <select name="method" id="updateMethod">
                    <option value="Full">Full</option>
                    <option value="Installment">Installment</option>
                </select>
                <span class="error" id="update_method_error"></span>
            </div>
            {{-- installment amount --}}
            <div class="form-input-group">
                <label for="updateInstallment_amount">Installment amount</label>
                <input type="number" name="installment_amount" class="form-input" id="updateInstallment_amount" autocomplete="off"><hr>
                <span class="error" id="update_installment_amount_error"></span>
            </div>
            {{-- Approved By --}}
            <div class="form-input-group">
                <label for="updateApproved_by">Approved By</label>
                <input type="text" name="approved_by" class="form-input" id="updateApproved_by" autocomplete="off"><hr>
                <div id="update-approved_by"></div>
                <span class="error" id="update_approved_by_error"></span>
            </div>
            {{-- Reason --}}
            <div class="form-input-group">
                <label for="updateReason">Reason</label>
                <textarea name="reason" id="updateReason" cols="30" rows="5"></textarea>
                <span class="error" id="update_reason_error"></span>
            </div>
            <div class="center">
                <button type="submit" class="btn-blue" id="Update">Update</button>
            </div>
        </form>
    </div>
</div>