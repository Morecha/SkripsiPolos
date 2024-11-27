@extends('layouts.admin')

@section('header')
<meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
<meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-user.css')}}">
<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<!-- END: Custom CSS-->

<script>
    function toggleCheckboxes(source) {
        const checkboxes = document.querySelectorAll('.form-check-input');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
    }
</script>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users edit start -->
            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">
                            <!-- Account Tab starts -->
                            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                <label>
                                    <input type="checkbox" class="form-check-input" onclick="toggleCheckboxes(this)">
                                    <label><b>Pilih Semua</b></label>
                                </label><br>
                                <div class="divider divider-primary">
                                    <div class="divider-text"><b>Pilih dibawah</b></div>
                                </div>
                                <!-- users edit account form start -->
                                <form action="{{route('buku.cetak',$id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data as $data)
                                            <div class="form-group col-12 col-sm-6 col-md-4 col-lg-3">
                                                <label>
                                                    <input type="checkbox" class="form-check-input" id="admin-read" name="print{{$i}}" value="{{$data['kode_buku']}}">
                                                    <label class="form-check-label" for="admin-read">{{ $data['kode_buku'] }}</label>
                                                </label>
                                            </div>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </div><br>
                                    <div class="row">
                                        <div class="col-12 mt-50">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <a type="reset" class="btn btn-outline-secondary" href="{{url()->previous()}}">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- users edit account form ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/pages/app-user-edit.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/components/components-navs.js')}}"></script>
<!-- END: Page JS-->
@endsection
