
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0;">
</head>
<body>
<script>
    var randomString = Math.random().toString(36).substring(7);
    setInterval(function() {
        randomString = Math.random().toString(36).substring(7);
    }, 1000);
    document.write('<p1 class="uploadedby" style="color: white;">Uploaded by: ' + randomString + '</p1>')
</script>
</body>
</html>

