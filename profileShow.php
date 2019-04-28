<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script src="test.js"></script>
    <script src="json2html.js"></script>
    <script src="jquery.json2html.js"></script>

    <script>
        var t = {'<>':'div','html':'${title} ${year}'};

        var d = [
            {"title":"Heat","year":"1995"},
            {"title":"Snatch","year":"2000"},
            {"title":"Up","year":"2009"},
            {"title":"Unforgiven","year":"1992"},
            {"title":"Amadeus","year":"1984"}
        ];



        document.write( json2html.transform(d,t) );
    </script>

</head>
<body>

</body>
</html>
<?php
echo "hvyu0";
