<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<style>
            body{
            height: 100%;
            animation:changBackgroun 12s infinite alternate;

        }
        h1{
            font-size: 30px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-style: italic;
        }
        h4{
          font-family:monospace;
          font-style: italic;
        }
        p{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-style: italic;
        }
        .all{
            padding: 30px 10px ;
            border-radius: 10px;
            box-shadow: 8px 8px 8px #faea10;
            margin-top: 100px !important;
        }
        nav{
            background-color: black !important;
            animation:changBackgroun 12s infinite alternate !important;
           font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
           font-style: italic !important;
        }
        @keyframes changBackgroun{
            0%{
                background-color: black;
            }
            50%{
              background-color: black;

            }
            100%{
              background-color:darkblue ;
            }
        }
        a{
          color: white;
          text-decoration: none;
          transition: 1s;
        }
        a:hover{
          color: gold;
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
                @if($user->role=="admin")
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="{{ url('/create') }}">Add new post</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="{{ url('addAdmin') }}">Add new Admin</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="{{ url('selectUsers') }}">All Users</a>
                </li>
                @endif
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="{{ url('/books') }}">Books</a>
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
      @include('categoreis.success')
    <div class=" w-50 m-auto  all text-white mt-5">
        <h1 class="text-center text-white -50 mb-3">All Categoreis</h1>
        @foreach ($categoreis as $category )


    <h4 class=" text-center bg-primary my-2">{{$loop->iteration}} - <a href=" {{url("/show/$category->id")}} "> {{ $category->title }}</a></h4>
    @endforeach
    </div>

    <div class=" w-25 m-auto mt-5">
      <div class=" w-25 m-auto">{{$categoreis->links()}}</div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>
