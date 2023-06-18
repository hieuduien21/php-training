<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container"> 
        <div class="d-flex align-items-center justify-content-between mt-5 mb-3">
            <h1 class="">List Product</h1>
            <a href="/products/add" type="button" class="btn btn-primary">Create</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th>Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $item)
                    <tr>
                        <th class="align-middle" scope="row">{{$i + 1}}</th>
                        <td class="align-middle">{{$item->name}}</td>
                        <td>
                            <img src="/{{$item->image}}" alt="{{$item->name}}" class="img-fluid" style="width: 50px; height: 50px; object-fit:cover">
                        </td>
                        <td class="align-middle">{{$item->description}}</td>
                        <td class="align-middle">{{$item->price}}</td>
                        <td class="align-middle">
                            <a class="btn btn-primary" href="/products/update?id={{$item->id}}">
                                Edit
                            </a>
                            <a class="btn btn-danger ms-2" href="/products/delete?id={{$item->id}}">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>