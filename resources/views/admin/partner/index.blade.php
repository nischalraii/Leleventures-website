@extends('layouts.app')

@push('head-script')
    <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endpush

@if (in_array('add_partner', $userPermissions))
    @section('create-button')
        <a href="{{ route('admin.partner.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>
            @lang('app.createNew')</a>
    @endsection
@endif


@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>@lang('app.partner.name')</th>
                                <th>@lang('app.partner.image')</th>
                                <th>@lang('app.partner.slug')</th>
                                <th>@lang('app.partner.url')</th>
                                <th class="noExport">@lang('app.action')</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer-script')
    <script src="//cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        var table = $('#myTable').dataTable({
            responsive: true,
            serverSide: true,
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            ajax: '{!! route('admin.partner.data') !!}',

            language: languageOptions(),
            "fnDrawCallback": function(oSettings) {
                $("body").tooltip({
                    selector: '[data-toggle="tooltip"]'
                });
            },


            columns: [{
                    "targets": 0,
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                    width: '15%'
                },
                {
                    data: 'image',
                    name: 'image',
                    width: '25%',
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return '<div style="width: 100%; height: 100%; overflow: hidden; position: relative;  justify-content: center; align-items: center;">' +
                                '<a href="{{ asset('user-uploads/partners/') }}/' + data + '" target="_blank">' +
                                '<img src="{{ asset('user-uploads/partners/') }}/' + data +
                                '" class="img-thumbnail" alt="Image" style="width: 350px; height: auto; max-width: 100%; max-height: 180px; ">' +
                                '</a>' +
                                '</div>';
                        }
                        return data;
                    }

                },
                {
                    data: 'slug',
                    name: 'slug',
                    width: '10%'

                },

                {
                    data: 'url',
                    name: 'url',
                    width: '30%'
                },

                {
                    data: 'action',
                    name: 'action',
                    width: '10%'
                }
            ],


        });


        new $.fn.dataTable.FixedHeader(table);



        $('body').on('click', '.sa-params', function() {
            var id = $(this).data('row-id');
            var deleteUrl = $(this).data('url');
            swal({
                title: "@lang('app.messages.areYouSure')",
                text: "@lang('app.messages.deleteWarning')",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('app.delete')",
                cancelButtonText: "@lang('app.cancel')",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {

                    var url = "{{ route('admin.partner.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        data: {
                            '_token': token,
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                //                                    swal("Deleted!", response.message, "success");
                                table._fnDraw();
                            }
                        }
                    });
                }
            });
        })
    </script>
@endpush
