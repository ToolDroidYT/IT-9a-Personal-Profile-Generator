<?php
$fullname
    = $birthday
    = $course
    = $email
    = $gender
    = $biography
    = "";

$profile_picture
    = $profile_picture_file
    = $banner_picture
    = $banner_picture_file
    = null;

$hobbies = [];
$age = null;

$has_profile_image
    = $has_banner_image
    = false;

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

function get_file_meta($meta_key)
{
    if (isset($_FILES[$meta_key])) {
        $value = $_FILES[$meta_key];
        return $value;
    }
    return null;
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') == 'POST') {
    $fullname = get_post_meta('fullname');
    $birthday = get_post_meta('birthday');
    $course = get_post_meta('course');
    $email = get_post_meta('email');
    $gender = get_post_meta('gender');
    $hobbies = get_post_meta('hobbies') ?? [];
    $biography = get_post_meta('biography');

    $profile_picture = get_file_meta('profilepicture');
    $banner_picture = get_file_meta('bannerpicture');
}

// Calculate age if birthday is provided
if ($birthday) {
    $birthDate = new DateTime($birthday);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
}

function verify_and_save_uploaded_file($file, $upload_dir)
{
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    if (!is_writable($upload_dir)) {
        return false;
    }

    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $filename = basename($file['name']);
        $image_file_md5_hash = hash_file('md5', $file['tmp_name']);
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        $target_file = $upload_dir . $image_file_md5_hash . '.' . $file_extension;

        // Check if file is a valid image
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowed_types)) {
            return false; // Invalid file type, do not use the uploaded file
        }

        // Check if file size is invalid or larger than 10MB
        $current_file_size = $file['size'];
        $max_file_size = 10 * 1024 * 1024; // 10MB in bytes
        if ($current_file_size <= 0 || $current_file_size > $max_file_size) {
            return false; // Invalid file size, do not use the uploaded file
        }

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $target_file; // Return the path to the saved file
        }
    }
    return false;
}

$temp_dir = './assets/temp/images/';
$profile_picture_file = verify_and_save_uploaded_file($profile_picture, $temp_dir);
$banner_picture_file = verify_and_save_uploaded_file($banner_picture, $temp_dir);

