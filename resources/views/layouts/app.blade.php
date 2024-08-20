  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@lang('app.projectName') | {{ $pageTitle }}</title>
      <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
      <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon" />
      <!-- CSS Files -->
      <link rel="stylesheet" href="{{ asset('base/assets/css/bootstrap.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('base/assets/css/plugins.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('base/assets/css/kaiadmin.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('base/assets/css/fonts.min.css') }}" media="all">
      <!-- CSS Just for demo purpose, don't include it in your project -->
      <link rel="stylesheet" href="{{ asset('base/assets/css/demo.css') }}" />
      <link href="{{ asset('assets/node_modules/sweetalert/sweetalert.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
{{-- ckeditor --}}
  <link href="{{ asset('assets/ckeditor/sample.css') }}"  rel="stylesheet">

      @stack('head-script')

      <link rel='stylesheet prefetch' href='//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>

      <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
      <style>
          :root {
              --main-color: {{ config('app.mainColor') }};
          }

          .well,
          pre {
              background: #fff;
              border-radius: 0;
          }

          .btn-group-xs>.btn,
          .btn-xs {
              padding: .25rem .4rem;
              font-size: .875rem;
              line-height: .5;
              border-radius: .2rem;
          }

          .btn-circle {
              width: 30px;
              height: 30px;
              padding: 6px 0;
              border-radius: 15px;
              text-align: center;
              font-size: 12px;
              line-height: 1.428571429;
          }

          .well {
              min-height: 20px;
              padding: 19px;
              margin-bottom: 20px;
              background-color: #f5f5f5;
              border: 1px solid #e3e3e3;
              border-radius: 4px;
              -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
              font-size: 12px;
          }

          .text-truncate-notify {
              white-space: pre-wrap !important;
          }

          .image-container {
              display: flex;
              align-items: center;
          }

          .image-container .image {
              display: inline-block;
              position: relative;
              width: 32px;
              height: 32px;
              overflow: hidden;
              border-radius: 50%;
              margin-right: 10px;
          }

          .image-container .image img {
              width: auto;
              height: 100%;
          }

          #top-notification-dropdown>a {
              position: relative;
          }

          #top-notification-dropdown>a span {
              position: absolute;
              right: 10%;
              top: 10%;
          }

          #top-notification-dropdown>a span.badge {
              padding: 2px 5px;
          }

          .scrollable {
              max-height: 250px;
              overflow-y: scroll;
          }
      </style>

      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



      <!-- Fonts and icons -->
      <script src="{{ asset('base/assets/js/plugin/webfont/webfont.min.js') }}"></script>
      <script>
          WebFont.load({
              google: {
                  families: ["Public Sans:300,400,500,600,700"]
              },
              custom: {
                  families: [
                      "Font Awesome 5 Solid",
                      "Font Awesome 5 Regular",
                      "Font Awesome 5 Brands",
                      "simple-line-icons",
                  ],
                  urls: ["{{ asset('base/assets/css/fonts.min.css') }}"],
              },
              active: function() {
                  sessionStorage.fonts = true;
              },
          });
      </script>

      <script>
          $('body').on('click', '.right-side-toggle', function() {
              $("body").removeClass("control-sidebar-slide-open");
          });

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $(function() {
              $('.selectpicker').selectpicker({
                  style: 'btn-info',
                  size: 4
              });
          });

          function languageOptions() {
              return {
                  processing: "@lang('app.datatables.processing')",
                  search: "@lang('app.datatables.search')",
                  lengthMenu: "@lang('app.datatables.lengthMenu')",
                  info: "@lang('app.datatables.info')",
                  infoEmpty: "@lang('app.datatables.infoEmpty')",
                  infoFiltered: "@lang('app.datatables.infoFiltered')",
                  infoPostFix: "@lang('app.datatables.infoPostFix')",
                  loadingRecords: "@lang('app.datatables.loadingRecords')",
                  zeroRecords: "@lang('app.datatables.zeroRecords')",
                  emptyTable: "@lang('app.datatables.emptyTable')",
                  paginate: {
                      first: "@lang('app.datatables.paginate.first')",
                      previous: "@lang('app.datatables.paginate.previous')",
                      next: "@lang('app.datatables.paginate.next')",
                      last: "@lang('app.datatables.paginate.last')",
                  },
                  aria: {
                      sortAscending: "@lang('app.datatables.aria.sortAscending')",
                      sortDescending: "@lang('app.datatables.aria.sortDescending')",
                  },
              }
          }

          $('#mark-notification-read').click(function() {
              var token = '{{ csrf_token() }}';
              $.easyAjax({
                  type: 'POST',
                  url: '{{ route('mark-notification-read') }}',
                  data: {
                      '_token': token
                  },
                  success: function(data) {
                      if (data.status == 'success') {
                          $('.top-notifications').remove();
                          $('#top-notification-dropdown .notify').remove();
                          window.location.reload();
                      }
                  }
              });

          });

          // $('body').on('click', '.view-notification', function(event) {
          $('.read-notification').click(function() {
              event.preventDefault();
              var id = $(this).data('notification-id');
              //  var href = $(this).attr('href');
              var dataUrl = $(this).data('link');

              $.easyAjax({
                  url: "{{ route('mark_single_notification_read') }}",
                  type: "POST",
                  data: {
                      '_token': "{{ csrf_token() }}",
                      'id': id
                  },
                  success: function() {

                      if (typeof dataUrl !== 'undefined') {
                          window.location = dataUrl;
                      }
                  }
              });
          });

          // search input implementation
          function search($input, doneTypingInterval, type) {
              var $anchor = $input.siblings('a');
              var typingTimer, fn;

              if (type == 'data') {
                  fn = loadData;
              }
              if (type == 'table') {
                  fn = redrawTable;
              }

              $input.on('keyup', function(e) {
                  if ($(this).val() !== '' || ($(this).val().length >= 0 && e.key === 'Backspace')) {
                      clearTimeout(typingTimer);
                      typingTimer = setTimeout(() => {
                          fn();
                      }, doneTypingInterval);
                  }

                  $(this).val() !== '' ? $anchor.removeClass('d-none') : $anchor.addClass('d-none');
              })

              $input.on('keydown', function() {
                  clearTimeout(typingTimer);
              });

              $anchor.click(function(e) {
                  $(this).siblings('input').val('');
                  fn();
                  $anchor.addClass('d-none');
                  $(this).siblings('input').focus();
              })
          }

          $('body').on('click', '.toggle-password', function() {
              var $selector = $(this).parent().find('input.form-control');
              $(this).toggleClass("fa-eye fa-eye-slash");
              var $type = $selector.attr("type") === "password" ? "text" : "password";
              $selector.attr("type", $type);
          });
      </script>
  </head>

  <body>
      <div class="wrapper">
          <!-- Sidebar -->
          <div class="sidebar" data-background-color="dark">
              <div class="sidebar-logo">
                  <!-- Logo Header -->
                  <div class="logo-header" data-background-color="dark">
                      <a href="index.html" class="logo">
                          <img src="{{asset('assets/img/logo.png')}}" alt="navbar brand" class="navbar-brand"
                              height="20" />
                      </a>
                      <div class="nav-toggle">
                          <button class="btn btn-toggle toggle-sidebar">
                              <i class="gg-menu-right"></i>
                          </button>
                          <button class="btn btn-toggle sidenav-toggler">
                              <i class="gg-menu-left"></i>
                          </button>
                      </div>
                      <button class="topbar-toggler more">
                          <i class="gg-more-vertical-alt"></i>
                      </button>
                  </div>
                  <!-- End Logo Header -->
              </div>
              @include('sections.left-sidebar')




          </div>

          

          <!--   Core JS Files   -->
          <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
          {{-- <script src="{{ asset('base/assets/js/core/jquery-3.7.1.min.js') }}"></script> --}}
          <script src="{{ asset('base/assets/js/core/popper.min.js') }}"></script>
          <script src="{{ asset('base/assets/js/core/bootstrap.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
          <!-- jQuery Scrollbar -->
          <script src="{{ asset('base/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
          <!-- Chart JS -->
          <script src="{{ asset('base/assets/js/plugin/chart.js/chart.min.js') }}"></script>

          <!-- jQuery Sparkline -->
          <script src="{{ asset('base/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

          <!-- Chart Circle -->
          <script src="{{ asset('base/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

          <!-- Datatables -->
          <script src="{{ asset('base/assets/js/plugin/datatables/datatables.min.js') }}"></script>

          <!-- FastClick -->
          <script src="{{ asset('assets/plugins/fastclick/fastclick.js') }}"></script>
          <!-- AdminLTE App -->
          <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

          <script src='https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.0/dist/js/bootstrap-select.min.js'></script>
          <script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>

          <script src="{{ asset('helper/helper.js') }}"></script>
          <script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
          <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
          <script src="{{ asset('assets/plugins/icheck/icheck.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/icheck/icheck.init.js') }}"></script>
          <script src="{{ asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
          <script src="{{ asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>

          <!-- Bootstrap Notify -->
          <script src="{{ asset('base/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

          <!-- jQuery Vector Maps -->
          <script src="{{ asset('base/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
          <script src="{{ asset('base/assets/js/plugin/jsvectormap/world.js') }}"></script>

          <!-- Sweet Alert -->
          {{-- <script src="{{ asset('base/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}

          <script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
          <!-- Kaiadmin JS -->
          <script src="{{ asset('base/assets/js/kaiadmin.min.js') }}"></script>

          <!-- Datatable Buttons -->
          <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.dataTables.min.css') }}">
          <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
          <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
          

          


          <script>
              $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                  type: "line",
                  height: "70",
                  width: "100%",
                  lineWidth: "2",
                  lineColor: "#177dff",
                  fillColor: "rgba(23, 125, 255, 0.14)",
              });

              $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                  type: "line",
                  height: "70",
                  width: "100%",
                  lineWidth: "2",
                  lineColor: "#f3545d",
                  fillColor: "rgba(243, 84, 93, .14)",
              });

              $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                  type: "line",
                  height: "70",
                  width: "100%",
                  lineWidth: "2",
                  lineColor: "#ffa534",
                  fillColor: "rgba(255, 165, 52, .14)",
              });
          </script>

          <script>
              $(document).ready(function() {
                  // Add Row

                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });

                  var action =
                      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

                  $("#save-form").click(function() {
                      $("#add-row")
                          .dataTable()
                          .fnAddData([
                              $("#title").val(),
                              $("#link").val(),
                              $("#position").val(),
                              $("#section").val(),
                              action,
                          ]);
                      pageLength: 25,
                          $("#addRowModal").modal("hide");
                  });
              });
          </script>

          @stack('footer-script')
  </body>

  </html>
