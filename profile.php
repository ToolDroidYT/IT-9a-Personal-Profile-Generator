<?php
$fullname = $birthday = $course = $email = $gender = $biography = "";
$hobbies = [];
$age = null;

function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function get_post_meta($meta_key)
{
    if (isset($_POST[$meta_key])) {
        $value = $_POST[$meta_key];
        return is_array($value) ? array_map('sanitize_input', $value) : sanitize_input($value);
    }
    return null;
}

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == "POST") {
    $fullname = get_post_meta('fullname');
    $birthday = get_post_meta('birthday');
    $course = get_post_meta('course');
    $email = get_post_meta('email');
    $gender = get_post_meta('gender');
    $hobbies = get_post_meta('hobbies') ?? [];
    $biography = get_post_meta('biography');
}

if ($birthday) {
    $birthDate = new DateTime($birthday);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile View</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
</head>

<body>

    <div class="card container mt-4 mb-4 p-4">
        <h2>Profile View</h2>
        <p><strong>Full Name:</strong> <?= $fullname; ?></p>
        <p><strong>Birthday:</strong> <?= $birthday; ?></p>
        <p><strong>Age:</strong> <?= $age ?></p>
        <p><strong>Course:</strong> <?= $course; ?></p>
        <p><strong>Email:</strong> <?= $email; ?></p>
        <p><strong>Gender:</strong> <?= $gender; ?></p>
        <p><strong>Hobbies:</strong> <?= is_array($hobbies) ? implode(', ', $hobbies) : $hobbies; ?></p>
        <p><strong>Biography:</strong> <?= $biography; ?></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>