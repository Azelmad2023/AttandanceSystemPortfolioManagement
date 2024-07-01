<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">


</body>

</html>
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

    @include('includes.error_attandance_exists')

    <div class="flex justify-between">
        @include('includes.search_by_date_form')
        @include('includes.day_results')
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                @if ($teachers->isEmpty())
                    <p class="text-gray-600 italic">Aucun enseignant trouvé pour la date sélectionnée.</p>
                @else
                    <form method="POST" action="{{ route('admin.register_attendance', ['searchDate' => $searchDate]) }}">
                        @csrf
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                        <h2 class="ml-lg-2">Enregistrer la présence</h2>
                                    </div>
                                    <div class="col-sm-6 p-0 d-flex justify-content-lg-end justify-content-center gap-3">
                                        {{-- <a href="" class="btn btn-success" data-toggle="modal">
                                            <span>Absence</span></a>
                                        <a href="" class="btn btn-danger" data-toggle="modal">
                                            <span>Present</span></a> --}}
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">Nom de Formateur</th>
                                        <th class="font-weight-bold">Début de séance </th>
                                        <th class="font-weight-bold">Fin de séance</th>
                                        <th class="font-weight-bold">Groupe</th>
                                        <th class="font-weight-bold">État</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->teacher_name }}</td>
                                            <td>{{ $teacher->class_time_from }}</td>
                                            <td>{{ $teacher->class_time_to }}</td>
                                            <td>{{ $teacher->class_group }}</td>
                                            <td>
                                                <input type="hidden" name="teacher_names[{{ $teacher->id }}]"
                                                    value="{{ $teacher->teacher_name }}">
                                                <div style="display:flex; align-items:center; gap:5px;">
                                                    <div style="display:flex ; align-items:center; gap:5px;">
                                                        <span style="font-size: 10px ; ">Present</span>
                                                        <input type="radio" name="attendance[{{ $teacher->id }}]"
                                                            value="present" class="form-radio h-5 w-5 "
                                                            style="accent-color: red" required>
                                                    </div>

                                                    <div style="display:flex ;align-items:center; gap:5px;">
                                                        <span style="font-size: 10px ; ">Absent</span>
                                                        <input type="radio" name="attendance[{{ $teacher->id }}]"
                                                            value="absent" class="form-radio h-5 w-5" required>
                                                    </div>

                                                </div>
                                            </td>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Submit</button>
                    </form>
                @endif
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
@endsection
