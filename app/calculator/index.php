<!DOCTYPE html>
<html>
<head>
<title>Prerequisite Parser</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Prerequisite Parser for finding future courses at the University of Guelph.">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php
        include '../components/navbar.php';
    ?>

    <style>
        .course-header{
            background-color: #C20430;
            color: #FFFFFF;
            border: 2px solid #600016 !important;
        }
        .course-title{
            background-color: #FFC72A;
            color: #000000;
            padding: 40px 25px 40px 25px;
            min-height: 150px;
            margin-bottom: 25px;
        }
        .course-data{
            background-color: #D9D9D9;
            min-height: 250px;
            margin-bottom: 25px;
        }
        .course-data div{
            height: 220px;
            width: 95%;
            background-color: #DBF0FF;
            border: 2px solid #0D99FF !important;
        }
        .course-btn{
            color: #1E1E1E;
            background-color: #DBF0FF;
            border: 2px solid #0D99FF !important;
            padding: 15px 95px 15px 95px;
        }
        .course-input{
            background-color: transparent;
            border: none;
            text-align: start;
            word-wrap: break-word;
            word-break: break-all;
        }
    </style>

    <div class="container mt-5">
        <!-- Header -->
        <div class="mb-3 row d-flex align-items-center justify-content-center">
            <div class="col-12">
                <div class="course-header border rounded d-flex align-items-center justify-content-center shadow-sm">
                    <h1 class="p-2 text-center">Guelph Course Eligibility Finder</h1>
                </div>
            </div>
        </div>
        <!-- Titles -->
        <div class="mb-3 row d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6">
                <div class="course-title border rounded d-flex align-items-center justify-content-center shadow-sm">
                    <h2>Enter courses taken separated by a comma</h2>
                </div>
                <div class="course-data border rounded d-flex align-items-center justify-content-center shadow-sm">
                    <div class="border rounded">
                        <textarea id="input-text-box" placeholder="Enter courses..." rows="14" cols="10" wrap="soft" class="course-input w-100 h-100"></textarea>
                    </div>
                </div>
                <div class="mb-3 d-flex d-md-none align-items-center justify-content-center">
                  <button class="course-btn border rounded shadow" id="btnSubmit1">Submit</button>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="course-title border rounded d-flex align-items-center justify-content-center shadow-sm">
                    <h2>The courses you are eligible for are</h2>
                </div>
                <div class="course-data border rounded d-flex align-items-center justify-content-center shadow-sm">
                    <div id="eligible-courses" class="border rounded overflow-y-auto p-1">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Submit -->
        <div class="mb-3 row d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-6">
                <div class="d-none d-md-flex align-items-center justify-content-center">
                  <button id="btnSubmit" class="course-btn border rounded shadow">Submit</button>
                </div>
            </div>
        </div>
    </div>

   <script src="prereqParser.js" type="module"></script>
   <script type="module">
      import { handleSubmit } from './prereqParser.js';

      document.addEventListener("DOMContentLoaded", function () {
         document.getElementById("btnSubmit").addEventListener("click", handleSubmit);
         document.getElementById("btnSubmit1").addEventListener("click", handleSubmit);
      });
   </script>
</body>
</html>

