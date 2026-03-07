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

<!-- 
    Name: Jhon Rhey B. Ortillano
    Course Code: 4561
    Course Number: IT 9a/L

    Description: 4th Lab Activity - Personal Profile Generator

    Date Created: March 06, 2026
    GitHub: https://github.com/ToolDroidYT
-->

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

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-success text-white text-center py-4">
                        <h2 class="mb-0 fs-3 fw-bold"><i class="bi bi-person-badge me-2"></i>Profile Details</h2>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-subtle rounded-circle" style="width: 100px; height: 100px;">
                                <i class="bi bi-person text-secondary" style="font-size: 3rem;"></i>
                            </div>
                            <h3 class="mt-3 mb-0 fw-bold"><?= $fullname ? $fullname : '<em>Not Provided</em>'; ?></h3>
                            <p class="text-muted mb-0"><?= $course ? $course : '<em>Course not specified</em>'; ?></p>
                        </div>

                        <div class="row g-4 mt-2">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle text-primary rounded p-2">
                                        <i class="bi bi-envelope-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">Email</small>
                                        <span class="fw-medium text-break"><?= $email ? $email : '<em>None</em>'; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-info-subtle text-info rounded p-2">
                                        <i class="bi bi-calendar-event fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">Birthday & Age</small>
                                        <span class="fw-medium text-break"><?= $birthday ? $birthday : '<em>None</em>'; ?> (<?= $age ?? '?' ?> years old)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-warning rounded p-2">
                                        <i class="bi bi-gender-ambiguous fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">Gender</small>
                                        <span class="fw-medium text-capitalize"><?= $gender ? $gender : '<em>None</em>'; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-danger-subtle text-danger rounded p-2">
                                        <i class="bi bi-controller fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block mb-1">Hobbies</small>
                                        <span class="fw-medium text-capitalize"><?= !empty($hobbies) ? (is_array($hobbies) ? implode(', ', $hobbies) : $hobbies) : '<em>None</em>'; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-top">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-success-subtle text-success rounded p-2">
                                    <i class="bi bi-card-text fs-5"></i>
                                </div>
                                <div class="w-100">
                                    <small class="text-muted d-block mb-2">Biography</small>
                                    <div class="p-3 bg-body-tertiary rounded text-body">
                                        <?= $biography ? nl2br($biography) : '<em class="text-muted">No biography provided.</em>'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="javascript:window.close();" class="btn btn-outline-secondary px-4 rounded-pill">Close Tab</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>