<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class ="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class =" navbar-brand" href="index.php">Crm_for_telegram</a>
        <div class=" collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class = "nav-link" href= "index.php?page=users">Users</a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link" href= "index.php?page=register">Register</a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link" href= "index.php?page=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link" href= "index.php?page=logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="container mt-4">
    <?php echo $content; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
