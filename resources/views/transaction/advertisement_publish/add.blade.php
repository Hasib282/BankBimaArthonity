<div id="addModal" class="modal-container">
    <div class="modal-subject" style="width: 80%;margin:0 auto;padding:0;">
        <div class="modal-heading banner">
            <div class="center">
                <h3 class="card-title">Add {{ $name }}</h3>
                <span class="close-modal" data-modal-id="addModal">&times;</span>
            </div>
        </div>

        
        <!-- form start -->
        <form id="AddForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- within --}}
            <div id="within" style="display: none"> </div>
            {{-- groupein --}}
            <div id="groupein" style="display: none"> </div>

            <div class="rows">
                <div class="c-4">
                    {{-- Publication Date  --}}
                    <div class="form-input-group">
                        <label for="publication_date">Publication Date </label>
                        <input type="Date" name="publication_date" class="form-input" id="publication_date" autocomplete="off" value="{{date('Y-m-d')}}">
                        <span class="error" id="publication_date_error"></span>
                    </div>
                </div>
                <div class="c-8">
                    {{-- Client name  --}}
                    <div class="form-input-group">
                        <label for="user">Client ID</label>
                        <input type="text" name="user" class="form-input" id="user" autocomplete="off"><hr>
                        <div id="user-list"></div>
                        <span class="error" id="user_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    {{-- title  --}}
                    <div class="form-input-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-input" id="title" autocomplete="off">
                        <span class="error" id="title_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    {{-- Caption --}}
                    <div class="form-input-group">
                        <label for="caption">Caption</label>
                        <input type="text" name="caption" class="form-input" id="caption" autocomplete="off">
                        <span class="error" id="caption_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    {{-- column_inch --}}
                    <div class="form-input-group">
                        <label for="head">Column_inch</label>
                        <input type="text" name="column_inch" class="form-input" id="head" autocomplete="off"><hr>
                        <div id="head-list"></div>
                        <span class="error" id="column_inch_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- category --}}
                    <div class="form-input-group">
                        <label for="category">Category</label>
                        <input type="text" name="category" class="form-input" id="category" autocomplete="off">
                        <span class="error" id="category_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- page_on --}}
                    <div class="form-input-group">
                        <label for="page_no">Page no</label>
                        <input type="text" name="page_no" class="form-input" id="page_no" autocomplete="off">
                        <span class="error" id="page_no_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- type --}}
                    <div class="form-input-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" class="form-input" id="type" autocomplete="off">
                        <span class="error" id="type_error"></span>
                    </div>
                </div>
                <div class="c-1">
                    {{-- quantity --}}
                    <div class="form-input-group">
                        <label for="quantity">QTY</label>
                        <input type="text" name="quantity" class="form-input" id="quantity" autocomplete="off" value="1">
                        <span class="error" id="quantity_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- price --}}
                    <div class="form-input-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-input" id="price" autocomplete="off">
                        <span class="error" id="price_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- total --}}
                    <div class="form-input-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" class="form-input" id="total" autocomplete="off">
                        <span class="error" id="total_error"></span>
                    </div>
                </div>
                <div class="c-1">
                    {{-- discount --}}
                    <div class="form-input-group">
                        <label for="discount">Discount</label>
                        <input type="text" name="discount" class="form-input" id="discount" autocomplete="off" value="0">
                        <span class="error" id="discount_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- advance --}}
                    <div class="form-input-group">
                        <label for="advance">Advance</label>
                        <input type="text" name="advance" class="form-input" id="advance" autocomplete="off" value="0">
                        <span class="error" id="advance_error"></span>
                    </div>
                </div>
                {{--PaymentMethod --}}
                <div class="c-4">
                    <div class="form-input-group">
                        <label for="payment_method">Payment Method<span class="required" title="Required">*</span></label>
                        <select name="payment_method" id="payment_method">
                            {{-- options will be display dynamically --}}
                        </select>
                        <span class="error" id="payment_method_error"></span>
                    </div>
                </div>
                {{--note--}}
                <div class="c-12">
                    <div class="form-input-group">
                        <label for="note">Note</label>
                        <textarea  name="note" id="note" cols="30" rows="7" autocomplete="off"></textarea><hr>
                        <div id="note-list"></div>
                        <span class="error" id="note_error"></span>
                    </div>
                </div>
                {{--document--}}
                <div class="c-12">
                    <div class="form-input-group">
                        <label for="document">Document / Pdf</label>
                        <input type="file" name="document" id="document">
                        <span class="error" id="document_error"></span>
                    </div>
                </div>
            </div>
            <div class="center">
                <button type="submit" class="btn-blue" id="Insert">Submit</button>
            </div>
        </form>
    </div>
</div>