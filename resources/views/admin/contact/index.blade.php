@extends('layouts.app')

@push('head-script')
    <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endpush



@section('content')
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">


                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>@lang('app.contact.name')</th>
                                <th>@lang('app.contact.email')</th>
                                <th>@lang('app.contact.subject')</th>
                                <th>@lang('app.contact.message')</th>
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
        $('#save-form').click(function() {
            $.easyAjax({
                url: '{{ route('admin.contact.store') }}',
                container: '#editSettings',
                type: "POST",
                redirect: true,
                file: true
            })
        });


        var table = $('#myTable').dataTable({
            responsive: true,
            serverSide: true,
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            ajax: '{!! route('admin.contact.data') !!}',

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
                    data: 'email',
                    name: 'email',
                    width: '24%'

                },
                {
                    data: 'subject',
                    name: 'subject',
                    width: '15%'

                },
                {
                    data: 'message',
                    name: 'message',
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

                    var url = "{{ route('admin.contact.destroy', ':id') }}";
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
