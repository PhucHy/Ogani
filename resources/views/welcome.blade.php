<!DOCTYPE html>
<html>
    <head>
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Live Search</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Products info </h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-controller" id="search" name="search"></input>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                @if ($products)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{$product->products_id}}</td>
                                            <td>{{$product->products_name}}</td>
                                            <td>{{$product->products_description}}</td>
                                            <td>{{$product->products_price}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <script type="text/javascript">
            $("#search").on("keyup",function(){
                $value = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ URL::to("search") }}",
                    data: {
                        "search": $value
                    },
                    success:function(data){
                        $("tbody").html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
    </body>
</html>