<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <a class="btn btn-primary" href="{{ url('/test1') }}" role="button">Test 1</a>
    <a href="{{ url('test2') }}" class="btn btn-primary" role="button">Test 2</a>
    <a href="{{ url('test3') }}" class="btn btn-primary" role="button">Test 3</a>
    <a href="{{ url('test4') }}" class="btn btn-primary" role="button">Test 4</a>
    <div class="alert alert-warning" role="alert">
      Use can modify data test in File TestController in function of it for test1, test2, test3. Thanks you
    </div>
</body>

</html>
