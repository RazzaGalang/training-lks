<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TokoBuku! Admin</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">TokoBuku! Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Admin</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                    <a href="{{ route('logout')}}" 
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="dropdown-item text-dark">
                                        Log Out    
                                    </a>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product Data</h6>
                        </div>

                        <div class="card-body">
                            
                            @if ($errors -> all())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Kesalahan!</strong> Pastikan anda mengisi form dengan benar!
                            </div>
                            @endif

                            @if (session('messagehapus'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert1">
                                {{session('messagehapus')}}
                            </div>
                            @endif

                            @if (session('messagetambah'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert1">
                                {{session('messagetambah')}}
                            </div>
                            @endif

                            @if (session('messageedit'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert1">
                                {{session('messageedit')}}
                            </div>
                            @endif
                        
                            <a href="#" data-toggle="modal" data-target="#tambahModal">
                                <button type="submit" name="tambahdata" class="btn btn-success">
                                    Add Product
                                </button>
                            </a><p></p>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Code Product</th>
                                            <th>Product Name</th>
                                            <th>Category ID</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Pict.</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>            
                                    <tbody>
                                        @foreach ($product as $index => $s)
                                        <tr>
                                            <td>{{$s -> product_id}}</td>
                                            <td>{{$s -> product_name}}</td>
                                            <td>{{$s -> category_id}}</td>
                                            <td>{{$s -> description}}</td>
                                            <td>{{$s -> price}}</td>
                                            <td>{{$s -> pict}}</td>
                                            <td>
                                                <center>
                                                    <a href="#" data-toggle="modal" data-target="#editModal{{$s->product_id}}" class="btn btn-warning btn-circle btn-sm">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </a>

                                                    <a href="#" data-toggle="modal" data-target="#hapusModal{{$s ->product_id}}" class="btn btn-danger btn-circle btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal
                                        <div class="modal fade" id="editModal{{$s->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="addproduct" id="addproduct" action="/admin/add " method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="product_name" class="form-label">Product Name</label>
                                                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Enter the Product Name" value=" {{ old('product_name', $s -> product_name)}}" >
                                                                    @error('product_name')
                                                                        <span class = "invalid-feedback">{{$message}}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="category_id" class="form-label">Category ID</label>
                                                                    <input type="text" class="form-control @error('category_id') is-invalid @enderror" id="category_id" placeholder="Enter the Category ID" value=" {{ old('category_id', $s -> category_id)}}" >
                                                                    @error('category_id')
                                                                        <span class = "invalid-feedback">{{$message}}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Description</label>
                                                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $s -> description)}}</textarea>
                                                                    @error('description')
                                                                        <span class = "invalid-feedback">{{$message}}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="price" class="form-label">Price</label>
                                                                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the Product Price" value=" {{ old('price', $s -> price)}}" >
                                                                    @error('price')
                                                                        <span class = "invalid-feedback">{{$message}}</span>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-danger" href="/admin/add">Add Product</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- Hapus Modal-->
                                        <div class="modal fade" id="hapusModal{{$s->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Apakah ingin menghapus data?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Ketuk "Hapus" untuk menghapus data.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-danger" href="admin/delete/{{$s ->product_id}}">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <!-- Tambah Modal-->
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form name="addproduct" id="addproduct" action="/admin/add" method="GET" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="add_product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control @error('add_product_name') is-invalid @enderror" id="add_product_name" placeholder="Enter the Product Name" value=" {{ old('add_product_name')}}" >
                                    @error('add_product_name')
                                        <span class = "invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="add_category_id" class="form-label">Category ID</label>
                                    <input type="text" class="form-control @error('add_category_id') is-invalid @enderror" id="add_category_id" placeholder="Enter the Category ID" value=" {{ old('add_category_id')}}" >
                                    @error('add_category_id')
                                        <span class = "invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="add_description" class="form-label">Description</label>
                                    <textarea class="form-control @error('add_description') is-invalid @enderror" id="add_description" rows="3" value=" {{ old('add_description')}}" ></textarea>
                                    @error('add_description')
                                        <span class = "invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="add_price" class="form-label">Price</label>
                                    <input type="text" class="form-control @error('add_price') is-invalid @enderror" id="add_price" placeholder="Enter the Product Price" value=" {{old('add_price')}}" >
                                    @error('add_price')
                                        <span class = "invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="add_pict" class="form-label">Pict</label>
                                    <input type="file" class="form-control @error('add_pict') is-invalid @enderror" id="add_pict" value=" {{old('add_pict')}}" >
                                    @error('add_pict')
                                        <span class = "invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="produktambah" class="btn btn-success">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

</body>

</html>