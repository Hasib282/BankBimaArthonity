@php
    $searchValue = request()->query('search');
    $searchOptionValue = request()->query('searchOption');
    $searchMethodValue = request()->query('method');
    $startDateValue = request()->query('startDate');
    $endDateValue = request()->query('endDate');
@endphp

{{-- Add Button And Search Fields --}}
<div class="add-search">
    <div class="rows" style="align-items:center;">
        <div class="c-3">
            <a class="btn-blue" id="print"><i class="fa-solid fa-print"></i> Print</a>
        </div>
        <div class="c-2">
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" id="startDate" class="form-input" value="{{ $startDateValue ? $startDateValue : date('Y-m-d') }}">
        </div>
        <div class="c-2">
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" id="endDate" class="form-input" value="{{ $endDateValue ? $endDateValue : date('Y-m-d') }}">
        </div>
        <div class="c-2">
            {{-- <label for="typeOption">Transaction Type</label>
            <select name="typeOption" id="typeOption">
                options will be display dynamically
            </select> --}}
        </div>
        <div class="c-3"></div>
    </div>
</div>

{{-- Datatable Part --}}
<div class="load-data">
    <table class="data-table" id="data-table">
        <caption>{{ $name }}</caption>
        <thead></thead>
        <tbody></tbody>
        <tfoot></tfoot>
    </table>

    <div id="paginate"></div>
</div>


<!-- ajax part start from here -->
<script src="{{ asset('js/ajax/report').'/'. $js . '.js' }}"></script>