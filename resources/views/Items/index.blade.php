<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-wrapper {
            border: 1px solid #000;
            margin-bottom: 10px;
            background-color: #b3d9ff;
            cursor: pointer;
            padding: 10px;
        }
        .text {
            font-size: 1.25rem;
        }
        .container-wrapper a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mt-4 mb-4">Items</h1>
        @foreach($items as $item)
            <div class="container-wrapper">
                <a href="{{ route('items.show', $item->name) }}">
                    <div class="text">{{ $item->name }}</div>
                </a>
            </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
