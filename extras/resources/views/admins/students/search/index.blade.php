nect everything, we can just modify that view to include what we have built above. Your final view should look like this:

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel and Typeahead Tutorial</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1>Laravel and Typeahead Tutorial</h1>
    <hr>
    <form class="typeahead" role="search">
      <div class="form-group">
        <input type="search" name="q" class="form-control search-input" placeholder="Search" autocomplete="off">
      </div>
    </form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins  and Typeahead) -->
    
  </body>
</html
