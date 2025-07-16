@php
    $searchValue = request()->query('search');
    $searchMethod = request()->query('method');
    $searchRole = request()->query('role');
@endphp

{{-- Add Button And Search Fields --}}
<div class="add-search">
    <div class="rows">
        <div class="c-3">
            @if(Request::segment(1) == 'admin' && auth()->user()->hasPermission(22))
                <button class="open-modal" data-modal-id="addModal" id="add"><i class="fa-solid fa-plus"></i> Add {{ $name }} </button>
            @endif
            @if(Request::segment(1) == 'hr' && Request::segment(3) == 'usertype' && auth()->user()->hasPermission(66))
                <button class="open-modal" data-modal-id="addModal" id="add"><i class="fa-solid fa-plus"></i> Add {{ $name }} </button>
            @endif
            @if(Request::segment(1) == 'inventory' && Request::segment(3) == 'usertype' && auth()->user()->hasPermission(219))
                <button class="open-modal" data-modal-id="addModal" id="add"><i class="fa-solid fa-plus"></i> Add {{ $name }} </button>
            @endif
            @if(Request::segment(1) == 'pharmacy' && Request::segment(3) == 'usertype' && auth()->user()->hasPermission(137))
                <button class="open-modal" data-modal-id="addModal" id="add"><i class="fa-solid fa-plus"></i> Add {{ $name }} </button>
            @endif
        </div>
        <div class="c-6">

        </div>
        <div class="c-3" style="padding: 0;">
            <input type="text" id="globalSearch" placeholder="Search..." />
        </div>
    </div>
</div>

{{-- Datatable Part --}}
<div class="load-data">
    <table class="data-table" id="data-table">
        <caption>{{ $name }} Details</caption>
        <thead></thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>

    <div id="paginate"></div>
</div>


@include('admin_setup.tran_with.add')

@include('admin_setup.tran_with.edit')

@include('common_modals.delete')

@include('common_modals.deleteStatus')


<!-- ajax part start from here -->
<script src="{{ asset('js/ajax/' . (Request::segment(1) == 'admin' ? 'admin_setup' : Request::segment(1)) . (Request::segment(1) == 'hr' ? '/employee_info' : '/users') .'/tran_with.js') }}"></script>
<script src="{{ asset('js/ajax/search_by_input.js') }}"></script>