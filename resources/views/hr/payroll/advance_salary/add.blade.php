<div id="addModal" class="modal-container">
    <div class="modal-subject" style="width:">
        <div class="modal-heading banner">
            <div class="center">
                <h3>Add {{ $name }}</h3>
                <span class="close-modal" data-modal-id="addModal">&times;</span>
            </div>
        </div>

        
        
        <!-- form start -->
        <form id="AddForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- Payment Date --}}
            <div class="form-input-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" name="payment_date" class="form-input" id="payment_date" autocomplete="off" value="{{date('Y-m-d')}}"><hr>
                <span class="error" id="payment_date_error"></span>
            </div>
            {{-- employee type --}}
            <div class="form-input-group">   
                <label for="type">Employee Type <span class="required" title="Required">*</span></label>
                <select name="type" id="type">
                    
                </select>
                <span class="error" id="type_error"></span>
            </div>
            {{-- name --}}
            <div class="form-input-group">
                <label for="user">Employee Name</label>
                <input type="text" name="user" class="form-input" id="user" autocomplete="off"><hr>
                <div id="user-list"></div>
                <span class="error" id="emp_id_error"></span>
            </div>
            {{-- amount --}}
            <div class="form-input-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" class="form-input" id="amount">
                <span class="error" id="amount_error"></span>
            </div>
            {{-- Months --}}
            <div class="form-input-group">
                <label>Select Months</label>
                <div class="rows">
                    <label class="c-3"><input type="checkbox" name="months[]" value="1"> January</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="2"> February</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="3"> March</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="4"> April</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="5"> May</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="6"> June</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="7"> July</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="8"> August</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="9"> September</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="10"> October</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="11"> November</label><br>
                    <label class="c-3"><input type="checkbox" name="months[]" value="12"> December</label><br>
                </div>
                <span class="error" id="months_error"></span>
            </div>
            {{-- Month --}}
            <div class="form-input-group">
                <label for="month">Select Start Month</label>
                <select name="month" id="month">
                    <option value="1"  {{ date('m') == '01' ? 'selected' : '' }}>January</option>
                    <option value="2"  {{ date('m') == '02' ? 'selected' : '' }}>February</option>
                    <option value="3"  {{ date('m') == '03' ? 'selected' : '' }}>March</option>
                    <option value="4"  {{ date('m') == '04' ? 'selected' : '' }}>April</option>
                    <option value="5"  {{ date('m') == '05' ? 'selected' : '' }}>May</option>
                    <option value="6"  {{ date('m') == '06' ? 'selected' : '' }}>June</option>
                    <option value="7"  {{ date('m') == '07' ? 'selected' : '' }}>July</option>
                    <option value="8"  {{ date('m') == '08' ? 'selected' : '' }}>August</option>
                    <option value="9"  {{ date('m') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ date('m') == '10' ? 'selected' : '' }}>October</option>
                    <option value="11" {{ date('m') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ date('m') == '12' ? 'selected' : '' }}>December</option>
                </select>
                <span class="error" id="month_error"></span>
            </div>
            {{-- repayment method --}}
            <div class="form-input-group">
                <label for="method">Repayment Method</label>
                <select name="method" id="method">
                    <option value="Full">Full</option>
                    <option value="Installment">Installment</option>
                </select>
                <span class="error" id="method_error"></span>
            </div>
            {{-- installment amount --}}
            <div class="form-input-group">
                <label for="installment_amount">Installment amount</label>
                <input type="number" name="installment_amount" class="form-input" id="installment_amount" autocomplete="off"><hr>
                <span class="error" id="installment_amount_error"></span>
            </div>
            {{-- Approved By --}}
            <div class="form-input-group">
                <label for="approved_by">Approved By</label>
                <input type="text" name="approved_by" class="form-input" id="approved_by" autocomplete="off"><hr>
                <div id="approved_by-list"></div>
                <span class="error" id="approved_by_error"></span>
            </div>
            {{-- Reason --}}
            <div class="form-input-group">
                <label for="reason">Reason</label>
                <textarea name="reason" id="reason" cols="30" rows="5"></textarea>
                <span class="error" id="reason_error"></span>
            </div>

            <div class="center">
                <button type="submit" class="btn-blue" id="Insert">Submit</button>
            </div>
        </form>
    </div>
</div>