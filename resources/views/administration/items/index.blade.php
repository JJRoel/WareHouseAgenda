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
                <tr>
                    <td>
                        <a href="{{ route('administration.items.showall') }}" class="item-link">
                            <div class="text">All</div>
                        </a>
                    </td>
                </tr>
                @foreach($items->unique('groupid') as $item)
                    <tr>
                        <td>
                            <a href="{{ route('administration.items.show', $item->groupid) }}" class="item-link">
                                <div class="text">{{ $item->group->name }}</div>
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
