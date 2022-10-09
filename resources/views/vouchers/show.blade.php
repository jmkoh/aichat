<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if ($id)
    
    <form method="POST" action="/vouchers/redemn/{{$id->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Upload your image: <br />
        <input type="file" name="image" accept="image/*" >
       
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            Submit your image
    </button>
    </form>
    @else
    No Voucher left
    @endif
   
</body>
</html>