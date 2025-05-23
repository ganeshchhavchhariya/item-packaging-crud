@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Map Default UOM to Item</h3>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('item-uom-mapping.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="item_id" class="form-label">Item</label>
            <select name="item_id" id="item_id" class="form-control" required>
                <option value="">Select Item</option>
                @foreach ($items as $item)
                <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="default_uom_id" class="form-label">Default UOM</label>
            <select name="default_uom_id" id="default_uom_id" class="form-control" required>
                <option value="">Select UOM</option>
                @foreach ($uoms as $uom)
                <option value="{{ $uom->uom_id }}">{{ $uom->uom_name }} ({{ $uom->symbol }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Map UOM</button>
    </form>
</div>
@endsection
