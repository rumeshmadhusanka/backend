<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page</title>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="json2table.js">

    </script>

</head>
<body>
<div>
    <table id="dataTable">
        <tr>
            <td>Attr</td>
            <td>Val</td>
        </tr>
        <tr>
            <td>Name</td>
            <td id="name">Val</td>
        </tr>
        <tr>
            <td>Tele</td>
            <td id="tele">Val</td>
        </tr>
        <tr>
            <td>Email</td>
            <td id="email">Val</td>
        </tr>
        <tr>
            <td>Profile Pic</td>
            <td><img src="" id="pic" alt="profile pic"></td>
        </tr>
    </table>
    <input type="button" onclick="doSth()">
</div>
</body>
</html>
