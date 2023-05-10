<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php if (!empty($_SESSION['message'])) {?>
            <div class="message mt-2 mb-2">
                <?php foreach ($_SESSION['message'] as $mess) { ?>
                    <div class="mb-2 alert alert-<?php echo $mess->type == 'success' ? 'success' : 'danger' ?> d-flex align-items-center" role="alert">
                        <?php
                        echo $mess->type == 'success'
                        ?
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>'
                        :
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>'
                        ?>    
                    
                        <div>
                            <?php echo $mess->message ?>
                        </div>
                    </div>
                <?php } ?>    
            </div>
        <?php unset($_SESSION['message']); } ?>    
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
                <?php foreach ($products as $i => $item) { ?>
                    <tr>
                        <th class="align-middle" scope="row"><?php echo $i + 1 ?></th>
                        <td class="align-middle"><?php echo $item->name ?></td>
                        <td>
                            <img src="/<?php echo $item->image ?>" alt="<?php echo $item->name ?>" class="img-fluid" style="width: 50px; height: 50px; object-fit:cover">
                        </td>
                        <td class="align-middle"><?php echo $item->description ?></td>
                        <td class="align-middle"><?php echo $item->price ?></td>
                        <td class="align-middle">
                            <a class="btn btn-primary" href="/products/update?id=<?php echo $item->id ?>">
                                Edit
                            </a>
                            <a class="btn btn-danger ms-2" href="/products/delete?id=<?php echo $item->id ?>">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>