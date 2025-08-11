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

             {{-- Publication Date  --}}
            <div class="form-input-group">
                <label for="updatepublication_date">Publication Date </label>
                <input type="Date" name="publication_date" class="form-input" id="updatepublication_date" autocomplete="off">
                <span class="error" id="update_publication_date_error"></span>
            </div>

            {{-- Client name  --}}
            <div class="form-input-group">
                <label for="updateuser">Client ID</label>
                <input type="text" name="user" class="form-input" id="updateuser" autocomplete="off">
                <div id="user-list"></div>
                <span class="error" id="update_user_error"></span>
            </div>
            
            {{-- title  --}}
            <div class="form-input-group">
                <label for="updatetitle">Title</label>
                <input type="text" name="title" class="form-input" id="updatetitle" autocomplete="off">
                <span class="error" id="update_title_error"></span>
            </div>

            {{-- Caption --}}
            <div class="form-input-group">
                <label for="updatecaption">Caption</label>
                <input type="text" name="caption" class="form-input" id="updatecaption" autocomplete="off">
                <span class="error" id="update_caption_error"></span>
            </div>

            {{-- category --}}
            <div class="form-input-group">
                <label for="updatecategory">Category</label>
                <input type="text" name="category" class="form-input" id="updatecategory" autocomplete="off">
                <span class="error" id="updat_ecategory_error"></span>
            </div>


             {{-- page_on --}}
            <div class="form-input-group">
                <label for="updatePage_no">Page no</label>
               <input type="text" name="page_no" id="updatePage_no" class="form-input" autocomplete="off">
                <span class="error" id="update_page_no_error"></span>
            </div>

             {{-- column_inch --}}
            <div class="form-input-group">
                <label for="column_inch">Column_inch</label>
                <input type="text" name="column_inch" class="form-input" id="updatecolumn_inch" autocomplete="off">
                <span class="error" id="update_column_inch_error"></span>
            </div>


             {{-- type --}}
            <div class="form-input-group">
                <label for="type">Type</label>
                <input type="text" name="type" class="form-input" id="updatetype" autocomplete="off">
                <span class="error" id="update_type_error"></span>
            </div>


             {{-- discount --}}
            <div class="form-input-group">
                <label for="discount">Discount</label>
                <input discount="text" name="discount" class="form-input" id="updatediscount" autocomplete="off">
                <span class="error" id="update_discount_error"></span>
            </div>
           
            <div class="center">
                <button type="submit" class="btn-blue" id="Update">Update</button>
            </div>
        </form>
    </div>
</div>