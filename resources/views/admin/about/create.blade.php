@extends('layouts.app')

@push('head-script')
    <style>
        .field-icon {
            float: right;
            cursor: pointer;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
            margin-right: 7px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/node_modules/dropify/dist/css/dropify.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">@lang('app.createNew')</h4>

                <form id="editSettings" class="ajax-form">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desc">@lang('app.about.desc')</label>
                            <textarea class="form-control fs-5" id="editor" name="desc" rows="4"></textarea>
                        </div>
                    </div>

                    <button type="button" id="save-form" class="btn btn-success waves-effect waves-light m-r-10">
                        @lang('app.save')
                    </button>
                    <button type="reset" class="btn btn-inverse waves-effect waves-light">@lang('app.reset')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-script')
    <script src="{{ asset('assets/node_modules/dropify/dist/js/dropify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/select2/select2.js') }}"></script>

    <script>
        CKEDITOR.replace('editor');

        $('#save-form').click(function(e) {
            const editorData = CKEDITOR.instances.editor.getData();
            $('textarea[name="desc"]').val(editorData);

            $.easyAjax({
                url: '{{ route('admin.about.store') }}',
                container: '#editSettings',
                type: "POST",
                redirect: true,
                file: true
            });
        });

        $('.dropify').dropify({
            messages: {
                default: '@lang('app.dragDrop')',
                replace: '@lang('app.dragDropReplace')',
                remove: '@lang('app.remove')',
                error: '@lang('app.largeFile')'
            }
        });

        $(function() {
            $('.field-icon').click(function() {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#password').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });
        });

        $(document).ready(function() {
            $('.select').select2();
        });
    </script>
@endpush
