<html>
    <head>
        <style>
            <?php include "how_to_use.css"; ?>
        </style>
        <title>How to Use</title>
        <link rel="icon" type="image/x-icon" href="../components/course_finder_icon.png">
    </head>
    <body>
        <?php
            include '../components/navbar.php';
        ?>
        <div class="container-fluid px-4 py-5 my-5 text-center">
            <div class="lc-block">
                <div editable="rich">
                    <h2 class="display-5 fw-bold">How to Use</h2>
                </div>
            </div>
        </div>
        <div class="body_div">
            <ol>
                <li class="body_list">Download the <a href="https://cis3760f23-14.socs.uoguelph.ca/">Eligibility Finder</a> from our Home page.
                    <ul>
                        <li class="body_list">The Eligibility Finder is currently Windows only. <a href="https://cis3760f23-14.socs.uoguelph.ca/upcoming_features/">Mac support and more is on the way!</a>
                        </li>
                    </ul>
                </li>
                <li class="body_list">If you see a security risk message upon opening the file, you will need to <a href="https://support.microsoft.com/en-us/office/add-remove-or-change-a-trusted-location-in-microsoft-office-7ee1cdc2-483e-4cbb-bcb3-4e7c67147fb4">add your current directory to the Trust Center in Excel settings.</a> Once you add the location, close Excel and open the Eligibility Finder again.
                    <div>
                        <img src="../components/macros_blocked.png" alt="macros blocked" width="1000px">
                    </div>
                </li>
                <li class="body_list">Click the START SEARCH PROGRAM button to open the user form.
                    <div>
                        <img src="../components/user_form.png" alt="user form" width="800px">
                    </div>
                </li>
                <li class="body_list">In the left textbox, enter your courses in the format <b>COURSE*1234,COURSE*5678,COURSE,9012</b> - a single comma-separated sentence. Do not add any whitespace and do not press 'Enter' while entering your course codes.
                    <div>
                        <img src="../components/input_format.png" alt="input format" width="600px">
                    </div>
                </li>
                <li class="body_list">Once your courses are entered, click Submit to search for eligible courses. Please note that this may take 5-10 second to process depending on the courses provided.
                    <div>
                        <img src="../components/course_codes.png" alt="course codes" width="300px">
                    </div>
                </li>
                <li class="body_list">Your eligible courses will then appear in the right textbox. You can also view them by closing the user form and viewing the entries in <b>column E</b> on the Excel sheet.
                    <div>
                        <img src="../components/eligible_courses.png" alt="eligible courses" width="300px">
                    </div>
                    <ul>
                        <li class="body_list">The user form will show you eligible classes that require prerequisites to be taken; courses that do not require any prerequisites can be viewed in <b>column F</b>.</li>
                        <li class="body_list">Some courses have special prerequisite requirements that are currently unable to be implemented in the user form. To view these courses and their special requirements, see <b>columns G and H</b>.</li>
                    </ul>
                </li>
                <li class="body_list">To perform another course search, close and re-open the user form to refresh the results.</li>
            </ol>
        </div>
    </body>
</html>

<!--    Research / Resources used:
            - https://www.geeksforgeeks.org/how-to-include-content-of-a-php-file-into-another-php-file/ 
                + For importing PHP code from another file. Used for importing the navbar from "components/navbar.php"
            - https://stackoverflow.com/questions/6315772/how-to-import-include-a-css-file-using-php-code-and-not-html-code
                + For importing a CSS file using PHP rather than HTML.
-->