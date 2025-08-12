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
           {{-- Reporter id  --}}
            <div class="form-input-group">
                <label for="reporter_id">Reporter</label>
                <input type="text" name="reporter_id" class="form-input" id="reporter_id" autocomplete="off"><hr>
                <div id="reporter_id-list"></div>
                <span class="error" id="reporter_error"></span>
            </div>
            
            {{-- title  --}}
            <div class="form-input-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-input" id="title" autocomplete="off">
                <span class="error" id="title_error"></span>
            </div>
            {{-- Description --}}
            <div class="form-input-group">
                <label for="Description">Description</label>
                <input type="text" name="description" class="form-input" id="Description" autocomplete="off">
                <span class="error" id="description_error"></span>
            </div>

            {{-- Upload File --}}
            <div class="form-input-group">
                <label for="upload_file">Upload File</label>
                <input type="file" name="upload_file" class="form-input" id="upload_file" accept=".pdf,.doc,.docx">
                <span class="error" id="upload_file_error"></span>
            </div>

            <div class="center">
                <button type="submit" class="btn-blue" id="Insert">Submit</button>
            </div>
        </form>
    </div>
</div>