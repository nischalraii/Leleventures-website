@extends('layouts.app')

@push('head-script')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/dropify/dist/css/dropify.min.css') }}">
    
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('app.edit')</h4>

                    <form id="editSettings" class="ajax-form">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc">@lang('app.about.desc')</label>
                                <textarea class="form-control fs-5" id="editor" name="desc">{{$aboutData->desc}}</textarea>
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
    <script>
        CKEDITOR.dtd.$removeEmpty.i = false;
        CKEDITOR.replace('editor', {
            
            allowedContent: true, 
            
            removePlugins: 'elementspath',
            resize_enabled: false
        });

        $('#save-form').click(function(e) {
            const editorData = CKEDITOR.instances.editor.getData();
            $('textarea[name="desc"]').val(editorData);

            $.easyAjax({
                url: '{{ route('admin.about.update', $aboutData ->id) }}',
                container: '#editSettings',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT',
                    desc: editorData
                },
                success: function(response) {
                    if(response.status === "success") {
                        window.location.href = '{{ route('admin.about.index') }}';
                    }
                }
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
    </script>
@endpush
