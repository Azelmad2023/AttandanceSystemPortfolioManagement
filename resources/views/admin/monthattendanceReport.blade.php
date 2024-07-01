@extends('layouts.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
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

@section('content')

    <div class="main-content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('downloadMonthRepport.pdf', ['month' => $month, 'year' => $year]) }}"
                    class="mb-3 btn btn-primary">
                    <span>Télécharger PDF</span>
                </a>
                <div class="card">
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                        <span class="text-white fw-bold">
                            {{ __('Rapport de Présence pour ') . date('F', mktime(0, 0, 0, $month, 1)) . __(' ') . $year }}
                        </span>
                        <div class="d-flex justify-content-lg-end justify-content-center gap-3">
                            <a href="#" id="showPresents" class="btn btn-success">
                                <span>Présents</span>
                            </a>
                            <a href="#" id="showAbsents" class="btn btn-danger">
                                <span>Absents</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">{{ __('Date') }}</th>
                                        <th class="font-weight-bold">{{ __('Nom de Formateur') }}</th>
                                        <th class="font-weight-bold">{{ __('Début De Séance') }}</th>
                                        <th class="font-weight-bold">{{ __('Fin De Séance') }}</th>
                                        <th class="font-weight-bold">{{ __('Groupe') }}</th>
                                        <th class="font-weight-bold">{{ __('État') }}</th>
                                        <th class="font-weight-bold">{{ __('Justification') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($attendanceRecords as $teacherName => $records)
                                        @foreach ($records as $record)
                                            @foreach ($record->attendanceResults as $index => $attendanceResult)
                                                <tr>
                                                    <td>{{ $record->day_date }}</td>
                                                    @if ($index == 0)
                                                        <td rowspan="{{ count($record->attendanceResults) }}">
                                                            {{ $teacherName }}</td>
                                                    @endif
                                                    <td>{{ $record->class_time_from }}</td>
                                                    <td>{{ $record->class_time_to }}</td>
                                                    <td>{{ $record->class_group }}</td>
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
                                                        @if ($attendanceResult->justification == 1)
                                                            Justifié
                                                        @elseif ($attendanceResult->justification == 0 && $attendanceResult->attendance_state == 'absent')
                                                            Non Justifié
                                                        @elseif ($attendanceResult->justification === null && $attendanceResult->attendance_state == 'present')
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" fill="green" class="bi bi-check-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                <path
                                                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                            </svg>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">{{ __('Aucun enregistrement trouvé') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.monthRapportView') }}" class="btn btn-secondary">{{ __('Retour') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
