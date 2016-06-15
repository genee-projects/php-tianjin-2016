<html>
    <head>
        <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="//cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Logo</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="form.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input name="first" type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input name="last" type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input name="user" type="text" class="form-control" id="exampleInputEmail1" placeholder="User Name">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="check" type="checkbox"> Check me out
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-danger">Click</button>
                    </form>
                </div>
            </div>
        </div>
        <div id = "result">
            
        </div>
        <script>
        $().ready(function() {
            $('form').on('click', '.btn-danger', function (e) {
                $.get('get.php', {val: 10}, function (data) {
                    $('#result').html(data)
                })
            })
        })
        </script>
    </body>
<html>
<?php
echo '<pre>' . print_r($_POST, true) . '</pre>';

$array = [
    [
        'name' => 'a',
        'value' => 'b',
    ], 
    [
        'name' => 'a',
        'value' => 'b',
    ], 
    [
        'name' => 'a',
        'value' => 'b',
    ], 
    [
        'name' => 'a',
        'value' => 'b',
    ],
];

$data = json_encode($array);
file_put_contents('./data.json', $data);
