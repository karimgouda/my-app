<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Document</title>
    <style>

        body{
            height: 100%;
            background-color:black;
        }
        h3{
            font-size: 30px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-style: italic;
        }
        p{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-style: italic;
        }
        .show{
            padding: 30px 10px ;
            border-radius: 10px;
            box-shadow: 8px 8px 8px #faea10;
            margin-top: 100px !important;
        }
        nav{
            background-color: black !important;
            border-bottom: 2px solid gold !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
           font-style: italic !important;
        }

        img{
            border-radius:20px;
            height: 500px;
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

                <li class="nav-item mx-3">
                    <form action="{{url("/$user->id")}}" method="post">
                        @csrf
                        @method('DELETE')
                    <button onclick="alert('Are you sure to delete?')" class=" btn btn-danger" type="submit">Delete</button>
                    </form>
                </li>
                <li class=" nav-item mx-2">
                    <a class="nav-link active" aria-current="page" href="{{ url("selectUsers") }}">Back</a>
                </li>
                <li class="nav-item">
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

        <div class="container-fluid">
      @include('categoreis.success')
 <div class=" w-75 m-auto  bg-dark text-white show ">
     <h3 class="text-center">Email : {{$user->email}}</h3>
    <h4 class="text-center"> Role : {{$user->role}}</h4>
    <h4 class="text-center">created_at : {{$user->created_at}}</h4>
    <div class=" w-75 m-auto">
    </div>
 </div>


    <script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>
