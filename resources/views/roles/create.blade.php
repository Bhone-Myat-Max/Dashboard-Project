{{-- {{dd($PermissionModel)}} --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">+ Role Add</div>
            <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Role Name --}}
                <div class="card-body">
                    <label for="name" class="form-input-label mb-2">Role Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter Category Name" name="name" value="{{ old('name') }}" />
                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- Permission --}}
                <div class="card-body">
                    <label for="name" class="form-input-label mb-2">Role Name:</label><br>
                    @foreach ($PermissionModel as $PermissionList)
                        <label for="permission">
                            <input type="checkbox" name="permission[]"  value="{{ $PermissionList->id }}" placeholder="" />
                            {{ $PermissionList->name }}
                            {{-- class="@error('name') is-invalid @enderror" --}}
                        </label>
                    @endforeach
                    {{-- @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror --}}
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary btn-sm me-2">Create</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
