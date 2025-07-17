<div id="addModal" class="modal-container">
    <div class="modal-subject" style="width: 80%;">
        <div class="modal-heading banner">
            <div class="center">
                <h3>Add {{ $name }}</h3>
                <span class="close-modal" data-modal-id="addModal">&times;</span>
            </div>
        </div>

        <!-- form start -->
        <form id="AddForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="rows">
                <div class="c-6">
                    {{-- within --}}
                    <div id="within" style="display: none"> </div>
                    {{-- groupein --}}
                    <div id="groupein" style="display: none"></div>
                    <div class="rows">
                        {{-- date  --}}
                        <div class="c-12">
                            <div class="form-input-group">
                                <label for="date">Date</label>
                                <input type="text" name="date" class="form-input" id="date" value="{{ date('Y-m-d') }}"
                                    readonly>
                            </div>
                        </div>
                        {{-- user --}}
                        <div class="c-12">
                            <div class="form-input-group">
                                <label for="user">Transaction User</label>
                                <input type="text" name="user" class="form-input" id="user" autocomplete="off"><hr>
                                <div id="user-list"></div>
                                <span class="error" id="user_error"></span>
                            </div>
                        </div>
                        {{-- head  --}}
                        <div class="c-12">
                            <div class="form-input-group">
                                <label for="head">Transaction Head</label>
                                <input type="text" name="head" id="head" class="form-input" autocomplete="off"><hr>
                                <div id="head-list"></div>
                                <span class="error" id="head_error"></span>
                            </div>
                        </div>
                    
                        {{-- quantity --}}
                        <div class="c-4">
                            <div class="form-input-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" name="quantity" class="form-input" id="quantity" value="1">
                                <span class="error" id="quantity_error"></span>
                            </div>
                        </div>
                        {{-- amount --}}
                        <div class="c-4">
                            <div class="form-input-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-input amount" id="amount">
                                <span class="error" id="amount_error"></span>
                            </div>
                        </div>
                        {{-- total --}}
                        <div class="c-4">
                            <div class="form-input-group">
                                <label for="totAmount">Total</label>
                                <input type="text" name="totAmount" class="form-input" id="totAmount" readonly>
                                <span class="error" id="totAmount_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        <button type="submit" id="InsertTransaction" class="btn-blue">Add</button>
                    </div>
                </div>

                <div class="c-6">
                    <div class="transaction_grid" style="overflow-x:auto;">
                        <table class="show-table">
                            <thead>
                                <tr>
                                    <th>SL:</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                    <div class="rows">
                        <div class="c-6"></div>
                        <div class="c-6">
                            <table style="width: 100%">
                                {{-- invoice amount --}}
                                <tr>
                                    <td><label for="amountRP">Invoice Amount</label></td>
                                    <td><input type="text" name="amountRP" class="input-small" id="amountRP" value="0"
                                            readonly style="text-align: right;"></td>
                                </tr>
                                {{-- discount --}}
                                <tr>
                                    <td><label for="totalDiscount">Discount</label></td>
                                    <td><input type="text" name="totalDiscount" class="input-small" id="totalDiscount"
                                            value="0" style="text-align: right;"></td>
                                </tr>
                                {{-- net amount --}}
                                <tr>
                                    <td><label for="netAmount">Net Amount</label>
                                    <td><input type="text" name="netAmount" class="input-small" id="netAmount" value="0"
                                            readonly style="text-align: right;">
                                    </td>
                                </tr>
                                {{-- advance --}}
                                <tr>
                                    <td><label for="advance">Advance</label>
                                    <td><input type="text" name="advance" class="input-small" id="advance" value="0"
                                            style="text-align: right;">
                                    </td>
                                </tr>
                                {{-- balance --}}
                                <tr>
                                    <td><label for="balance">Balance</label>
                                    <td><input type="text" name="balance" class="input-small" id="balance" value="0"
                                            readonly style="text-align: right;"></td>
                                </tr>
                            </table>
                        </div>
                        {{--PaymentMethod --}}
                        <div class="c-12">
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
                                <textarea  name="note" id="note" class="form-input" cols="30" rows="10" autocomplete="off"></textarea><hr>
                                <div id="note-list"></div>
                                <span class="error" id="note_error"></span>
                            </div>
                        </div>
                        <div class="center">
                            <span class="error" id="discount_error"></span>
                            <span class="error" id="advance_error"></span>
                            <span class="error" id="message_error"></span>
                        </div>
                    </div>
                    <div class="center">
                        <button id="InsertMain" class="btn-blue">Submit</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>