@extends('layouts.master')

@section('css')
    <!--Chartist Chart CSS -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/registerAttandance.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
@endsection

@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('downloadteacherRepport.pdf', ['teacherName' => $teacherName, 'month' => $month, 'year' => $year]) }}"
                    class="mb-3 btn btn-primary"><span>Télécharger PDF</span></a>
                <div class="table-wrapper pb-3">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                <h2 class="ml-lg-2">Rapport mensuel pour {{ $teacherName }}</h2>
                            </div>
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
                                <th class="font-weight-bold">{{ __('Date') }}</th>
                                <th class="font-weight-bold">{{ __('Début De Séance') }}</th>
                                <th class="font-weight-bold">{{ __('Fin De Séance') }}</th>
                                <th class="font-weight-bold">{{ __('État') }}</th>
                                <th class="font-weight-bold">{{ __('Justification') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendanceRecords as $record)
                                @foreach ($record->attendanceResults as $attendanceResult)
                                    <tr>
                                        <td>{{ $record->day_date }}</td>
                                        <td>{{ $record->class_time_from }}</td>
                                        <td>{{ $record->class_time_to }}</td>
                                        <td>
                                            @if (strtolower($attendanceResult->attendance_state) == 'present')
                                                Présent
                                            @elseif (strtolower($attendanceResult->attendance_state) == 'absent')
                                                Absent
                                            @else
                                                {{ ucfirst($attendanceResult->attendance_state) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (strtolower($attendanceResult->attendance_state) == 'absent' && $attendanceResult->justification == 1)
                                                Justifié
                                            @elseif(strtolower($attendanceResult->attendance_state) == 'absent' &&
                                                    ($attendanceResult->justification == null || $attendanceResult->justification == 0))
                                                Non Justifié
                                            @elseif(strtolower($attendanceResult->attendance_state) == 'present')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path
                                                        d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                </svg>
                                            @else
                                                {{ ucfirst($attendanceResult->justification) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('No records found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <a href="{{ route('admin.teacherRapport') }}" class="btn btn-secondary ml-3">{{ __('Retour') }}</a>
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
            function filterAttendance(state) {
                $('tbody tr').each(function() {
                    var attendanceState = $(this).find('td').eq(3).text().trim().toLowerCase();
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
