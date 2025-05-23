<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Add Packaging</title>

  <!-- Fonts and Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- CSS Plugins -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar and Sidebar -->
  @include('layouts.header')
  @include('layouts.sidebar')
  <!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Products</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Packaging</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header"><h3 class="card-title">Add New Packaging</h3></div>
          <div class="card-body">
            <form action="{{ route('itemPackaging.store') }}" method="POST">
              @csrf

              <!-- Item -->
              <div class="form-group">
                <label for="item_id">Item</label>
                <div class="input-group">
                  <select name="item_id" id="item_id" class="form-control" required>
                    <option value="">Select Item</option>
                    @foreach($items as $item)
                      <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="addItemBtn">
                      <i class="fas fa-plus"></i> Add Item
                    </button>
                  </div>
                </div>
                <div id="newItemInput" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" id="newItemName" placeholder="Enter new item name">
                  <button type="button" class="btn btn-success mt-2" id="saveNewItem">Save</button>
                  <button type="button" class="btn btn-danger mt-2" id="cancelNewItem">Cancel</button>
                </div>
              </div>

              <!-- Packaging -->
              <div class="form-group">
                <label for="packaging_id">Packaging</label>
                <div class="input-group">
                  <select name="packaging_id" id="packaging_id" class="form-control" required>
                    <option value="">Select Packaging</option>
                    @foreach($packagings as $packaging)
                      <option value="{{ $packaging->packaging_id }}">{{ $packaging->packaging_name }}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="addPackagingBtn">
                      <i class="fas fa-plus"></i> Add Packaging
                    </button>
                  </div>
                </div>
                <div id="newPackagingInput" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" id="newPackagingName" placeholder="Enter new packaging name">
                  <button type="button" class="btn btn-success mt-2" id="saveNewPackaging">Save</button>
                  <button type="button" class="btn btn-danger mt-2" id="cancelNewPackaging">Cancel</button>
                </div>
              </div>

              <!-- UOM -->
              <div class="form-group">
                <label for="uom_id">Select UOM</label>
                <div class="input-group">
                  <select name="uom_id" id="uom_id" class="form-control" required>
                    <option value="">-- Select UOM --</option>
                    @foreach($uoms as $uom)
                      <option value="{{ $uom->uom_id }}">{{ $uom->uom_name }}</option>
                    @endforeach
                  </select>
                  @error('uom_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror 
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="addUomBtn">
                      <i class="fas fa-plus"></i> Add UOM
                    </button>
                  </div>
                </div>
                <div id="newUomInput" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" name="newUomName" id="newUomName" placeholder="Enter new UOM Name">
                  <input type="text" name="newUomSymbol" id="newUomSymbol" placeholder="Enter new UOM Symbol">
                  <button type="button" class="btn btn-success mt-2" id="saveNewUom">Save</button>
                  <button type="button" class="btn btn-danger mt-2" id="cancelNewUom">Cancel</button>
                </div>
              </div>


              <!-- Units per Pack -->
              <div class="form-group">
                <label for="units_per_pack">Units per Pack</label>
                <input type="number" name="units_per_pack" id="units_per_pack" class="form-control" required>
              </div>

              <!-- Unit Quantity -->
              <div class="form-group">
                <label for="unit_quantity">Unit Quantity</label>
                <input type="number" name="unit_quantity" id="unit_quantity" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary">Save</button>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Page specific script -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        // Create a global jQuery object
        window.jQuery = window.$ = jQuery;
    </script>

    <!-- AdminLTE -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    
    <!-- PACE -->
    <script>
        window.paceOptions = {
            ajax: {
                trackWebSockets: false
            }
        };
    </script>
    <script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>

    <!-- Card Refresh -->
    <script src="{{asset('vendor/adminlte/build/js/CardRefresh.js')}}"></script>

    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Item functionality
    const addItemBtn = document.getElementById('addItemBtn');
    const newItemInput = document.getElementById('newItemInput');
    const saveNewItem = document.getElementById('saveNewItem');
    const cancelNewItem = document.getElementById('cancelNewItem');
    const itemSelect = document.getElementById('item_id');

    addItemBtn.addEventListener('click', function() {
      newItemInput.style.display = 'block';
      document.getElementById('newItemName').focus();
    });

    cancelNewItem.addEventListener('click', function() {
      newItemInput.style.display = 'none';
      document.getElementById('newItemName').value = '';
    });

    saveNewItem.addEventListener('click', function(event) {
      event.preventDefault();
      const itemName = $('#newItemName').val().trim();
      const selectedUom = $('#uom_id').val();
      
      if (!itemName) {
        alert('Please enter an item name');
        return;
      }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '/ajax/add-item',
        type: 'POST',
        data: {
          name: itemName,
          uom_id: selectedUom
        },
        success: function(response) {
          if (response.success) {
            const newOption = document.createElement('option');
            newOption.value = response.item_id;
            newOption.textContent = itemName;
            $('#item_id').append(newOption);
            $('#item_id').val(response.item_id);
            
            $('#newItemInput').hide();
            $('#newItemName').val('');
            
            alert('Item added successfully');
          } else {
            alert('Failed to add item: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message : error));
        }
      });
    });

    // Packaging functionality
    const addPackagingBtn = document.getElementById('addPackagingBtn');
    const newPackagingInput = document.getElementById('newPackagingInput');
    const saveNewPackaging = document.getElementById('saveNewPackaging');
    const cancelNewPackaging = document.getElementById('cancelNewPackaging');
    const packagingSelect = document.getElementById('packaging_id');

    addPackagingBtn.addEventListener('click', function() {
      newPackagingInput.style.display = 'block';
      document.getElementById('newPackagingName').focus();
    });

    cancelNewPackaging.addEventListener('click', function() {
      newPackagingInput.style.display = 'none';
      document.getElementById('newPackagingName').value = '';
    });

    saveNewPackaging.addEventListener('click', function() {
      const newPackagingName = document.getElementById('newPackagingName').value.trim();
      if (newPackagingName) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          url: '/ajax/add-packaging',
          type: 'POST',
          data: {
            name: newPackagingName
          },
          success: function(response) {
            if (response.success) {
              const newOption = document.createElement('option');
              newOption.value = response.packaging_id;
              newOption.textContent = response.packaging_name;
              packagingSelect.appendChild(newOption);
              packagingSelect.value = response.packaging_id;
              
              newPackagingInput.style.display = 'none';
              document.getElementById('newPackagingName').value = '';
              
              // Show success message
              alert('Packaging added successfully');
            } else {
              alert('Failed to add packaging: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            alert('Error: ' + (xhr.responseJSON ? xhr.responseJSON.message : error));
          }
        });
      }
    });

    // UOM functionality
    const addUomBtn = document.getElementById('addUomBtn');
    const newUomName = document.getElementById('newUomName');
    const newUomSymbol = document.getElementById('newUomSymbol');
    const saveNewUom = document.getElementById('saveNewUom');
    const cancelNewUom = document.getElementById('cancelNewUom');
    const uomSelect = document.getElementById('uom_id');

    addUomBtn.addEventListener('click', function() {
      newUomInput.style.display = 'block';
    });

    cancelNewUom.addEventListener('click', function() {
      newUomInput.style.display = 'none';
      document.getElementById('newUomName').value = '';
    });

    saveNewUom.addEventListener('click', function() {
      const newUomName = document.getElementById('newUomName').value.trim();
      const newUomSymbol = document.getElementById('newUomSymbol').value.trim();
      
      if (newUomName) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          url: '/ajax/addUOM',
          type: 'POST',
          data: {
            uom_name: newUomName,
            uom_symbol: newUomSymbol,
              },
          success: function(response) {
            if (response.success) {
              const newOption = document.createElement('option');
              newOption.value = response.uom_id;
              newOption.textContent = response.name;
              uomSelect.appendChild(newOption);
              uomSelect.value = response.uom_id;
              
              newUomInput.style.display = 'none';
              document.getElementById('newUomName').value = '';
              document.getElementById('newUomSymbol').value = '';

              // Show success message
              alert('UOM added successfully');
            } else {
              alert('Failed to add UOM: ' + response.message);
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
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const uomSelect = document.getElementById('uom_id');
    if (!uomSelect.value) {
        alert('Please select a UOM before adding the item.');
        e.preventDefault(); // Stop form submission
    }
});
</script>

</body>
</html>
