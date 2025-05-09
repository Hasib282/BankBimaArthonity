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
                <label for="headName">Head Name <span class="required" title="Required">*</span></label>
                <input type="text" name="headName" class="form-input" id="headName">
                <span class="error" id="headName_error"></span>
            </div>

            @if (Request::segment(1) != 'hr')
                <div class="form-input-group">
                    <label for="groupe">Transaction Groupe <span class="required" title="Required">*</span></label>
                    <select name="groupe" id="groupe">
                        {{-- options will be display dynamically --}}
                    </select>
                    <span class="error" id="groupe_error"></span>
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