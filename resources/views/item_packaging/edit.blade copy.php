
@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Item Packaging Configuration</h3>
    <form action="{{ route('item-packaging.update', $itemPackaging->packaging_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="item_id" class="form-label">Item</label>
            <select name="item_id" id="item_id" class="form-control" required>
                <option value="">Select Item</option>
                @foreach ($items as $item)
                    <option value="{{ $item->item_id }}" {{ $itemPackaging->item_id == $item->item_id ? 'selected' : '' }}>
                        {{ $item->item_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="packaging_id" class="form-label">Packaging Type</label>
            <select name="packaging_id" id="packaging_id" class="form-control" required>
                <option value="">Select Packaging</option>
                @foreach ($packagings as $pack)
                    <option value="{{ $pack->packaging_id }}" {{ $itemPackaging->packaging_id == $pack->packaging_id ? 'selected' : '' }}>
                        {{ $pack->packaging_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="unit_uom_id" class="form-label">Unit of Measure (UOM)</label>
            <select name="unit_uom_id" id="unit_uom_id" class="form-control" required>
                <option value="">Select UOM</option>
                @foreach ($uoms as $uom)
                    <option value="{{ $uom->uom_id }}" {{ $itemPackaging->unit_uom_id == $uom->uom_id ? 'selected' : '' }}>
                        {{ $uom->uom_name }} ({{ $uom->symbol }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="unit_quantity" class="form-label">Unit UOM id</label>
            <input type="text" name="unit_uom_id" id="unit_uom_id" class="form-control" value="{{ $itemPackaging->unit_quantity }}" required min="1">
        </div>

        <div class="mb-3">
            <label for="units_per_pack" class="form-label">Units per Pack</label>
            <input type="text" name="units_per_pack" id="units_per_pack" class="form-control" value="{{ $itemPackaging->units_per_pack }}" required min="1">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('item-packaging.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection






