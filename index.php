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
    <title>Edit Profile</title>

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

<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0 fs-3 fw-bold"><i class="bi bi-person-lines-fill me-2"></i>Profile Generator</h2>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form action="./profile.php" method="POST" target="_blank" enctype="multipart/form-data">

                            <h5 class="mb-3 text-secondary border-bottom pb-2">Personal Information</h5>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating text-body">
                                        <input name="fullname" type="text" class="form-control" id="fullNameField"
                                            placeholder="Enter full name" required>
                                        <label for="fullNameField">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-body">
                                        <input name="birthday" type="date" class="form-control" id="ageField"
                                            placeholder="Enter birthday" required>
                                        <label for="ageField">Birthday</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating text-body">
                                        <input name="course" type="text" class="form-control" id="courseField"
                                            placeholder="Enter course" required>
                                        <label for="courseField">Course</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating text-body">
                                        <input name="email" type="email" class="form-control" id="emailField"
                                            placeholder="Enter email" required>
                                        <label for="emailField">Email address</label>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3 text-secondary border-bottom pb-2">Additional Details</h5>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Gender</label>
                                    <div class="p-3 border rounded text-body bg-body-tertiary">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="genderFieldMale" value="male" required>
                                            <label class="form-check-label" for="genderFieldMale">Male</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="genderFieldFemale" value="female">
                                            <label class="form-check-label" for="genderFieldFemale">Female</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                id="genderFieldPNTS" value="pnts">
                                            <label class="form-check-label" for="genderFieldPNTS">Prefer not to
                                                say</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Hobbies</label>
                                    <div class="p-3 border rounded text-body bg-body-tertiary d-flex flex-wrap gap-2">
                                        <div class="form-check">
                                            <input id="programmingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="programming">
                                            <label for="programmingHobby"
                                                class="form-check-label px-1">Programming</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="musicHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="music">
                                            <label for="musicHobby" class="form-check-label px-1">Listening to
                                                music</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="basketballHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="basketball">
                                            <label for="basketballHobby"
                                                class="form-check-label px-1">Basketball</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="singingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="singing">
                                            <label for="singingHobby" class="form-check-label px-1">Singing</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="dancingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="dancing">
                                            <label for="dancingHobby" class="form-check-label px-1">Dancing</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="socialmediaHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="social media">
                                            <label for="socialmediaHobby" class="form-check-label px-1">Social
                                                media</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="sleepHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="sleeping">
                                            <label for="sleepHobby" class="form-check-label px-1">Sleeping</label>
                                        </div>

                                        <div class="form-check">
                                            <input id="gamingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="gaming">
                                            <label for="gamingHobby" class="form-check-label px-1">Gaming</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="readingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="reading">
                                            <label for="readingHobby" class="form-check-label px-1">Reading</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="travelingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="traveling">
                                            <label for="travelingHobby" class="form-check-label px-1">Traveling</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="cookingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="cooking">
                                            <label for="cookingHobby" class="form-check-label px-1">Cooking</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="drawingHobby" class="form-check-input" type="checkbox"
                                                name="hobbies[]" value="drawing">
                                            <label for="drawingHobby" class="form-check-label px-1">Drawing/Art</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="biographyField" class="form-label fw-semibold">Biography</label>
                                <textarea class="form-control" style="height: 120px;"
                                    placeholder="Write a short biography about yourself..." id="biographyField"
                                    name="biography"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="formPFP" class="form-label fw-semibold">Profile Picture</label>
                                <input class="form-control" type="file" accept="image/*" id="formPFP"
                                    name="profilepicture" required>
                            </div>

                            <div class="mb-4">
                                <label for="formPFP" class="form-label fw-semibold">Banner Picture
                                    <sub>(Optional)</sub></label>
                                <input class="form-control" type="file" accept="image/*" id="formPFP"
                                    name="bannerpicture">
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end w-100 gap-3">
                                <button type="reset" onclick="clearSavedData()"
                                    class="btn btn-outline-danger px-4 py-2 fw-medium"><i
                                        class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-medium shadow-sm"><i
                                        class="bi bi-check2-circle me-1"></i>Generate Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        // Auto save form data, for development purposes
        // So it doesn't get lost when refreshing the page

        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const formFields = form.querySelectorAll('input, textarea');
            formFields.forEach(field => {
                field.addEventListener('input', () => {
                    if (field.type === 'checkbox') {
                        const checkboxes = form.querySelectorAll(`input[name="${field.name}"]`);
                        const checkedValues = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
                        localStorage.setItem(field.name, JSON.stringify(checkedValues));
                    } else if (field.type === 'radio') {
                        if (field.checked) {
                            localStorage.setItem(field.name, field.value);
                        }

                    } else {
                        localStorage.setItem(field.name, field.value);
                    }
                });

                // Load saved data on page load
                const savedValue = localStorage.getItem(field.name);
                if (savedValue) {
                    if (field.type === 'checkbox') {
                        const values = JSON.parse(savedValue);
                        if (values.includes(field.value)) {
                            field.checked = true;
                        }
                    } else if (field.type === 'radio') {
                        if (field.value === savedValue) {
                            field.checked = true;
                        }
                    } else {
                        field.value = savedValue;
                    }
                }
            });


        });

        // Clear saved data from localStorage when resetting the form
        function clearSavedData() {
            const form = document.querySelector('form');
            const formFields = form.querySelectorAll('input, textarea');

            form.reset();
            formFields.forEach(field => {
                localStorage.removeItem(field.name);
            });
        }
    </script>
</body>

</html>