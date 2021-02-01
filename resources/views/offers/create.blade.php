<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Add Your Offers
                </div>

                {{--@if($name == 'alaa ebrahim')
                    <p>Yes i am alaa ebrahim</p>
                @else
                    <p>Not i am alaa ebrahim</p>
                @endif
                @foreach($data as $_data)
                    <p>{{$_data}}</p>
                @endforeach--}}
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="post" action="{{route('offers.store')}}">
                    @csrf
                 {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                <label for="floatingInput">Offer Name</label>
                <div class="form-floating mb-3">

                    <input type="text" class="form-control" name="name" placeholder="Offer name">
                    @error('name')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>

                    <label for="floatingPassword">Offer Price</label>
                <div class="form-floating">
                    <input type="text" class="form-control" name="price" placeholder="Offer price">
                    @error('price')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>
                    <br>
                    <label for="floatingPassword">Offer Details</label>
                <div class="form-floating">
                    <input type="text" class="form-control" name="details" placeholder="Offer details">
                    @error('details')
                    <span class="form-text text-danger">{{$message}}</span>
                    @enderror
                </div>
                    <br>
                <button type="submit" class="btn btn-primary">Save Offer</button>
                </form>

            </div>
        </div>
    </body>
</html>
