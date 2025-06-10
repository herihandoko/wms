@extends('layouts.admin')

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Dashboard</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row match-height">
        <!-- Greetings Card starts -->
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card card-congratulations">
                <div class="card-body text-center">
                    <img src="{{ asset('app-assets/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left" />
                    <img src="{{ asset('app-assets/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right" />
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                            <i data-feather="award" class="font-large-1"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="mb-1 text-white">Welcome {{ Auth::user()->name }},</h1>
                        <p class="card-text m-auto w-75">
                            You are logged in as <strong>{{ Auth::user()->roles->first()->name }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Greetings Card ends -->

        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">92.6k</h2>
                    <p class="card-text">Total Users</p>
                </div>
                <div id="gained-chart"></div>
            </div>
        </div>
        <!-- Subscribers Chart Card ends -->

        <!-- Orders Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">38.4K</h2>
                    <p class="card-text">Total Orders</p>
                </div>
                <div id="order-chart"></div>
            </div>
        </div>
        <!-- Orders Chart Card ends -->
    </div>

    <!-- List DataTable -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Recent Activities</h4>
                </div>
                <div class="card-datatable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Client</th>
                                <th>Users</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('app-assets/images/icons/angular.svg') }}" class="me-75" height="20" width="20" alt="Angular" />
                                    <span class="fw-bold">Angular Project</span>
                                </td>
                                <td>Peter Charls</td>
                                <td>
                                    <div class="avatar-group">
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Lilian Nenez" class="avatar pull-up">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-5.jpg') }}" alt="Avatar" height="26" width="26" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Alberto Glotzbach" class="avatar pull-up">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-6.jpg') }}" alt="Avatar" height="26" width="26" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Alberto Glotzbach" class="avatar pull-up">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="Avatar" height="26" width="26" />
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">
                                                <i data-feather="edit-2" class="me-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i data-feather="trash" class="me-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('app-assets/images/icons/react.svg') }}" class="me-75" height="20" width="20" alt="React" />
                                    <span class="fw-bold">React Project</span>
                                </td>
                                <td>Ronald Frest</td>
                                <td>
                                    <div class="avatar-group">
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Lilian Nenez" class="avatar pull-up">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-5.jpg') }}" alt="Avatar" height="26" width="26" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Alberto Glotzbach" class="avatar pull-up">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-6.jpg') }}" alt="Avatar" height="26" width="26" />
                                        </div>
                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Alberto Glotzbach" class="avatar pull-up">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="Avatar" height="26" width="26" />
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill badge-light-success me-1">Completed</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">
                                                <i data-feather="edit-2" class="me-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i data-feather="trash" class="me-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ List DataTable -->
</section>
<!-- Dashboard Analytics end -->
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
@endpush

@push('js')
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
@endpush
