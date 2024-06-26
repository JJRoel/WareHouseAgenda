<!-- resources/views/test-view.blade.php -->
@extends('layouts.app')

@section('title', 'All Items')

@section('content')
    <div class="container mt-5">
        <h1>All Items</h1>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Name</th>
                    <th>Aanschafdatum</th>
                    <th>Tiernummer</th>
                    <th>Status</th>
                    <th>Picture</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->groupid }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->aanschafdatum }}</td>
                        <td>{{ $item->tiernummer }}</td>
                        <td>
                            <form action="{{ route('administration.items.updateStatus', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="in_storage" {{ $item->status == 'in_storage' ? 'selected' : '' }}>In Storage</option>
                                    <option value="reparing" {{ $item->status == 'reparing' ? 'selected' : '' }}>Reparing</option>
                                    <option value="out_of_order" {{ $item->status == 'out_of_order' ? 'selected' : '' }}>Out of Order</option>
                                </select>
                            </form>
                        </td>
                        <td><img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="img-fluid"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('administration.items.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
