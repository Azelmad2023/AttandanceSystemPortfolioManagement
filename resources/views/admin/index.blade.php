@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.css"> --}}

<link rel="stylesheet" href="{{ URL::asset('https://cdn.tailwindcss.com') }}">
@endsection

@section('breadcrumb')
<div class="text-left col-sm-6">
    <h4 class="page-title">Tableau de bord</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Bienvenue dans le Système de Gestion de Présence</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="text-white card">
            <div class="card-body" style="background-color: #007bff ;">
                <div class="mb-4">
                    <div class="float-left mr-4 mini-stat-img">
                        <span class="ti-id-badge" style="font-size: 30px"></span>
                    </div>
                    <h5 class="mt-0 font-16 text-uppercase text-white-50" style="font-size: 14px">Formateurs<br>Aujourd'hui</h5>
                    <h2 class="float-right font-500">{{ $totalTeachers }}</h2>

                </div>
                <!-- Log on to codeastro.com for more projects! -->
                <span class="float-left ti-user" style="font-size: 71px"></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="text-white card">
            <div class="card-body" style="background-color: #dc3545;">
                <div class="mb-4">
                    <div class="float-left mr-4 mini-stat-img">
                        <i class="ti-alert" style="font-size: 30px"></i>
                    </div>
                    <h5 class="mt-0 font-16 text-uppercase text-white-50" style="font-size: 14px">Num Séances<br>Non Effectuées</h5>
                    <h1 class="float-right font-500">{{ $numAbsent ?: '' }}</h1>



                </div>
                <!-- Log on to codeastro.com for more projects! -->
                <h1 class="float-right font-500"><i class="ml-2 text-success"></i></h1>
                <span class="float-left peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72"></span>
                <!-- <div class="pt-2">
                                                                                                                                                                                                                                                                                            <div class="float-right">
                                                                                                                                                                                                                                                                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                                                            <p class="mb-0 text-white-50">More info</p>
                                                                                                                                                                                                                                                                                        </div> -->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="text-white card">
            <div class="card-body" style="background-color: #20c997 ;">
                <div class="mb-4">
                    <div class="float-left mr-4 mini-stat-img">
                        <i class=" ti-check-box" style="font-size: 30px"></i>
                    </div>
                    <h5 class="mt-0 font-16 text-uppercase text-white-50" style="font-size: 14px">Num Séances<br> Effectuées</h5>
                    <h1 class="float-right font-500">{{ $numPresent ?: '' }}</h1>


                </div>
                <!-- Log on to codeastro.com for more projects! -->
                <h1 class="float-right font-500"> <i class="ml-2 text-success"></i></h1>
                <span class="float-left peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72"></span>
                <!-- <div class="pt-2">
                                                                                                                                                                                                                                                                                            <div class="float-right">
                                                                                                                                                                                                                                                                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                                                            <p class="mb-0 text-white-50">More info</p>
                                                                                                                                                                                                                                                                                        </div> -->
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="text-white card">
            {{-- <div class="card-body" style="background-color:  #fd7e14;"> --}}
            <div class="card-body" style="background-color: #17a2b8  ;">
                <div class="mb-4">
                    <div class="float-left mr-4 mini-stat-img">
                        <span class="ti-panel" style="font-size: 30px"></span>
                    </div>
                    <h6 class="mt-0 font-16 text-uppercase text-white-50" style="font-size: 14px">Pourcentage<br> d'Absence</h6>
                </div>
                <h2 class="float-right font-500">
                    @php
                    $totalClasses = $numAbsent + $numPresent;
                    $absencePercentage = $totalClasses > 0 ? ($numAbsent / $totalClasses) * 100 : 0;
                    @endphp
                    {{ round($absencePercentage) }}%
                    <i class="ml-2 text-danger"></i>
                </h2>
                <span class="float-left peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72"></span>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<!-- Log on to codeastro.com for more projects! -->



<!-- new row end -->
<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <!-- <div class="card-body">
                                                                                                                                                                                                                                                                                        <h4 class="mt-0 mb-5 header-title">Monthly Report</h4>

                                                                                                                                                                                                                                                                                    </div> -->
        </div>
        <!-- end card -->
    </div>

    <div class="col-xl-3">
        <div class="card">
            <!-- <div class="card-body">
                                                                                                                                                                                                                                                                                        <div>
                                                                                                                                                                                                                                                                                            <h4 class="mt-0 mb-4 header-title">Sales Analytics</h4>
                                                                                                                                                                                                                                                                                        </div></div> -->
        </div>
    </div>
</div>
<!-- end row -->


<!-- end row -->
@endsection
<style>
    .card-body {
        border-radius: 10px;
    }
</style>

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/dashboard.js') }}"></script>
@endsection