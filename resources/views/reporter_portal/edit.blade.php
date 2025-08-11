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
              {{-- Reporter id  --}}
            <div class="form-input-group">
                <label for="updateReporter_id">Reporter id</label>
                <input type="text" name="reporter_id" class="form-input" id="updateReporter_id" autocomplete="off">
                <span class="error" id="update_reporter_id_error"></span>
            </div>
            
            {{-- title  --}}
            <div class="form-input-group">
                <label for="updateTitle">title</label>
                <input type="text" name="title" class="form-input" id="updateTitle" autocomplete="off">
                <span class="error" id="update_title_error"></span>
            </div>
            {{-- Description --}}
            <div class="form-input-group">
                <label for="updateDescription">Description</label>
               <input type="text" name="description" class="form-input" id="updateDescription" autocomplete="off">


                <span class="error" id="update_description_error"></span>
            </div>

            {{-- Upload File --}}
            <div class="form-input-group">
                <label for="updateUpload_file">Upload File</label>
                <input type="file" name="upload_file" class="form-input" id="updateUpload_file" accept=".pdf,.doc,.docx">
                <span class="error" id="update_upload_file_error"></span>
            </div>

            <div class="center">
                <button type="submit" class="btn-blue" id="Update">Update</button>
            </div>
        </form>
    </div>
</div>