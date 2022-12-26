<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Document</title>
    <style>
          body{
                height: 100%;
                background-color: #07001f;

            }
            .demo{
                width: 50% !important;
                margin: auto !important;
                padding: 2rem 1rem !important;
                background-color: #fff !important;
                border-radius: 10px !important;
                text-align: center !important;
                box-shadow: 8px 8px 8px #faea10 !important;
            }
            h1{
                font-size: 2rem;
                color: #07001f;
                margin-bottom: 1.2rem;
                font-family:Georgia, 'Times New Roman', Times, serif ;
                font-style: italic;
            }
            form input , textarea{
                display: block !important;
                margin: auto !important;
                width: 92% !important;
                outline: none !important;
                border: 1px solid #fff !important;
                padding: 12px 20px !important;
                margin-bottom: 10px !important;
                border-radius: 20px !important;
                background-color: #e4e4e4 !important;
            }

            .button{
                font-size: 1rem;
                margin-top: 1.8rem;
                padding: 10px 0;
                border-radius: 20px;
                outline: none;
                border: none;
                width: 70%;
                background-color: rgb(17, 107, 143);
                color: #fff;
            }
            nav{
            background-color: black !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
           font-style: italic !important;
            border-bottom: 2px solid gold !important;
            margin-bottom: 50px !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark py-3 ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Gouda</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth

                <li class=" nav-item mx-2">
                    <a class="nav-link active" aria-current="page" href="{{ url("/") }}">Back</a>
                </li>

                @endauth
                @guest
                <li class=" nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('register') }}">register</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link active" aria-current="page" href="{{ url('login') }}">login</a>
                </li>
                @endguest
                @auth
                  <li class=" nav-item">
                      <form action=" {{url('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-danger"  type="submit">Logout</button>
                    </form>
                </li>
                @endauth
              </ul>

          </div>
        </div>
      </nav>

        <div class="container-fluid">

    <div class=" demo ">
        <h1>Add Admin</h1>
        <form action="{{ url('addAdmins') }}" method="POST" >
            @csrf
            <label for="title">Name</label>
            <input type="text" name="name" class=" form-control " id="title">
            @error('name')
                <p class=" text-danger"> {{ $message }} </p>
            @enderror
            <label for="title">Email</label>
            <input type="email" name="email" class=" form-control " id="title">
            @error('email')
            <p class=" text-danger"> {{ $message }} </p>
        @enderror

        <label for="title">Password</label>
        <input type="password" name="password" class=" form-control " id="title">
        @error('password')
        <p class=" text-danger"> {{ $message }} </p>
    @enderror
    <label for="title">Role</label>

    <input type="text" name="role" class=" form-control w-25 m-auto">

    {{-- <select name="role" id="" class=" form-control w-25 m-auto">
        @foreach($admin as $x)
        <option value="{{$x->id}}">{{$x->role}}</option>
        @endforeach
    </select> --}}
            <button type="submit" class="button">Add Admin</button>
        </form>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>