if ($profile_picture_file) {
    $has_profile_image = true;
}
if ($banner_picture_file) {
    $has_banner_image = true;
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
    <title>Pisbok - <?= $fullname ?? 'Profile' ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar bg-body shadow-sm border-bottom border-opacity-25 sticky-top">
        <div class="flex-row flex-nowrap d-flex w-100 align-items-center">
            <!-- 1 -->
            <div class="d-flex align-items-center justify-content-center flex-fill ms-4">
                <a href="#" class="navbar-brand fw-bold">Pisbok</a>
                <!-- Search -->
                <form class="form-inline position-relative">
                    <input class="form-control rounded-pill d-lg-block d-none bg-body-tertiary border-0" type="search" placeholder="      Search" aria-label="Search">
                    <i class="bi bi-search position-absolute  d-lg-block d-none" style="left: 0.8rem; top: 50%; transform: translateY(-50%); font-size: 14px;"></i>
                    <i class="bi bi-search d-lg-none d-block bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle" style="width: 2.5rem; height: 2.5rem; font-size: 14px;"></i>
                </form>
            </div>

            <!-- 2 -->
            <div class="d-flex align-items-center justify-content-center flex-fill d-none d-sm-block">
                <nav class="">
                    <ul class="navbar-nav flex-row gap-5 align-items-center justify-content-center ">
                        <li class="nav-item d-flex justify-content-center align-items-center fs-5">
                            <i class="bi bi-house-door"></i>
                        </li>
                        <li class="nav-item d-flex justify-content-center align-items-center fs-5">
                            <i class="bi bi-collection-play"></i>
                        </li>
                        <li class="nav-item d-flex justify-content-center align-items-center fs-5">
                            <i class="bi bi-shop-window"></i>
                        </li>
                        <li class="nav-item d-flex justify-content-center align-items-center fs-5">
                            <i class="bi bi-people"></i>
                        </li>
                        <li class="nav-item d-flex justify-content-center align-items-center fs-5">
                            <i class="bi bi-controller"></i>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- 3 -->
            <div class="flex-column align-items-end flex-fill justify-content-end">
                <nav>
                    <ul class="navbar-nav flex-row gap-2 align-items-end justify-content-end me-4">
                        <li class="nav-item ratio ratio-1x1" style="width: 2.5rem; height: 2.5rem;">
                            <i class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle bi bi-grid-3x3-gap-fill"></i>
                        </li>
                        <li class="nav-item ratio ratio-1x1" style="width: 2.5rem; height: 2.5rem;">
                            <i class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle bi bi-chat-dots-fill"></i>
                        </li>
                        <li class="nav-item ratio ratio-1x1" style="width: 2.5rem; height: 2.5rem;">
                            <i class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle bi bi-bell-fill"></i>
                        </li>
                        <li class="nav-item ratio ratio-1x1 position-relative d-flex" style="width: 2.5rem; height: 2.5rem;">
                            <img class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle" src="<?= $has_profile_image ? $profile_picture_file : 'https://picsum.photos/800/400' ?>" alt="Profile picture">
                            <!-- The arrow down icon thingy -->
                            <i class="bi bi-chevron-down rounded-circle d-flex justify-content-center align-items-center position-absolute align-self-end bg-body-secondary text-light" style="width: 0.8rem; height: 0.8rem; bottom: 0; right: 0; font-size: 8px; justify-self: end;"></i>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Banner -->
        <header class="d-flex w-100 justify-content-center position-relative">
            <img class="h-auto object-fit-cover rounded-3" style="width: 85%; aspect-ratio: 2.5/1; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important; <?= $has_banner_image ? '' : 'filter: blur(5px) grayscale(75%);' ?>" src="<?= $has_banner_image ? $banner_picture_file : 'https://picsum.photos/800/400' ?>" alt="Banner image">
            <?php if (!$has_banner_image): ?>
                <div class="position-absolute top-0 d-flex justify-content-start align-items-end w-100 h-100 rounded-3 d-none d-md-flex" style="left: 9%">
                    <p class="bg-info-subtle text-info py-1 px-2 rounded-2 opacity-25">No banner provided</p>
                </div>
            <?php endif; ?>
        </header>

        <!-- Profile Info -->
        <div class="d-flex flex-column align-items-center text-center mt-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-subtle rounded-circle" style="width: 168px; height: 168px; margin-top: -100px; border: 4px solid var(--bs-body); z-index: 1;">
                <img src="<?= $has_profile_image ? $profile_picture_file : 'https://picsum.photos/800/400' ?>" alt="Profile picture" class="img w-100 rounded-circle h-100">
            </div>
            <h1 class="mt-3 mb-0 fw-bold"><?= $fullname ? $fullname : '<em>Not Provided</em>'; ?></h1>
            <p class="text-muted mb-0"><?= $course ? $course : '<em>Course not specified</em>'; ?></p>

            <?php if ($biography): ?>
                <div class="container d-flex flex-wrap justify-content-center mt-2">
                    <p class="text-muted py-2 px-3 bg-body-tertiary bg-opacity-75 rounded-3 mt-2 overflow-auto" style="max-height: 100px; max-width: 600px; scrollbar-width: thin;">
                        <?= $biography ? $biography : '<em>No biography provided</em>'; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Biography -->
        <!-- <div class="container mt-4 pt-4 border-top">
            <div class="d-flex align-items-start gap-3">
                <div class="bg-success-subtle text-success rounded p-2">
                    <i class="bi bi-card-text fs-5"></i>
                </div>
                <div>
                    <h3 class="fw-bold">Biography</h3>
                    <p class="text-muted"><?= $biography ? $biography : '<em>No biography provided</em>'; ?></p>
                </div>
            </div>
        </div> -->
    </div>


    <!--  <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0 fs-3 fw-bold"><i class="bi bi-person-badge me-2"></i>Profile Details</h2>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-subtle rounded-circle"
                                style="width: 100px; height: 100px;">
                                <img src="<?= $profile_picture_file ?>" alt="Profile picture"
                                 class="img w-100 rounded-circle h-100">
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
                                        <span
                                            class="fw-medium text-break"><?= $email ? $email : '<em>None</em>'; ?></span>
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
                                        <span
                                            class="fw-medium text-break"><?= $birthday ? $birthday : '<em>None</em>'; ?>
                                            (<?= $age ?? '?' ?> years old)</span>
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
                                        <span
                                            class="fw-medium text-capitalize"><?= $gender ? $gender : '<em>None</em>'; ?></span>
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
                                        <span
                                            class="fw-medium text-capitalize"><?= !empty($hobbies) ? (is_array($hobbies) ? implode(', ', $hobbies) : $hobbies) : '<em>None</em>'; ?></span>
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
                    <a href="javascript:window.close();" class="btn btn-outline-secondary px-4 rounded-pill">Close
                        Tab</a>
                </div>
            </div>
        </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>