<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library project</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <h2>Books</h2>
        
        <div class="books">
            @include('sections.books')
        </div>

       
    </div>

    <script type="text/javascript">
        $(function () {

            $('.pagination a').click(function(event){
                event.preventDefault();
                var link = $(this).attr('href');
                getBooks(link);
            })
        
            function getBooks(link) {
                $.ajax({
                    link:link
                }).done(function (data) {
                    $('.books').html(data);
                }).fail(function () {
                    console.log("failed");
                });
            }
        });
    </script>
</body>
</html>