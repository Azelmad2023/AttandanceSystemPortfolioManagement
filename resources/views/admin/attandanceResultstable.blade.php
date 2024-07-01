@extends('layouts.master')

@section('css')
    <!--Chartist Chart CSS -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/registerAttandance.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::asset('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    <!-- js Cdns with Jquery  -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
@endsection

{{-- @section('breadcrumb')
    <div class="col-sm-6 text-left">
        <h4 class="page-title">Gestion des Formateurs</h4>
    </div>
@endsection --}}



@section('content')
    <div class="flex justify-between">
        @include('includes.search_by_date_form')
        {{-- @include('includes.day_results') --}}
    </div>
    <div class="main-content">


        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('admin.register_attendance') }}">
                    @csrf
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                    <h2 class="ml-lg-2">Gérer la présence</h2>
                                </div>
                                {{-- <div class="col-sm-6 p-0 d-flex justify-content-lg-end justify-content-center gap-3">
                                    <a href="" class="btn btn-success" data-toggle="modal">
                                        <span>Present</span></a>
                                    <a href="" class="btn btn-danger" data-toggle="modal">
                                        <span> Absents </span></a>
                                </div> --}}
                                <div class="col-sm-6 p-0 d-flex justify-content-lg-end justify-content-center gap-3">
                                    <a href="#" id="showPresents" class="btn btn-success">
                                        <span>Présents</span>
                                    </a>
                                    <a href="#" id="showAbsents" class="btn btn-danger">
                                        <span>Absents</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead>

                                <tr>
                                    {{-- <th class="font-weight-bold">Date du jour</th> --}}
                                    <th class="font-weight-bold">Jour</th>
                                    <th class="font-weight-bold">Nom de Formateur</th>
                                    <th class="font-weight-bold">Début de séance</th>
                                    <th class="font-weight-bold">Fin de séance</th>
                                    <th class="font-weight-bold">Groupe</th>
                                    <th class="font-weight-bold">État</th>
                                    <th class="font-weight-bold">Justification</th>
                                    <th class="font-weight-bold">Modifier</th>
                                    <th class="font-weight-bold">Doc</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendanceResults as $attendanceResult)
                                    <tr>
                                        {{-- <td>{{ $attendanceResult->day_date }}</td> --}}
                                        <td>{{ $attendanceResult->day_of_week }}</td>
                                        <td>{{ $attendanceResult->teacher_name }}</td>
                                        <td>{{ $attendanceResult->class_time_from }}</td>
                                        <td>{{ $attendanceResult->class_time_to }}</td>
                                        <td>{{ $attendanceResult->class_group }}</td>
                                        <td>
                                            @if (optional($attendanceResult->attendanceResults->first())->attendance_state == 'present')
                                                Présent
                                            @elseif (optional($attendanceResult->attendanceResults->first())->attendance_state == 'absent')
                                                Absent
                                            @else
                                                {{ optional($attendanceResult->attendanceResults->first())->attendance_state }}
                                            @endif
                                        </td>

                                        {{-- <td>{{ optional($attendanceResult->attendanceResults->first())->attendance_state }}
                                        </td> --}}
                                        <td>
                                            @if (optional($attendanceResult->attendanceResults->first())->justification == 1)
                                                Justifié
                                            @elseif (optional($attendanceResult->attendanceResults->first())->justification == 0 &&
                                                    optional($attendanceResult->attendanceResults->first())->attendance_state == 'absent')
                                                Non justifié
                                            @elseif (optional($attendanceResult->attendanceResults->first())->justification === null &&
                                                    optional($attendanceResult->attendanceResults->first())->attendance_state == 'present')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path
                                                        d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                </svg>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('attendance.edit', [optional($attendanceResult->attendanceResults->first())->id]) }}"
                                                class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a> --}}
                                            <a href="{{ route('attendance.edit', ['id' => optional($attendanceResult->attendanceResults->first())->id, 'day_date' => $attendanceResult->day_date]) }}"
                                                class="btn btn-primary btn-sm d-flex justify-content-center align-items-center"
                                                style="width: 35px; height: 35px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            @if (optional($attendanceResult->attendanceResults->first())->justification_document)
                                                <a href="{{ route('document.show', optional($attendanceResult->attendanceResults->first())->id) }}"
                                                    class="btn btn-warning btn-sm  d-flex justify-content-center align-items-center"
                                                    style="width: 35px; height: 35px;"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                                                        <path
                                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1" />
                                                    </svg>
                                                </a>
                                            @elseif (optional($attendanceResult->attendanceResults->first())->justification === null &&
                                                    optional($attendanceResult->attendanceResults->first())->attendance_state == 'present')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="green" class="bi bi-check-all" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="red" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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




    {{-- <script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
    <!-- peity JS -->
    <script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('assets/pages/dashboard.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}

    <script>
        {{-- $(document).ready(function() {
            function filterAttendance(state) {
                $('tbody tr').each(function() {
                    var attendanceState = $(this).find('td').eq(6).text().trim().toLowerCase();
                    $(this).toggle(attendanceState === state);
                });
            }

            $('#showPresents').click(function(e) {
                e.preventDefault();
                filterAttendance('présent');
            });

            $('#showAbsents').click(function(e) {
                e.preventDefault();
                filterAttendance('absent');
            });
        }); --}}
        $(document).ready(function() {
            function filterAttendance(state) {
                $('tbody tr').each(function() {
                    var attendanceState = $(this).find('td').eq(5).text().trim().toLowerCase();
                    $(this).toggle(attendanceState === state);
                });
            }

            $('#showPresents').click(function(e) {
                e.preventDefault();
                filterAttendance('présent');
            });

            $('#showAbsents').click(function(e) {
                e.preventDefault();
                filterAttendance('absent');
            });
        });
    </script>
@endsection
