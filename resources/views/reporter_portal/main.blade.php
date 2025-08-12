@php
    $searchValue = request()->query('search');
    $startDateValue = request()->query('startDate');
    $endDateValue = request()->query('endDate');
@endphp

@extends('layouts.layout')
@section('main-content')
     {{-- Add Button And Search Fields --}}
    <div class="add-search">
        <div class="rows">
            <div class="c-3">
                @if(auth()->user()->hasPermission(94))
                    <button class="open-modal" data-modal-id="addModal" id="add"><i class="fa-solid fa-plus"></i> Add {{ $name }} </button>
                @endif
            </div>
            <div class="c-3">
                <label for="startDate">Start Date</label>
                <input type="date" name="startDate" id="startDate" class="form-input"
                    value="{{ $startDateValue ? $startDateValue : date('Y-m-d') }}">
            </div>
            <div class="c-3">
                <label for="endDate">End Date</label>
                <input type="date" name="endDate" id="endDate" class="form-input"
                    value="{{ $endDateValue ? $endDateValue : date('Y-m-d') }}">
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


    @include('reporter_portal.add')

    @include('reporter_portal.edit')

    @include('common_modals.delete')

    @include('common_modals.deleteStatus')


    <!-- ajax part start from here -->
    <script src="{{ asset('js/ajax/reporter_portal/reporter_portal.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
