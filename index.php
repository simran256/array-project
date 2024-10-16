<?php
//========= associative array in PHP ============

function pop_up()
{
    if (isset($_POST['submit'])) {
        $students = [
            "Name" => $_POST['name'],
            "Course" => $_POST['course'],
            "Age" => $_POST['age'],
            "Married" => $_POST['status']
        ];

        // Prepare the output as a string to send back via AJAX
        $output = '';
        foreach ($students as $key => $value) {
            $output .= $key . ' : ' . $value . "<br>";
        }
        echo $output;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup with Form Submission</title>
    <style>
        /* Simple styles for the popup */
        .pop_container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 5px;
            z-index: 1000;
        }

        .close-btn {
            background-color: #f5c6cb;
            padding: 5px 10px;
            cursor: pointer;
        }

        /* Overlay to darken the background */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>

<body>

    <!-- Form to collect data -->
    <form id="studentForm" method="post">
        <input type="text" placeholder="Enter Student Name : " name="name" required>
        <input type="text" placeholder="Course : " name="course" required>
        <input type="number" placeholder="Age : " name="age" required>
        <select name="status" id="" required>
            <option value="">-select-status-</option>
            <option value="Married">Married</option>
            <option value="Single">Single</option>
            <option value="Widow">Widow</option>
        </select>
        <button type="submit" name="submit" id="click">Submit</button>
    </form>

    <!-- Overlay and popup container -->
    <div class="overlay"></div>
    <div class="pop_container">
        <div class="popup-content"></div>
        <button class="close-btn">Close</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission with AJAX
            $("#studentForm").on("submit", function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                $.ajax({
                    type: "POST",
                    url: "", // Current PHP file
                    data: $(this).serialize(), // Send form data
                    success: function(response) {
                        // Display the popup with the response
                        $(".popup-content").html(response);
                        $(".overlay").fadeIn(); // Show overlay
                        $(".pop_container").fadeIn(); // Show popup
                    },
                    error: function() {
                        $(".popup-content").html("An error occurred.");
                        $(".overlay").fadeIn();
                        $(".pop_container").fadeIn();
                    }
                });
            });

            // Close the popup and overlay
            $(".close-btn, .overlay").click(function() {
                $(".overlay").fadeOut();
                $(".pop_container").fadeOut();
            });
        });
    </script>

</body>

</html>

<?php
// Handle form submission and return the result via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    pop_up();
}
                                                                       