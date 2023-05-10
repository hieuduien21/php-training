<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Update Product</h1>  
        <form action="/products/update?id=<?php echo $data->id ?>" method="post" enctype="multipart/form-data"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr> 
                        <td class="align-middle">
                            <input value="<?php echo $data->name ?>" required type="text" name="name" class="form-control" placeholder="Product Name">    
                        </td>
                        <td class="align-middle">
                            <img src="/<?php echo $data->image ?>" alt="<?php echo $data->name ?>" class="img-fluid" style="width: 50px; height: 50px; object-fit:cover">
                            <input type="file" name="image" class="form-control" placeholder="Product Image">    
                        </td>
                        <td class="align-middle">
                            <input value="<?php echo $data->description ?>" required type="text" name="description" class="form-control" placeholder="Product Description"> 
                        </td>
                        <td class="align-middle">                        
                            <input value="<?php echo $data->price ?>" required type="text" name="price" class="form-control" placeholder="Product Price"> 
                        </td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </form>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>