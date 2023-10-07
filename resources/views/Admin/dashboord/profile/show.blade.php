@extends('Admin.layout.app')
@section('title')
    <title>{{ __('all.MyProfile') }}</title>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('pagetitle')
    <div class="d-flex justify-content-between">
        <div class="pagetitle col">
            <h1>{{ __('all.MyProfile') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('all.Home') }}</a></li>
                    <li class="breadcrumb-item ">{{ __('all.MyProfile') }}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
@section('section')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if ($admin->image)
                            <img src="{{asset($admin->image)}}" id="profileimage" alt="Profile" class="rounded-circle">
                        @else
                        <img src="" id="profileimage" hidden alt="Profile" class="rounded-circle">
                        @endif
                        <h2>{{ $admin->name }}</h2>
                        <h3>Admin</h3>

                        <div class="social-links mt-2">
                            @if ($admin->twitter)
                                <a href="{{ $admin->twitter }}" class="twitter"><i class="bi bi-twitter"></i></a>
                            @endif
                            @if ($admin->facebook)
                                <a href="{{ $admin->facebook }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if ($admin->instagram)
                                <a href="{{ $admin->instagram }}" class="instagram"><i class="bi bi-instagram"></i></a>
                            @endif
                            @if ($admin->linkedin)
                                <a href="{{ $admin->linkedin }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">{{__('all.Overview')}}</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    {{__('all.EditProfile')}} </button>
                            </li>



                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">{{__('all.ChangePassword')}}</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">{{__('all.ProfileDetails')}} </h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">{{__('all.Name')}}</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->name }}</div>
                                </div>



                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('all.Country')}}</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->country }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('all.Address')}}</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('all.Phone')}}</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->phone }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{__('all.Email')}}</div>
                                    <div class="col-lg-9 col-md-8">{{ $admin->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form id="form">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">
                                            {{__('all.Image')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            @if ($admin->image)
                                                <img src="{{ asset($admin->image) }}" id="blah" alt="Profile">
                                            @else
                                                <img src="" hidden id="blah" alt="Profile">
                                            @endif
                                            <input type="text" value="0" name="isdeleted" hidden id="isdeleted">
                                            <div class="pt-2">
                                                <input type="file" hidden id="inputimage" name="image">
                                                <label style="color: #fff" for="inputimage" class="btn btn-primary btn-sm"
                                                    title="Upload new profile image"><i class="bi bi-upload"></i></label>
                                                <label style="color: #fff" id="remove" class="btn btn-danger btn-sm"
                                                    title="Remove my profile image"><i class="bi bi-trash"></i></label>
                                            </div>
                                            <span class="invalid-feedback" id="invalid_feedback_image">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{__('all.Name')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="fullName"
                                                value="{{ $admin->name }}">
                                            <span class="invalid-feedback" id="invalid_feedback_name">
                                            </span>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">{{__('all.Country')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="country" type="text" class="form-control" id="Country"
                                                value="{{ $admin->country }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">{{__('all.Address')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address"
                                                value="{{ $admin->address }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">{{__('all.Phone')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="{{ $admin->phone }}">
                                            <span class="invalid-feedback" id="invalid_feedback_phone">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">{{__('all.Email')}}</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email"
                                                value="{{ $admin->email }}">
                                            <span class="invalid-feedback" id="invalid_feedback_email">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">{{__('all.Twitter')}}
                                            </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="twitter" type="url" class="form-control" id="Twitter"
                                                value="{{ $admin->twitter }}">
                                            <span class="invalid-feedback" id="invalid_feedback_twitter">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">{{__('all.Facebook')}}
                                            </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="url" class="form-control" id="Facebook"
                                                value="{{ $admin->facebook }}">
                                            <span class="invalid-feedback" id="invalid_feedback_facebook">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">{{__('all.Instagram')}}
                                            </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instagram" type="url" class="form-control" id="Instagram"
                                                value="{{ $admin->instagram }}">
                                            <span class="invalid-feedback" id="invalid_feedback_instagram">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">{{__('all.Linkedin')}}
                                            </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="url" class="form-control" id="Linkedin"
                                                value="{{ $admin->linkedin }}">
                                            <span class="invalid-feedback" id="invalid_feedback_linkedin">
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-primary" id="btn-save"
                                            formnovalidate="formnovalidate">{{__('all.SaveChanges')}}</button>
                                        <div class="spinner-border text-primary" id="spinner-border" role="status" hidden>
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>



                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form id="form_change">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">{{__('all.CurrentPassword')}}
                                            </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="currentPassword" type="password" class="form-control"
                                                id="currentPassword">
                                            <span class="invalid-feedback" id="invalid_feedback_currentPassword">
                                                </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">{{__('all.NewPassword')}}
                                            </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword">
                                                <span class="invalid-feedback" id="invalid_feedback_newpassword">
                                                </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">{{__('all.Re-enterNewPassword')}}
                                           </label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword">
                                            <span class="invalid-feedback" id="invalid_feedback_renewpassword">
                                                </span>
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button class="btn btn-primary" id="btn-change"
                                            formnovalidate="formnovalidate">{{__('all.SaveChanges')}}</button>
                                        <div class="spinner-border  text-primary" id="spinner-change" role="status" hidden>
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
@section('script')
    <script src=" https://ajax.googleapis.com/ajax/libs/jQuery/3.3.1/jQuery.min.js "></script>


    <script>
        $('#form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            formData.append('_token', "{{ csrf_token() }}")
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{ route('edit_profile') }}",
                data: formData,
                beforeSend: function() {
                    $('.invalid-feedback').empty()
                    $('#alert-error').attr('hidden', 'hidden')
                    $('#btn-save').attr('hidden', 'hidden')
                    $('#spinner-border').attr('hidden', false)
                },
                complete: function() {
                    $('#btn-save').attr('hidden', false)
                    $('#spinner-border').attr('hidden', 'hidden')
                },
                success: function(data) {
                    if (data.status) {
                        $('#profileimage').attr('src', data.image);
                        if(data.isnull){
                            $('#profileimage').attr('hidden', false);
                        }else{
                            $('#profileimage').attr('hidden', true);
                        }


                        toastr["success"](data.message)
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    } else {
                        if ("{{ app()->getLocale() }}" == "en") {
                            var position = "toast-top-left"
                        } else {
                            var position = "toast-top-right"
                        }
                        toastr["success"](data.message)
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }

                },
                error: function(xhr) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#invalid_feedback_' + key).empty()
                        $('#invalid_feedback_' + key).append(value)
                        $('.invalid-feedback').css('display', 'inline')
                    });
                }
            });
        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                    $('#blah').attr('hidden', false);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputimage").change(function() {
            readURL(this);

        });
        $('#remove').on('click', function() {
            $("#inputimage").val('')
            $("#inputimage").wrap('<form>').closest('form').get(0).reset();
            $("#inputimage").unwrap();
            $('#blah').attr('hidden', true);
            $('#isdeleted').val('1')

        })
    </script>
   <script>
    $('#form_change').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        formData.append('_token', "{{ csrf_token() }}")
        $.ajax({
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            url: "{{ route('change_password') }}",
            data: formData,
            beforeSend: function() {
                $('.invalid-feedback').empty()
                $('#alert-error').attr('hidden', 'hidden')
                $('#btn-change').attr('hidden', 'hidden')
                $('#spinner-change').attr('hidden', false)
            },
            complete: function() {
                $('#btn-change').attr('hidden', false)
                $('#spinner-change').attr('hidden', 'hidden')
            },
            success: function(data) {
                if (data.status) {
                        toastr["success"](data.message)
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        $('#form_change')[0].reset()

                    } else {

                        toastr["warning"](data.message)
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }


            },
            error: function(xhr) {

                $.each(xhr.responseJSON.errors, function(key, value) {
                    $('#invalid_feedback_' + key).empty()
                    $('#invalid_feedback_' + key).append(value)
                    $('.invalid-feedback').css('display', 'inline')
                });
            }
        });
    })
</script>
@endsection
