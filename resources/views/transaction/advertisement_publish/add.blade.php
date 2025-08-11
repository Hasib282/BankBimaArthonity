<div id="addModal" class="modal-container">
    <div class="modal-subject">
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
           {{-- Publication Date  --}}
            <div class="form-input-group">
                <label for="publication_date">Publication Date </label>
                <input type="Date" name="publication_date" class="form-input" id="publication_date" autocomplete="off">
                <span class="error" id="publication_date_error"></span>
            </div>

            {{-- Client name  --}}
            <div class="form-input-group">
                <label for="user">Client ID</label>
                <input type="text" name="user" class="form-input" id="user" autocomplete="off">
                <div id="user-list"></div>
                <span class="error" id="user_error"></span>
            </div>
            
            {{-- title  --}}
            <div class="form-input-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-input" id="title" autocomplete="off">
                <span class="error" id="title_error"></span>
            </div>

            {{-- Caption --}}
            <div class="form-input-group">
                <label for="caption">Caption</label>
                <input type="text" name="caption" class="form-input" id="caption" autocomplete="off">
                <span class="error" id="caption_error"></span>
            </div>

            {{-- category --}}
            <div class="form-input-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-input" id="category" autocomplete="off">
                <span class="error" id="category_error"></span>
            </div>


             {{-- page_on --}}
            <div class="form-input-group">
                <label for="updatepage_on">Page_on</label>
                <input type="text" name="page_on" class="form-input" id="page_on" autocomplete="off">
                <span class="error" id="page_on_error"></span>
            </div>

             {{-- column_inch --}}
            <div class="form-input-group">
                <label for="column_inch">Column_inch</label>
                <input type="text" name="column_inch" class="form-input" id="column_inch" autocomplete="off">
                <span class="error" id="column_inch_error"></span>
            </div>


             {{-- type --}}
            <div class="form-input-group">
                <label for="type">Type</label>
                <input type="text" name="type" class="form-input" id="type" autocomplete="off">
                <span class="error" id="type_error"></span>
            </div>


             {{-- discount --}}
            <div class="form-input-group">
                <label for="discount">Discount</label>
                <input discount="text" name="discount" class="form-input" id="discount" autocomplete="off">
                <span class="error" id="discount_error"></span>
            </div>


           

            <div class="center">
                <button type="submit" class="btn-blue" id="Insert">Submit</button>
            </div>
        </form>
    </div>
</div>