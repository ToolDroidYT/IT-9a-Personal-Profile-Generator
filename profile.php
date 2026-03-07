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
$age_text = '?';
$birthday_in_days = null;
$birthday_formatted = null;

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

function getNearestBirthdayText(DateTime $birthDate, DateTime $today)
{
    $thisYearBirthday = new DateTime($today->format('Y') . '-' . $birthDate->format('m-d'));

    $lastBirthday = clone $thisYearBirthday;
    $nextBirthday = clone $thisYearBirthday;

    if ($thisYearBirthday > $today) {
        $lastBirthday->modify('-1 year');
    } else {
        $nextBirthday->modify('+1 year');
    }

    $daysSinceLast = $today->diff($lastBirthday)->days;
    $daysUntilNext = $today->diff($nextBirthday)->days;

    if ($daysUntilNext <= $daysSinceLast) {
        return "$daysUntilNext days from now";
    } else {
        return "$daysSinceLast days ago";
    }
}

if ($birthday) {
    // Calculate age if birthday is provided
    $birthDate = new DateTime($birthday);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    // Format birthday
    $birthday_formatted = $birthDate->format('F j, Y');

    // Calculate last or next birthday in days based on what is the nearest
    $birthday_in_days = getNearestBirthdayText($birthDate, $today);

    // Format age text
    $interval = $today->diff($birthDate);
    $age_text = $interval->format('%y years %m months and %d days');
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

$temp_dir = './assets/temp/uploads/images/';
$profile_picture_file = verify_and_save_uploaded_file($profile_picture, $temp_dir);
$banner_picture_file = verify_and_save_uploaded_file($banner_picture, $temp_dir);

if ($profile_picture_file) {
    $has_profile_image = true;
}
if ($banner_picture_file) {
    $has_banner_image = true;
}

// Map of hobbies to Bootstrap icons
$hobby_icons = [
    'programming' => 'bi-code-slash',
    'music' => 'bi-music-note-beamed',
    'basketball' => 'bi-dribbble',
    'singing' => 'bi-mic',
    'dancing' => 'bi-person-walking',
    'social media' => 'bi-share',
    'sleeping' => 'bi-moon-stars',
    'gaming' => 'bi-controller',
    'reading' => 'bi-book',
    'traveling' => 'bi-airplane',
    'cooking' => 'bi-egg-fried',
    'photography' => 'bi-camera',
    'drawing' => 'bi-palette',
    'working out' => 'bi-lightning-charge'
];

function generate_random_number($min, $max)
{
    return rand($min, $max);
}

$friends_count = generate_random_number(100, 1000);
$mutual_friends_count = generate_random_number(10, min($friends_count, 100));
$posts_count = generate_random_number(30, 100);
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
                    <input class="form-control rounded-pill d-lg-block d-none bg-body-tertiary border-0" type="search"
                        placeholder="      Search" aria-label="Search">
                    <i class="bi bi-search position-absolute  d-lg-block d-none"
                        style="left: 0.8rem; top: 50%; transform: translateY(-50%); font-size: 14px;"></i>
                    <i class="bi bi-search d-lg-none d-block bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle"
                        style="width: 2.5rem; height: 2.5rem; font-size: 14px;"></i>
                </form>
            </div>

            <!-- 2 -->
            <div class="d-flex align-items-center justify-content-center flex-fill d-none d-sm-block">
                <nav>
                    <ul class="navbar-nav flex-row gap-5 align-items-center justify-content-center">
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
                            <i
                                class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle bi bi-grid-3x3-gap-fill"></i>
                        </li>
                        <li class="nav-item ratio ratio-1x1" style="width: 2.5rem; height: 2.5rem;">
                            <i
                                class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle bi bi-chat-dots-fill"></i>
                        </li>
                        <li class="nav-item ratio ratio-1x1" style="width: 2.5rem; height: 2.5rem;">
                            <i
                                class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle bi bi-bell-fill"></i>
                        </li>
                        <li class="nav-item ratio ratio-1x1 position-relative d-flex"
                            style="width: 2.5rem; height: 2.5rem;">
                            <img class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle"
                                src="<?= $has_profile_image ? $profile_picture_file : 'https://picsum.photos/800/400' ?>"
                                alt="Profile picture">
                            <!-- The arrow down icon thingy -->
                            <i class="bi bi-chevron-down rounded-circle d-flex justify-content-center align-items-center position-absolute align-self-end bg-body-secondary text-light"
                                style="width: 0.8rem; height: 0.8rem; bottom: 0; right: 0; font-size: 8px; justify-self: end;"></i>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>

    <section class="container" id="profile">
        <!-- Banner -->
        <header class="d-flex w-100 justify-content-center position-relative">
            <img class="h-auto object-fit-cover rounded-3"
                style="width: 85%; aspect-ratio: 2.5/1; border-top-left-radius: 0 !important; border-top-right-radius: 0 !important; <?= $has_banner_image ? '' : 'filter: blur(5px) grayscale(75%);' ?>"
                src="<?= $has_banner_image ? $banner_picture_file : 'https://picsum.photos/800/400' ?>"
                alt="Banner image">
            <?php if (!$has_banner_image): ?>
                <div class="position-absolute top-0 d-flex justify-content-start align-items-end w-100 h-100 rounded-3 d-none d-md-flex"
                    style="left: 9%">
                    <p class="bg-info-subtle text-info py-1 px-2 rounded-2 opacity-25">No banner provided</p>
                </div>
            <?php endif; ?>
        </header>

        <!-- Profile Info -->
        <div class="d-flex flex-column align-items-center text-center mt-3">
            <!-- PFP -->
            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-subtle rounded-circle"
                style="width: 168px; height: 168px; margin-top: -100px; border: 4px solid var(--bs-body); z-index: 1;">
                <img src="<?= $has_profile_image ? $profile_picture_file : 'https://picsum.photos/800/400' ?>"
                    alt="Profile picture" class="img w-100 rounded-circle h-100">
            </div>
            <!-- Name -->
            <h1 class="mt-3 mb-0 fw-bold"><?= $fullname ? $fullname : '<em>Not Provided</em>'; ?></h1>
            <!-- Course -->
            <p class="text-muted mb-0"><?= $course ? $course : '<em>Course not specified</em>'; ?></p>
            <!-- Friends, Mutuals, and Posts -->
            <p class="text-muted mb-0">
                <?= $friends_count ?> friends
                <?php if ($mutual_friends_count > 0): ?>
                    &middot; <?= $mutual_friends_count ?> mutual friends
                <?php endif; ?>
                &middot; <?= $posts_count ?> posts
            </p>

            <?php if ($biography): ?>
                <div class="container d-flex flex-wrap justify-content-center mt-2">
                    <p class="text-muted py-2 px-3 bg-body-tertiary bg-opacity-75 rounded-3 mt-2 overflow-auto"
                        style="max-height: 100px; max-width: 600px; scrollbar-width: thin;">
                        <?= $biography ? $biography : '<em>No biography provided</em>'; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Horizontal divider thingy -->
        <div class="container px-4">
            <hr>
        </div>
    </section>

    <section class="w-100 d-flex justify-content-center mb-5" id="content">
        <div class="container row justify-content-center px-5">
            <div class="col-lg-6 col-md-8 card border-0 shadow-sm rounded-4 bg-body-tertiary p-4">
                <h3 class="fs-5 fw-bold mb-3">Personal Details</h3>

                <!-- Birthday -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="nav-item ratio ratio-1x1 bg-secondary-subtle text-secondary rounded p-2"
                        style="width: 2.5rem; height: 2.5rem;">
                        <i class="fs-5 d-flex justify-content-center align-items-center rounded-circle bi bi-cake"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Birthday</small>
                        <span class="fw-medium text-break">
                            <?= ($birthday_formatted ? $birthday_formatted : '<em>None</em>') ?>
                            <small class="text-muted">(<?= $birthday_in_days ?>)</small>
                        </span>
                    </div>
                </div>

                <!-- Age -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="nav-item ratio ratio-1x1 bg-secondary-subtle text-secondary rounded p-2"
                        style="width: 2.5rem; height: 2.5rem;">
                        <i
                            class="fs-5 d-flex justify-content-center align-items-center rounded-circle bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Age</small>
                        <span class="fw-medium text-break"><?= $age_text ?></span>
                    </div>
                </div>

                <!-- Gender -->
                <?php
                $gender_icon = null;
                if ($gender) {
                    switch (strtolower($gender)) {
                        case 'male':
                            $gender_icon = 'bi bi-gender-male';
                            break;
                        case 'female':
                            $gender_icon = 'bi bi-gender-female';
                            break;
                        default:
                            $gender_icon = 'bi bi-gender-ambiguous';
                    }
                }
                ?>
                <?php if (strtolower($gender) !== 'pnts'): ?>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="nav-item ratio ratio-1x1 bg-secondary-subtle text-secondary rounded p-2"
                            style="width: 2.5rem; height: 2.5rem;">
                            <i
                                class="fs-5 d-flex justify-content-center align-items-center rounded-circle <?= $gender_icon ?: 'bi bi-gender-ambiguous' ?>"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Gender</small>
                            <span class="fw-medium text-break"><?= $gender ? ucwords($gender) : 'Unknown'; ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Email -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="nav-item ratio ratio-1x1 bg-secondary-subtle text-secondary rounded p-2"
                        style="width: 2.5rem; height: 2.5rem;">
                        <i
                            class="fs-5 d-flex justify-content-center align-items-center rounded-circle bi bi-envelope"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Email</small>
                        <span class="fw-medium text-break"><?= $email ? $email : '<em>None</em>'; ?></span>
                    </div>
                </div>

                <h3 class="fs-5 fw-bold my-3">Hobbies</h3>

                <!-- Hobbies -->
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="nav-item ratio ratio-1x1 bg-secondary-subtle text-secondary rounded p-2 flex-shrink-0"
                        style="width: 2.5rem; height: 2.5rem;">
                        <i
                            class="fs-5 d-flex justify-content-center align-items-center rounded-circle bi bi-dice-3"></i>
                    </div>
                    <div class="d-flex flex-row flex-wrap gap-2">
                        <?php for ($i = 0; $i < count($hobbies); $i++): ?>
                            <span
                                class="badge bg-secondary-subtle text-secondary border border-secondary border-opacity-25">
                                <i class="<?= $hobby_icons[$hobbies[$i]] ?? 'bi bi-emoji-wink' ?>"></i>
                                <?= ucwords($hobbies[$i]) ?>
                            </span>
                        <?php endfor; ?>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-md-8">
                <!-- What's on your mind thingy -->
                <div
                    class="col-lg-6 col-md-8 card border-0 shadow-sm rounded-4 bg-body-tertiary p-3 d-flex flex-column w-100">
                    <div class="d-flex flex-row">
                        <img class="bg-body-tertiary fs-6 d-flex justify-content-center align-items-center rounded-circle"
                            src="<?= $has_profile_image ? $profile_picture_file : 'https://picsum.photos/800/400' ?>"
                            style="width: 3rem; height: 3rem;" alt="Profile picture">
                        <input type="text" class="form-control rounded-pill bg-body-secondary border-0 ms-2"
                            placeholder="What's on your mind?">
                    </div>
                    <hr style="opacity: 0.15;">
                    <div class="d-flex flex-row">
                        <button
                            class="btn btn-sm rounded-3 flex-fill d-flex align-items-center justify-content-center gap-1">
                            <i class="bi bi-camera-video fs-5 text-danger"></i>
                            Live Video
                        </button>
                        <button
                            class="btn btn-sm rounded-3 flex-fill d-flex align-items-center justify-content-center gap-1">
                            <i class="bi bi-images fs-5 text-success"></i>
                            Photo/Video
                        </button>
                        <button
                            class="btn btn-sm rounded-3 flex-fill d-flex align-items-center justify-content-center gap-1">
                            <i class="bi bi-flag fs-5 text-info"></i>
                            Life update
                        </button>
                    </div>
                </div>

                <h3 class="fs-5 fw-bold my-3 ms-2">Posts</h3>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>