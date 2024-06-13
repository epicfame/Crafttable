<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title : 'Crafttable' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <style>
        .bs-linebreak {
            height:3px;
            background-color: white;
            width: 80%;
        }
        .alert {
            padding: 15px;
            margin-top: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>
    <div class="offcanvas offcanvas-start w-25 bg-dark" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas" style="color: white">Menu</h6>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 bs-linebreak">
            </div>
        </div>
        <div class="offcanvas-body px-0">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                <li class="nav-item">
                    <a href="/home" class="nav-link text-truncate" style="text-decoration:none">
                        <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Home</span>
                    </a>
                </li>
                <li>
                    <a href="/price-list" data-bs-toggle="collapse" class="nav-link text-truncate">
                        <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Price List</span> </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Orders</span></a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Purchasing</span></a>
                </li>
                <li>
                    <a href="/product" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Product</span></a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Inventory</span></a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Customer</span></a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Supplier</span></a>
                </li>
                {{-- <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fs-5 bi-bootstrap"></i>
                        <span class="ms-1 d-none d-sm-inline" style="color: white">Bootstrap</span>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdown">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Products</span></a>
                </li>
                <li>
                    <a href="#" class="nav-link text-truncate">
                        <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline" style="color: white">Customers</span> </a>
                </li> --}}
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col min-vh-100 p-4">
                <!-- toggler -->
                <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                    <i class="fa fa-arrows-alt fa-3x" aria-hidden="true"></i>
                </button>
                <h1>{{ $title }}</h1>
                <div id="flash-message" style="display: none;"></div>
                <hr>
                @yield('content')
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <!-- Bootstrap Modal for Custom Confirmation Dialog -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalHeader"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#confirmationModal').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="confirmationModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmButton">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#confirmationModal').modal('hide')">No</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Include DataTables CSS and JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <script>
        // FUNCTION FOR CONFIRMATION DIALOG
        function showConfirmationDialog(header, body, functionName) {
            $('#confirmationModalHeader').text(header);
            $('#confirmationModalBody').text(body);
            $('#confirmButton').data('functionName', functionName);
            $('#confirmationModal').modal('show');
        }

        function callFunctionByName(functionName) {
            if (typeof window[functionName] === 'function') {
                window[functionName]();
            } else {
                console.log(`Function ${functionName} not found`);
            }
        }

        $('#confirmButton').on('click', function() {
            let functionName = $(this).data('functionName');
            if (functionName) {
                callFunctionByName(functionName);
            }
            $('#confirmationModal').modal('hide');
        });

        // FUNCTION FOR SUCCESS/ERROR MESSAGE
        function showMessage(type, message, time) {
            let alertClass;

            switch(type) {
                case 'success':
                    alertClass = 'alert-success';
                    break;
                case 'error':
                    alertClass = 'alert-danger';
                    break;
                case 'info':
                    alertClass = 'alert-info';
                    break;
                default:
                    alertClass = 'alert-secondary';
            }

            $('#flash-message').html('<div class="alert ' + alertClass + '">' + message + '</div>').show();
            if(time != null && time != ''){
                setTimeout(function() {
                    $('#flash-message').fadeOut('slow');
                }, time * 1000); // time in seconds
            }
        }
    </script>

    @yield('script')
</body>
</html>
