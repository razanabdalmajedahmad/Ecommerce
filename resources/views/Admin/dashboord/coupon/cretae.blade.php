@extends('Admin.layout.app')
@section('title')
    <title>{{__('all.Createnewcoupons')}}</title>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('pagetitle')
    <div class="d-flex justify-content-between">
        <div class="pagetitle col">
            <h1>{{__('all.coupons')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{__('all.Home')}}</a></li>
                    <li class="breadcrumb-item ">{{__('all.coupons')}}</li>
                    <li class="breadcrumb-item active"><a>{{__('all.Createnewcoupons')}}</a></li>
                </ol>
            </nav>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('coupon_list') }}">{{__('all.Back')}}</a>
        </div>
    </div>
@endsection
@section('section')
    <section class="section">
        <div class="row">

            <div class="col-lg-12">
                <div class="card p-5">
                    <div class="card-body">

                        <form id="form">
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.code') }}</label>
                                    <input type="text" class="form-control" name="code" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_code">
                                    </span>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.value') }}%</label>
                                    <input type="number" class="form-control" name="value" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_value">
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Status') }}</label>
                                    <select name="status" class="form-control">
                                        <option value="">{{ __('all.selectoption') }}</option>
                                        <option value="active">{{ __('all.Active') }}</option>
                                        <option value="inactive">{{ __('all.Inactive') }}</option>
                                    </select>
                                    <span class="invalid-feedback" id="invalid_feedback_status">
                                    </span>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary" id="btn-save">{{__('all.Submit')}}</button>
                                <div class="spinner-border text-primary" role="status" hidden>
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </form>
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
                url: "{{ route('coupon_createnew_post') }}",
                data: formData,
                beforeSend: function() {
                    $('.invalid-feedback').empty()
                    $('#alert-error').attr('hidden', 'hidden')
                    $('#btn-save').attr('hidden', 'hidden')
                    $('.spinner-border').attr('hidden', false)
                },
                complete: function() {
                    $('#btn-save').attr('hidden', false)
                    $('.spinner-border').attr('hidden', 'hidden')
                },
                success: function(data) {
                    if (data.status) {
                        window.location.href = "{{ route('coupon_list') }}";
                    } else {
                        $('.invalid-feedback').css('display', 'none')
                        toastr["warning"]('warning', data.message);


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
