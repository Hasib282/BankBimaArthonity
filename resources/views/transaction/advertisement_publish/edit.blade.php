<div id="editModal" class="modal-container">
    <div class="modal-subject" style="width: 80%;margin:0 auto;padding:0;">
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
            <div class="rows">
          {{--  Publication Date --}}
            <div class="c-4">
                            
                    <div class="form-input-group">
                        <label for="updatepublication_date">Publication Date </label>
                        <input type="Date" name="publication_date" class="form-input" id="updatepublication_date" autocomplete="off">
                        <span class="error" id="update_publication_date_error"></span>
                    </div> 
                
            </div>

            {{-- Client name --}}
            <div class="c-8">
                    <div class="form-input-group">
                        <label for="updateuser">Client ID</label>
                        <input type="text" name="user" class="form-input" id="updateuser" autocomplete="off">
                        <div id="user-list"></div>
                        <span class="error" id="update_user_error"></span>
                    </div> 
            </div> 
            
            {{-- title  --}}
            <div class="c-6">
                <div class="form-input-group">
                    <label for="updatetitle">Title</label>
                    <input type="text" name="title" class="form-input" id="updatetitle" autocomplete="off">
                    <span class="error" id="update_title_error"></span>
                </div>
            </div>

            {{-- Caption --}}
            <div class="c-6">
                <div class="form-input-group">
                    <label for="updatecaption">Caption</label>
                    <input type="text" name="caption" class="form-input" id="updatecaption" autocomplete="off">
                    <span class="error" id="update_caption_error"></span>
                </div>
            </div>

            {{-- category --}}
            <div class="c-6">
                <div class="form-input-group">
                    <label for="updatecategory">Category</label>
                    <input type="text" name="category" class="form-input" id="updatecategory" autocomplete="off">
                    <span class="error" id="updat_ecategory_error"></span>
                </div>
            </div>


             {{-- page_on  --}}
            <div class="c-6">
                <div class="form-input-group">
                    <label for="updatePage_no">Page no</label>
                <input type="text" name="page_no" id="updatePage_no" class="form-input" autocomplete="off">
                    <span class="error" id="update_page_no_error"></span>
                </div>
            </div>

             {{-- column_inch --}}
            <div class="c-6">
                <div class="form-input-group">
                    <label for="column_inch">Column_inch</label>
                    <input type="text" name="column_inch" class="form-input" id="updatecolumn_inch" autocomplete="off">
                    <span class="error" id="update_column_inch_error"></span>
                </div>
            </div>


             {{-- type --}}
            <div class="c-6">
                <div class="form-input-group">
                    <label for="type">Type</label>
                    <input type="text" name="type" class="form-input" id="updatetype" autocomplete="off">
                    <span class="error" id="update_type_error"></span>
                </div>
            
            </div>


            {{-- discount --}}
            <div class="c-6"> 
            <class="form-input-group">
                <label for="discount">Discount</label>
                <input discount="text" name="discount" class="form-input" id="updatediscount" autocomplete="off">
                <span class="error" id="update_discount_error"></span>
            
            </div>
            
            </div>


                
                
                
               
               <div class="rows">
                
               
                <div class="c-1">
                    {{-- quantity --}}
                    <div class="form-input-group">
                        <label for="updatequantity">QTY</label>
                        <input type="text" name="quantity" class="form-input" id="updatequantity" autocomplete="off" value="1">
                        <span class="error" id="updatequantity_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- price --}}
                    <div class="form-input-group">
                        <label for="updateprice">Price</label>
                        <input type="text" name="price" class="form-input" id="updateprice" autocomplete="off">
                        <span class="error" id="updateprice_error"></span>
                    </div>
                </div>
                <div class="c-2">
                    {{-- total --}}
                    <div class="form-input-group">
                        <label for="updatetotal">Total</label>
                        <input type="text" name="total" class="form-input" id="updatetotal" autocomplete="off">
                        <span class="error" id="updatetotal_error"></span>
                    </div>
                </div>
              
                <div class="c-2">
                    {{-- advance --}}
                    <div class="form-input-group">
                        <label for="updateadvance">Advance</label>
                        <input type="text" name="advance" class="form-input" id="updateadvance" autocomplete="off" value="0">
                        <span class="error" id="updateadvance_error"></span>
                    </div>
                </div>
                {{--PaymentMethod --}}
                <div class="c-4">
                    <div class="form-input-group">
                        <label for="updatePayment_method">Payment Method<span class="required" title="Required">*</span></label>
                        <select name="payment_method" id="updatePayment_method">
                            {{-- options will be display dynamically --}}
                        </select>
                        <span class="error" id="update_payment_method_error"></span>
                    </div>
                </div>
                {{--note--}}
                <div class="c-12">
                    <div class="form-input-group">
                        <label for="updatenote">Note</label>
                        <textarea  name="note" id="updatenote" cols="30" rows="7" autocomplete="off"></textarea><hr>
                        <div id="note-list"></div>
                        <span class="error" id="updatenote_error"></span>
                    </div>
                </div>
                {{--document--}}
                <div class="c-12">
                    <div class="form-input-group">
                        <label for="updatedocument">Document / Pdf</label>
                        <input type="file" name="document" id="document">
                        <span class="error" id="updatedocument_error"></span>
                    </div>
                </div>
            </div>
           
            <div class="center">
                <button type="submit" class="btn-blue" id="Update">Update</button>
            </div>
        </form>
    </div>
</div>