@extends('layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white fw-bold">{{ __('Rapport de présence') }}</div>
                    <div class="card-body">
                        <form id="attendanceReportForm" method="POST" action="{{ route('attendanceMonth.report') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="month"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mois') }}</label>
                                <div class="col-md-6">
                                    <select id="month" class="form-control" name="month" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="year"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Année') }}</label>
                                <div class="col-md-6">
                                    <select id="year" class="form-control" name="year" required>
                                        @for ($i = date('Y'); $i >= 2000; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Générer le rapport') }}
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
