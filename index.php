<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function pop_up()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {



        $students = [
            "Name" => $_POST['name'],
            "Course" => $_POST['course'],
            "Age" => $_POST['age'],
            "Married" => $_POST['status']
        ];

        $output = '';
        foreach ($students as $key => $value) {
            $output .= htmlspecialchars($key) . ' : ' . htmlspecialchars($value) . "<br>";
        }
        echo "<h3>$output</h3>";
        exit;
    } else {

        echo "Error: Missing form data.";
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    pop_up();
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup with Form Submission</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        body {
            background: rgba(0, 0, 0, 0.6)url('bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-blend-mode: darken;
        }

        .form_container {
            width: 40%;
            background: rgba(0, 0, 0, 0.6)  ;
            padding: 30px 50px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            margin: 10% auto;
            border-radius: 10px;
            position: relative;
        }

        .fly {
            position: absolute;
            top: 0;
            left: 200px;
            background: purple;
            color: white;
            padding: 10px;
            z-index: 1;
            border-radius: 10px;
            margin-top: -20px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            font-weight: 600;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .form_container form input,
        .form_container form select,
        .form_container form button {
            border: none;
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
            padding: 10px;
        }

        #outputContainer {
            display: none;
            width: 40%;
            background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(151, 41, 247, 1) 0%, rgba(24, 22, 39, 1) 90%);
            padding: 30px 50px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            margin: 10% auto;
            border-radius: 10px;
            position: relative;
            color: whitesmoke;
        }

        #outputContainer h3 {
            font-size: 1.75rem;
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <div class="container form_container">
        <span class="fly">Add Students</span>
        <form id="studentForm" method="post">
            <input type="text" placeholder="Enter Student Name : " name="name" class="form-control mt-3" required>
            <input type="text" placeholder="Course : " name="course" class="form-control mt-3" required>
            <input type="number" placeholder="Age : " name="age" class="form-control mt-3" required>
            <select name="status" class="form-control mt-3" required>
                <option value="">-select-status-</option>
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                <option value="Widow">Widow</option>
            </select>
            <button type="submit" name="submit" class="btn btn-dark mt-4" id="click">Submit</button>
        </form>
    </div>

    <div class="output_container" id="outputContainer">

        <!-- Output will be displayed here -->
    </div>

    <script>
        $(document).ready(function() {
            $('#studentForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                $.ajax({
                    type: 'POST',
                    url: '', // Submit to the same page
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        console.log("Response received:", response); // Log the response
                        if (response) {
                            $('.form_container').hide(); // Hide the form container
                            $('#outputContainer').html(response).show(); // Show the output in outputContainer
                        } else {
                            console.error("Received an empty response");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown); // Log error details
                        alert('Error in submitting form: ' + textStatus);
                    }
                });
            });
        });
    </script>


    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>