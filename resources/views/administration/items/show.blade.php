@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
    <div class="container mt-5">
        <h1>{{ $items->first()->name }} Details</h1>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Group ID</th>
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
                        <td>{{ $item->aanschafdatum }}</td>
                        <td>{{ $item->tiernummer }}</td>
                        <td>{{ $item->status }}</td>
                        <td><img src="{{ asset($item->picture) }}" alt="{{ $item->name }}" class="img-fluid"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('administration.items.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
