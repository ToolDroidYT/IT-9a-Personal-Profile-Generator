<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <!-- <form  class="form">
        <input type="text" name="fullname">
        <input type="number" name="age">
        <input type="email" name="email">
        <input type="submit" value="Submit">
    </form> -->

    <div class="card">
        <form action="./profile.php" method="POST">
            <div class="form-group">
                <label for="fullNameField">Full Name</label>
                <input name="email" type="email" class="form-control" id="fullNameField" placeholder="Enter full name">
            </div>
            <div class="form-group">
                <label for="ageField">Birthday</label>
                <input name="birthday" type="date" class="form-control" id="ageField" placeholder="Enter birthday">
            </div>
            <div class="form-group">
                <label for="courseField">Course</label>
                <input name="course" type="email" class="form-control" id="courseField" placeholder="Enter course">
            </div>
            <div class="form-group">
                <label for="emailField">Email address</label>
                <input name="email" type="email" class="form-control" id="emailField" placeholder="Enter email">
            </div>

            <!--  -->

            <label>Gender</label>
            <div class="form-check">
                <label class="form-check-label" for="genderFieldMale">
                    Male
                </label>
                <input class="form-check-input" type="radio" name="gender" id="genderFieldMale">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="genderFieldFemale">
                    Female
                </label>
                <input class="form-check-input" type="radio" name="gender" id="genderFieldFemale">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="genderFieldPNTS">
                    Prefer not to say
                </label>
                <input class="form-check-input" type="radio" name="gender" id="genderFieldPNTS">
            </div>
            <!--  -->
            
            <label>Gender</label>
            <div class="form-check">
                <input class="form-check-input mt-0" type="checkbox" value="">
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>