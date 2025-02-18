<html>
    <head>
        <style>
            <?php include "upcoming_features.css"; ?>
        </style>
        <title>Upcoming Features</title>
        <link rel="icon" type="image/x-icon" href="../components/course_finder_icon.png">
    </head>
    <body>
        <?php
            include '../components/navbar.php';
        ?>
        <div class="container-fluid px-4 py-5 my-5 text-center">
            <div class="lc-block">
                <div editable="rich">
                    <h2 class="display-5 fw-bold">Upcoming Features</h2>
                </div>
            </div>
        </div>
        <div class="body_div">
            <div class="row">
                <div class="col card feature_div">
                    <h3 class="display-8 fw-bold text-center">Mac Support</h3>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Icon-Mac.svg/1200px-Icon-Mac.svg.png" alt="mac logo">
                    <p>Unfortunately, the Eligibility Finder is only supported on Windows devices at this time. We are planning on refactoring our macro code to support Excel for Mac in the near future!</p>
                </div>
                <div class="col card feature_div">
                    <h3 class="display-8 fw-bold text-center">User Form Input Filters</h3>
                    <img src="../components/filters.png" alt="filters">
                    <p>We are planning on implementing search filters to allow courses with special prerequisite requirements to be searched for with the user form and to allow courses with no prerequisites to be included/excluded from the results as desired.</p>
                </div>
            </div>
            <div class="row">
                <div class="col card feature_div">
                    <h3 class="display-8 fw-bold text-center">Eligible Courses Export</h3>
                    <img src="../components/export.png" alt="export">
                    <p>Want to save your results for future reference? We are planning on implementing an export feature that will allow you to save your results in .csv format or in a .txt file.</p>
                </div>
                <div class="col card feature_div">
                    <h3 class="display-8 fw-bold text-center">Course Details Pane</h3>
                    <img src="../components/course_details.png" alt="details">
                    <p>Tired of alt-tabbing between the Eligiblity Finder and Webadvisor? Soon, you will be able to view all course details within a separate "details" pane in the user form.</p>
                </div>
            </div>
        </div>
    </body>
</html>