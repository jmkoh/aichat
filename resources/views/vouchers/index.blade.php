<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

  <div>
  @if($errors->any())
  <h4>{{$errors->first()}}</h4>
  @endif
    @if ($vouchers)
   
    <form method="POST" action="/vouchers/{{$vouchers->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Enter your Email: <br />
        <input type="text" name="email" >
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            Check Your Eligibility 
    </button>
    </form>
    @else
    No Voucher left
    @endif

  </div>

 
