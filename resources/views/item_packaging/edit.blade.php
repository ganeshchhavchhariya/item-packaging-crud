<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE | Edit Packaging</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  @include('layouts.header')

  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Packaging</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit New Packaging</h3>
          </div>
          <div class="card-body">
          <form action="{{ route('item-packaging.update', $itemPackaging->item_pack_id) }}" method="POST">
        @csrf
        @method('PUT')
              <!-- Item -->
              <div class="form-group">
                <label for="item_id">Item</label>
                <div class="input-group">
                  <select name="item_id" id="item_id" class="form-control" required>
                    <option value="">Select Item</option>
                    @foreach($items as $item)
                      <option value="{{ $item->item_id }}" {{ $itemPackaging->item_id == $item->item_id ? 'selected' : '' }}>{{ $item->item_name }}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="editItemBtn">
                      <i class="fas fa-edit"></i> Edit Item
                    </button>
                  </div>
                </div>
                <div id="editItemInput" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" id="editItemName" placeholder="Enter new item name">
                  <button type="button" class="btn btn-success mt-2" id="saveEditItem">Save</button>
                  <button type="button" class="btn btn-danger mt-2" id="cancelEditItem">Cancel</button>
                </div>
              </div>

              <!-- Packaging -->
              <div class="form-group">
                <label for="packaging_id">Packaging</label>
                <div class="input-group">
                  <select name="packaging_id" id="packaging_id" class="form-control" required>
                    <option value="">Select Packaging</option>
                    @foreach($packagings as $packaging)
                      <option value="{{ $packaging->packaging_id }}" {{ $itemPackaging->packaging_id == $packaging->packaging_id ? 'selected' : '' }}>{{ $packaging->packaging_name }}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="editPackagingBtn">
                      <i class="fas fa-edit"></i> Edit Packaging
                    </button>
                  </div>
                </div>
                <div id="editPackagingInput" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" id="editPackagingName" placeholder="Enter new packaging name">
                  <button type="button" class="btn btn-success mt-2" id="saveEditPackaging">Save</button>
                  <button type="button" class="btn btn-danger mt-2" id="cancelEditPackaging">Cancel</button>
                </div>
              </div>

              <!-- UOM -->
              <div class="form-group">
                <label for="uom_id">UOM</label>
                <div class="input-group">
                  <select name="uom_id" id="uom_id" class="form-control" required>
                    <option value="">Select UOM</option>
                    @foreach($uoms as $uom)
                      <option value="{{ $uom->uom_id }}" {{ $itemPackaging->unit_uom_id == $uom->uom_id ? 'selected' : '' }}>{{ $uom->uom_name }}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="editUomBtn">
                      <i class="fas fa-edit"></i> Edit UOM
                    </button>
                  </div>
                </div>
                <div id="editUomInput" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" id="editUomName" placeholder="Enter new UOM name">
                  <input type="text" class="form-control mt-2" id="editUomSymbol" placeholder="Enter UOM symbol">
                  <button type="button" class="btn btn-success mt-2" id="saveEditUom">Save</button>
                  <button type="button" class="btn btn-danger mt-2" id="cancelEditUom">Cancel</button>
                </div>
              </div>

              <!-- Unit Quantity -->
              <div class="form-group">
                <label for="unit_quantity">Unit Quantity</label>
                <input type="number" name="unit_quantity" id="unit_quantity" class="form-control" required 
                       value="{{ $itemPackaging->unit_quantity }}" min="1">
                @error('unit_quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <!-- Units per Pack -->
              <div class="form-group">
                <label for="units_per_pack">Units per Pack</label>
                <input type="number" name="units_per_pack" id="units_per_pack" class="form-control" required 
                       value="{{ $itemPackaging->units_per_pack }}" min="1">
                @error('units_per_pack')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Save</button>

            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy;
      <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>



<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="path/to/CardRefresh.js"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add CSRF token to AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Item edit functionality
    const editItemBtn = document.getElementById('editItemBtn');
    const editItemInput = document.getElementById('editItemInput');
    const saveEditItem = document.getElementById('saveEditItem');
    const cancelEditItem = document.getElementById('cancelEditItem');
    const itemSelect = document.getElementById('item_id');

    editItemBtn.addEventListener('click', function() {
        editItemInput.style.display = 'block';
        document.getElementById('editItemName').focus();
    });

    cancelEditItem.addEventListener('click', function() {
        editItemInput.style.display = 'none';
        document.getElementById('editItemName').value = '';
    });

    saveEditItem.addEventListener('click', function() {
        const newItemName = document.getElementById('editItemName').value.trim();
        if (newItemName) {
            $.ajax({
                url: '/ajax/edit-item',
                type: 'POST',
                data: {
                    item_id: itemSelect.value,
                    name: newItemName
                },
                success: function(response) {
                    if (response.success) {
                        const selectedOption = itemSelect.querySelector(`option[value="${itemSelect.value}"]`);
                        if (selectedOption) {
                            selectedOption.textContent = newItemName;
                        }
                        editItemInput.style.display = 'none';
                        document.getElementById('editItemName').value = '';
                        alert('Item updated successfully');
                    } else {
                        alert('Failed to update item: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message : error));
                }
            });
        }
    });

    // Packaging edit functionality
    const editPackagingBtn = document.getElementById('editPackagingBtn');
    const editPackagingInput = document.getElementById('editPackagingInput');
    const saveEditPackaging = document.getElementById('saveEditPackaging');
    const cancelEditPackaging = document.getElementById('cancelEditPackaging');
    const packagingSelect = document.getElementById('packaging_id');

    editPackagingBtn.addEventListener('click', function() {
        editPackagingInput.style.display = 'block';
        document.getElementById('editPackagingName').focus();
    });

    cancelEditPackaging.addEventListener('click', function() {
        editPackagingInput.style.display = 'none';
        document.getElementById('editPackagingName').value = '';
    });

    saveEditPackaging.addEventListener('click', function() {
        const newPackagingName = document.getElementById('editPackagingName').value.trim();
        if (newPackagingName) {
            $.ajax({
                url: '/ajax/edit-packaging',
                type: 'POST',
                data: {
                    packaging_id: packagingSelect.value,
                    name: newPackagingName
                },
                success: function(response) {
                    if (response.success) {
                        const selectedOption = packagingSelect.querySelector(`option[value="${packagingSelect.value}"]`);
                        if (selectedOption) {
                            selectedOption.textContent = newPackagingName;
                        }
                        editPackagingInput.style.display = 'none';
                        document.getElementById('editPackagingName').value = '';
                        alert('Packaging updated successfully');
                    } else {
                        alert('Failed to update packaging: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message : error));
                }
            });
        }
    });

    // UOM edit functionality
    const editUomBtn = document.getElementById('editUomBtn');
    const editUomInput = document.getElementById('editUomInput');
    const saveEditUom = document.getElementById('saveEditUom');
    const cancelEditUom = document.getElementById('cancelEditUom');
    const uomSelect = document.getElementById('uom_id');

    editUomBtn.addEventListener('click', function() {
        editUomInput.style.display = 'block';
        document.getElementById('editUomName').focus();
    });

    cancelEditUom.addEventListener('click', function() {
        editUomInput.style.display = 'none';
        document.getElementById('editUomName').value = '';
        document.getElementById('editUomSymbol').value = '';
    });

    saveEditUom.addEventListener('click', function() {
        const newUomName = document.getElementById('editUomName').value.trim();
        const newUomSymbol = document.getElementById('editUomSymbol').value.trim();
        
        if (newUomName) {
            $.ajax({
                url: '/ajax/edit-uom',
                type: 'POST',
                data: {
                    uom_id: uomSelect.value,
                    name: newUomName,
                    symbol: newUomSymbol
                },
                success: function(response) {
                    if (response.success) {
                        const selectedOption = uomSelect.querySelector(`option[value="${uomSelect.value}"]`);
                        if (selectedOption) {
                            selectedOption.textContent = newUomName;
                        }
                        editUomInput.style.display = 'none';
                        document.getElementById('editUomName').value = '';
                        document.getElementById('editUomSymbol').value = '';
                        alert('UOM updated successfully');
                    } else {
                        alert('Failed to update UOM: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message : error));
                }
            });
        }
    });
});
</script>
</body>
</html>
