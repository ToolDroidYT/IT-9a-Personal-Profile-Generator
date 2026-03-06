<?php

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/theme.css">
</head>

<body>
    <div class="card container mt-4 mb-4 p-4">
        <form action="./profile.php" method="POST" target="_blank" enctype="multipart/form-data">
            <h2>Profile Generator</h2>

            <div class="form-group mb-2">
                <label for="fullNameField">Full Name</label>
                <input name="fullname" type="text" class="form-control" id="fullNameField"
                    placeholder="Enter full name">
            </div>
            <div class="form-group mb-2">
                <label for="ageField">Birthday</label>
                <input name="birthday" type="date" class="form-control" id="ageField" placeholder="Enter birthday">
            </div>
            <div class="form-group mb-2">
                <label for="courseField">Course</label>
                <input name="course" type="text" class="form-control" id="courseField" placeholder="Enter course">
            </div>
            <div class="form-group mb-2">
                <label for="emailField">Email address</label>
                <input name="email" type="email" class="form-control" id="emailField" placeholder="Enter email">
            </div>

            <!--  -->

            <label class="mt-2">Gender</label>
            <div class="form-check">
                <label class="form-check-label" for="genderFieldMale">
                    Male
                </label>
                <input class="form-check-input" type="radio" name="gender" id="genderFieldMale" value="male">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="genderFieldFemale">
                    Female
                </label>
                <input class="form-check-input" type="radio" name="gender" id="genderFieldFemale" value="female">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="genderFieldPNTS">
                    Prefer not to say
                </label>
                <input class="form-check-input" type="radio" name="gender" id="genderFieldPNTS" value="pnts">
            </div>
            <!--  -->

            <label class="mt-2">Hobbies</label>
            <div class="form-check">
                <input id="programmingHobby" class="form-check-input" type="checkbox" name="hobbies[]"
                    value="programming">
                <label for="programmingHobby" class="form-check-label">Programming</label>
            </div>
            <div class="form-check">
                <input id="musicHobby" class="form-check-input" type="checkbox" name="hobbies[]" value="music">
                <label for="musicHobby" class="form-check-label">Listening to music</label>
            </div>
            <div class="form-check">
                <input id="basketballHobby" class="form-check-input" type="checkbox" name="hobbies[]" value="basketball">
                <label for="basketballHobby" class="form-check-label">Basketball</label>
            </div>
            <div class="form-check">
                <input id="singingHobby" class="form-check-input" type="checkbox" name="hobbies[]" value="singing">
                <label for="singingHobby" class="form-check-label">Singing</label>
            </div>
            <div class="form-check">
                <input id="dancingHobby" class="form-check-input" type="checkbox" name="hobbies[]" value="dancing">
                <label for="dancingHobby" class="form-check-label">Dancing</label>
            </div>
            <div class="form-check">
                <input id="socialmediaHobby" class="form-check-input" type="checkbox" name="hobbies[]"
                    value="socialmedia">
                <label for="socialmediaHobby" class="form-check-label">Social media</label>
            </div>
            <div class="form-check">
                <input id="sleepHobby" class="form-check-input" type="checkbox" name="hobbies[]" value="sleeping">
                <label for="sleepHobby" class="form-check-label">Sleeping</label>
            </div>

            <!--  -->

            <label class="mt-2">Biography</label>
            <div class="form-floating">
                <textarea class="form-control" style="height: 100px;" placeholder="Write a short biography"
                    id="biographyField" name="biography"></textarea>
            </div>

            <div class="mt-2">
                <label for="formPFP" class="form-label">Select a profile picture</label>
                <input class="form-control" type="file" id="formPFP">
            </div>

            <!--  -->

            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>