@extends('layouts.app')

@section('title', 'Items List')

@section('content')
    <div class="container mt-5">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items->unique('name') as $item)
                    <tr>
                        <td>
                            <a href="{{ url('/items/' . $item->name) }}" class="item-link">
                                <div class="text">{{ $item->name }}</div>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .text {
            font-size: 1.25rem;
            color: black;
        }
        .item-link {
            color: black;
            text-decoration: none;
        }
        .item-link:hover {
            color: black;
            text-decoration: underline;
        }
    </style>
@endsection
