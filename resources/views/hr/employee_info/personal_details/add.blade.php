<div id="addModal" class="modal-container">
    <div class="modal-subject" style="width: 80%;">
        <div class="modal-heading banner">
            <div class="center">
                <h3>Add Employee Personal Detail</h3>
                <span class="close-modal" data-modal-id="addModal">&times;</span>
            </div>
        </div>
        
        <!-- form start -->
        <form id="AddForm" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Personal Details Section --> 
            <div class="rows">
                <div class="c-6">  
                    <div class="form-input-group">   
                        <label for="type">Employee Type <span class="required" title="Required">*</span></label>
                        <select name="type" id="type">
                            {{-- <option value="">Select Employee Type</option>
                            @foreach ($tranwith as $with)
                                <option value="{{$with->id}}">{{$with->tran_with_name}}</option>                                                
                            @endforeach --}}
                        </select>
                        <span class="error" id="type_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "name">Name <span class="required" title="Required">*</span></label>
                        <input type="text" name="name" id="name" class="form-input">
                        <span class="error" id="name_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "fathers_name">Father's Name</label>
                        <input type="text" name="fathers_name" id="fathers_name" class="form-input">
                        <span class="error" id="fathers_name_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "mothers_name">Mother's Name</label>
                        <input type="text" name="mothers_name" id="mothers_name" class="form-input">
                        <span class="error" id="mothers_name_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "dob">Date of Birth </label>
                        <input type="date" name="dob" id="dob" class="form-input">
                        <span class="error" id="dob_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "gender">Gender <span class="required" title="Required">*</span></label>
                        <select name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        <span class="error" id="gender_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "religion">Religion <span class="required" title="Required">*</span></label>
                        <select name="religion" id="religion">
                            <option value="Islam">Islam</option>
                            <option value="Hinduism">Hinduism</option>
                            <option value="Christianity">Christianity</option>
                            <option value="Buddhism">Buddhism</option>
                            <option value="Judaism ">Judaism</option>
                        </select>
                        <span class="error" id="religion_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "marital_status">Marital Status <span class="required" title="Required">*</span></label>
                        <select name="marital_status" id="marital_status">
                            <option value="Unmarried">Unmarried</option>
                            <option value="Married">Married</option>
                        </select>
                        <span class="error" id="marital_status_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "nationality">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-input" value="Bangladeshi">
                        <span class="error" id="nationality_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "nid_no">Nid No.</label>
                        <input type="text" name="nid_no" id="nid_no" class="form-input">
                        <span class="error" id="nid_no_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "phn_no">Phone No. <span class="required" title="Required">*</span></label>
                        <input type="text" name="phn_no" id="phn_no" class="form-input">
                        <span class="error" id="phn_no_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "email">Email <span class="required" title="Required">*</span></label>
                        <input type="email" name="email" id="email" class="form-input">
                        <span class="error" id="email_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for="division">Division <span class="required" title="Required">*</span></label>
                        <select name="division" id="division">
                            <option value="">Select Division</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Barishal">Barishal</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Mymensingh">Mymensingh</option>
                        </select>
                        <span class="error" id="division_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "location">Work Location <span class="required" title="Required">*</span></label>
                        <input type="text" name="location" id="location" class="form-input" autocomplete="off">
                        <div id="location-list">
                            <ul>

                            </ul>
                        </div>
                        <span class="error" id="location_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "password">Password <span class="required" title="Required">*</span></label>
                        <input type="password" name="password" id="password" class="form-input">
                        <span class="error" id="password_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "password_confirmation">Confirm Password <span class="required" title="Required">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">
                        <span class="error" id="password_confirmation_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "address">Address </label>
                        <input type="text" name="address" id="address" class="form-input">
                        <span class="error" id="address_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for = "blood_group">Blood Group</label>
                        <select name="blood_group" id="blood_group">
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <span class="error" id="blood_group_error"></span>
                    </div>
                </div>
                <div class="c-6">
                    <div class="form-input-group">
                        <label for="store">Store <span class="required" title="Required">*</span></label>
                        <input type="text" name="store" class="form-input" id="store" autocomplete="off">
                        <div id="store-list">
                            <ul>

                            </ul>
                        </div>
                        <span class="error" id="store_error"></span>
                    </div>
                </div>
                
                @if (auth()->user()->user_role == 1)
                    <div class="c-6">
                        <div class="form-input-group">
                            <label for="company">Company <span class="required" title="Required">*</span></label>
                            <input type="text" name="company" class="form-input" id="company" autocomplete="off">
                            <div id="company-list">
                                <ul>

                                </ul>
                            </div>
                            <span class="error" id="company_error"></span>
                        </div>
                    </div>
                @else
                    <div class="c-6">
                        <input type="text" name="company" class="form-input" id="company" data-id="{{auth()->user()->company_id}}" style="display: none">
                    </div>
                @endif
                
                <div class="c-6">
                    <div class="form-input-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-input">
                        <span class="error" id="image_error"></span>
                        <img src="/images/male.png" alt="Selected Image" id="previewImage" style="width:150px; height:150px;">
                    </div>
                </div>
            </div>
            <div class="center">
                <button type="submit" id="Insert" class="btn-blue">Save</button>
            </div>
        </form>
    </div>
</div>
