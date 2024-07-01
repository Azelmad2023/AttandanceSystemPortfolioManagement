@extends('layouts.master')

@section('css')
    <!--Chartist Chart CSS -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/registerAttandance.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- dashboard Links  --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <!----css3---->
    <link rel="stylesheet" href="custom.css" />

    <!--google fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />

    <!-- js Cdns with Jquery  -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- Popper.js (required for Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- <a href="{{ route('pdf.show', ['filename' => 'TML5qZ1yJN23Arg7DfcHluD8ghhvE4Q2YPmIz2DE.pdf']) }}">View PDF</a> --}}

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark font-weight-bold text-white">{{ __('Modifier l\'État de Présence') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('attendance.update', $attendance->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="day_date" value="{{ $day_date }}">
                            <div class="form-group row">
                                <label for="attendance_state"
                                    class="col-md-4 col-form-label text-md-right">{{ __('État de Présence') }}</label>
                                <div class="col-md-6">
                                    <select id="attendance_state"
                                        class="form-control @error('attendance_state') is-invalid @enderror"
                                        name="attendance_state" required>
                                        <option value="present" @if ($attendance->attendance_state == 'present') selected @endif>
                                            {{ __('Présent') }}</option>
                                        <option value="absent" @if ($attendance->attendance_state == 'absent') selected @endif>
                                            {{ __('Absent') }}</option>
                                    </select>
                                    @error('attendance_state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Justification -->
                            <div id="justification_group" class="form-group row" style="display: none;">
                                <label for="justification"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Justification') }}</label>
                                <div class="col-md-6">
                                    <select id="justification"
                                        class="form-control @error('justification') is-invalid @enderror"
                                        name="justification" required>
                                        <option value="1" @if ($attendance->justification) selected @endif>
                                            {{ __('Justifiée') }}</option>
                                        <option value="0" @unless ($attendance->justification) selected @endunless>
                                            {{ __('Non Justifiée') }}</option>
                                    </select>
                                    @error('justification')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Justification Type -->
                            <div id="justification_type_group" class="form-group row" style="display: none;">
                                <label for="justification_type"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Type de Justification') }}</label>
                                <div class="col-md-6">
                                    <input id="justification_type" type="text"
                                        class="form-control @error('justification_type') is-invalid @enderror"
                                        name="justification_type"
                                        value="{{ old('justification_type', $attendance->justification_type) }}"
                                        autocomplete="justification_type">
                                    @error('justification_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Justification Document -->
                            <div id="justification_document_group" class="form-group row" style="display: none;">
                                <label for="justification_document"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Document de Justification') }}</label>
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('justification_document') is-invalid @enderror"
                                            id="justification_document" name="justification_document">
                                        <label class="custom-file-label"
                                            for="justification_document">{{ __('Choose file') }}</label>
                                    </div>
                                    @error('justification_document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Mettre à Jour') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!--Chartist Chart-->
    <script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- peity JS -->
    <script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/dashboard.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to toggle visibility of justification related fields
            function toggleJustificationFields() {
                var attendanceStateValue = $('#attendance_state').val();
                var justificationValue = $('#justification').val();

                if (attendanceStateValue === 'absent') {
                    $('#justification_group').show();
                    if (justificationValue === '1') {
                        $('#justification_type_group').show();
                        $('#justification_document_group').show();
                    } else {
                        $('#justification_type_group').hide();
                        $('#justification_document_group').hide();
                    }
                } else {
                    $('#justification_group').hide();
                    $('#justification_type_group').hide();
                    $('#justification_document_group').hide();
                }
            }

            // Toggle justification fields on page load
            toggleJustificationFields();

            // Event listener for attendance state change
            $('#attendance_state').change(function() {
                toggleJustificationFields();
            });

            // Event listener for justification change
            $('#justification').change(function() {
                toggleJustificationFields();
            });
        });
    </script>
@endsection
