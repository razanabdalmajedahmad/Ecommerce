@extends('Admin.layout.app')
@section('title')
    <title>{{__('all.updateCategure')}}</title>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


@endsection
@section('pagetitle')
    <div class="d-flex justify-content-between">
        <div class="pagetitle col">
            <h1>Categures</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{__('all.Home')}}</a></li>
                    <li class="breadcrumb-item ">{{__('all.Categure')}}</li>
                    <li class="breadcrumb-item active"><a>{{__('all.updateCategure')}}</a></li>
                </ol>
            </nav>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('Categure_list') }}">{{__('all.Back')}}</a>
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
                                <label for="inputEmail3" class="col-sm-4 col-md-2 col-form-label">{{__('all.NameEN')}}</label>
                                <div class="col-sm-8 col-md-10">
                                    <input type="text" class="form-control" value={{$categure->name_en}} name="name_en" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_name_en">
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-md-2 col-form-label">{{__('all.NameAR')}}</label>
                                <div class="col-sm-8 col-md-10">
                                    <input type="text" class="form-control" hidden value={{$categure->id}} name="id" id="inputText">
                                    <input type="text" class="form-control" value={{$categure->name_ar}} name="name_ar" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_name_ar">
                                    </span>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-md-2 col-form-label">{{__('all.Image')}}</label>
                                <div class="col-sm-8 col-md-10">
                                    <input type="file" class="form-control imageinput" name="image" id="inputText">
                                    <img id="blah" src="{{asset($categure->image)}}" alt="your image" width="150" height="150"/>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" id="btn-save">{{__('all.Update')}}</button>
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
                url: "{{ route('Categure_update_post') }}",
                data: formData,
                beforeSend: function() {

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
                        window.location.href = "{{ route('Categure_list') }}";
                    } else {
                        $('.invalid-feedback').css('display', 'none')
                        toastr["warning"]('warning',data.message);

                        toastr.options= {
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
                    $('#invalid_feedback_image').css('display', 'none')
                    $('#blah').attr('src', e.target.result);
                    $('#blah').attr('hidden', false);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".imageinput").change(function() {
            readURL(this);

        });
    </script>
@endsection
