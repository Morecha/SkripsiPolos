@extends('layouts.admin')

@section('header')
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">User</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">User List</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>name</th>
                                                <th>email</th>
                                                <th>role</th>
                                                <th>status</th>
                                                <th>options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        <span class="badge badge-light-warning">{{ $user->status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('user.edit', $user->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{route('user.delete', $user->id)}}"
                                                                    onclick="event.preventDefault();
                                                                    document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <form id="delete-form-{{ $user->id }}" method="POST" action="{{route('user.delete', $user->id)}}" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--/ Ajax Sourced Server-side -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('script')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('app-assets/js/scripts/pages/app-invoice-list.js')}}"></script> --}}
    <script src="{{ asset('app-assets/js/scripts/pages/datatables-demo.js') }}"></script>
    <!-- END: Page JS-->

    {{-- <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function deleteUser(id) {
                var id_deleted = id;
                console.log(id_deleted);
            }
        });
    </script> --}}
@endsection
