<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="icon" type="image/x-icon" href="components/course_finder_icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Prerequisite Parser for finding future courses at the University of Guelph.">
        <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
        }        
        #itemList { text-align: left; }
        </style>
    </head>
    <body>
        
        <?php
            include 'components/navbar.php';
        ?>


        <div class="container">
            <h1 class="text-center mt-5">Courses database:</h1>
            
            <select aria-label="Courses" id="itemList" size="20" class="form-select form-select-lg">
                <script>
                    const url = "https://cis3760f23-14.socs.uoguelph.ca/api/get_courses/index.php"
                    const itemList = document.getElementById("itemList")

                    fetchItemData()
                    function fetchItemData()
                    {
                        const res = fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            let dataColumns = ['courseCode','courseTitle','semesters','numLectures','numLabs','credits',
                            'courseDescription','offerings','prerequisites','equates','restrictions','department','location'];
                            for (const row of data.data)
                            {
                                console.log(row)
                                const opt = document.createElement('option')
                                for (const col of dataColumns){
                                    opt.setAttribute(col , (row[col] == null ? '' : row[col]));
                                }

                                opt.value = opt.getAttribute('courseCode');
                                opt.label = opt.value + " | " + opt.getAttribute('courseTitle');
                                opt.text = opt.value;
                                itemList.options.add(opt);
                            }
                        })
                    }
                </script>
            </select>
            <br>

            <form class="container" method="post" name="form" enctype="multipart/form-data">
            
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="selectedItem1">Course Code</label><br>
                    <input type="text" id="selectedItem1" class="form-control" placeholder="" name="courseCode">
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="selectedItem2">Course Name</label><br>
                    <input type="text" id="selectedItem2" class="form-control" placeholder="" name="courseName">
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="CSem">Semester</label><br>
                    <input type="text" id="CSem" class="form-control" placeholder="">
                </div>
            </div>
            

            <div class="row mb-3">
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="CSem1"># of Lectures</label><br>
                    <input type="number" id="CSem1" class="form-control" placeholder="" min="0" max="5">
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="CSem2"># of Labs</label><br>
                    <input type="number" id="CSem2" class="form-control" placeholder="" min="0" max="3">
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="CSem3"># of Credits</label><br>
                    <input type="number" id="CSem3" class="form-control" placeholder="" min="0" max="2" step="0.5">
                </div>
            </div>                
 
 
            <div class="row mb-5">
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="Cdescription">Course Description</label><br>
                    <textarea id="Cdescription" class="form-control" placeholder=""></textarea>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="COfferings">Offerings</label><br>
                    <textarea id="COfferings" class="form-control" placeholder=""></textarea>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <label for="CPrereqs">Prerequisites</label><br>
                    <textarea id="CPrereqs" class="form-control" placeholder=""></textarea>
                </div>
            </div>
           

            <div class="row">
                <div class="col-12">
                    <button id="addCourse" class="w-100 btn btn-dark mb-3" name="add" onclick="addFunction()">Add course to database</button>
                    <button id="updateCourse" class="w-100 btn btn-dark mb-3" name="update" onclick="updateFunction()">Update Course</button>
                </div>
            </div>

            
            <div class="row card p-3">
                <div class="col-12">
                    <label for="selectedItem3">Course Code</label><br>
                    <input type="text" id="selectedItem3" class="form-control mb-3" placeholder="" name="courseCode2">

                    <button id="deleteCourse" class="w-100 btn btn-dark" name="delete">Delete Course</button>
                </div>
            </div>
        </form>
        </div>
        

        
        
        <script>
            function validateInput(courseCode, courseName, numLectures, numLabs, credits) {
               var result = true;
               var outputMessage= "The following fields are invalid:\n\n";
               const courseCodePattern = /^[a-zA-Z]{2,4}\*\d{4}$/;
               const courseNamePattern = /['"%]/;
               // course code validation
               if (!(courseCodePattern.test(courseCode) && !/\s/.test(courseCode) && courseCode.trim.length > 0)){
                  outputMessage += "course code, ";
                  result = false;
               }
               if (courseNamePattern.test(courseName) %% courseName.trim.length == 0){
                  outputMessage += "course name, ";
                  result = false;
               }
               if (numLectures < 0) {
                  outputMessage += "number of lectures, ";
                  result = false
               }
               if (numLabs < 0) {
                  outputMessage += "number of labs, ";
                  result = false;
               }
               if (credits < 0) {
                  outputMessage += "credits, ";
                  result = false;
               }

               if(result == false) {
                  alert(outputMessage);
               }
               
               return result;
            }
            function addFunction()
            {
                var courseCode = document.getElementById("selectedItem1").value;
                var courseName = document.getElementById("selectedItem2").value;
                var semesters = document.getElementById("CSem").value;
                var numLectures = document.getElementById("CSem1").value;
                var numLabs = document.getElementById("CSem2").value;
                var credits = document.getElementById("CSem3").value;
                var courseDescription = document.getElementById("Cdescription").value;
                var offerings = document.getElementById("COfferings").value;
                var prereqs = document.getElementById("CPrereqs").value;
                if(validateInput(courseCode, courseName, numLectures, numLabs, credits)){
                  $.ajax({
                     type : "POST",
                     url : "https://cis3760f23-14.socs.uoguelph.ca/api/add_course/index.php",
                     data : { courseCode : courseCode, courseTitle : courseName, semesters : semesters, numLectures : numLectures, numLabs : numLabs,
                              credits : credits, courseDescription : courseDescription, offerings : offerings, prerequisites : prereqs},
                     success: console.log("pog")
                  })
               }
            }
            function updateFunction()
            {
                var courseCode = document.getElementById("selectedItem1").value;
                var courseName = document.getElementById("selectedItem2").value;
                var semesters = document.getElementById("CSem").value;
                var numLectures = document.getElementById("CSem1").value;
                var numLabs = document.getElementById("CSem2").value;
                var credits = document.getElementById("CSem3").value;
                var courseDescription = document.getElementById("Cdescription").value;
                var offerings = document.getElementById("COfferings").value;
                var prereqs = document.getElementById("CPrereqs").value;
                if(validateInput(courseCode, courseName, numLectures, numLabs, credits)){
                $.ajax({
                    type : "POST",
                    url : "https://cis3760f23-14.socs.uoguelph.ca/api/update_course/index.php",
                    data : { courseCode : courseCode, courseTitle : courseName, semesters : semesters, numLectures : numLectures, numLabs : numLabs,
                             credits : credits, courseDescription : courseDescription, offerings : offerings, prerequisites : prereqs},
                    success: console.log("pog")
                })
               }
            }
        </script>

        <script>
            document.getElementById('itemList').addEventListener('change', function() {
                document.getElementById('selectedItem1').value = this.options[this.selectedIndex].value;
                document.getElementById('selectedItem3').value = this.options[this.selectedIndex].value;
                document.getElementById('selectedItem2').value = this.options[this.selectedIndex].getAttribute('courseTitle');

                document.getElementById('CSem').value = this.options[this.selectedIndex].getAttribute('semesters');
                document.getElementById('CSem1').value = this.options[this.selectedIndex].getAttribute('numLectures');
                document.getElementById('CSem2').value = this.options[this.selectedIndex].getAttribute('numLabs');
                document.getElementById('CSem3').value = this.options[this.selectedIndex].getAttribute('credits');

                document.getElementById('Cdescription').value = this.options[this.selectedIndex].getAttribute('courseDescription');
                document.getElementById('COfferings').value = this.options[this.selectedIndex].getAttribute('offerings');
                document.getElementById('CPrereqs').value = this.options[this.selectedIndex].getAttribute('prerequisites');
                
            });
        </script>

        <script>
            document.getElementById('deleteCourse').addEventListener('click', function() {
                var result = window.confirm("Are you SURE you want to delete this course?");
                
                if (result) {
                    console.log("You clicked Yes.");
                    deleteFunction();
                } else {
                    console.log("You clicked No.");
                }

                function deleteFunction()
                {
                    var courseCode = document.getElementById("selectedItem3").value;
                    const courseCodePattern = /^[a-zA-Z]{2,4}\*\d{4}$/;
                    if (!(courseCodePattern.test(courseCode) && !/\s/.test(courseCode))){
                        alert("Course code is invalid.");
                    }
                    else{
                    $.ajax({
                        type : "POST",
                        url : "https://cis3760f23-14.socs.uoguelph.ca/api/delete_course/index.php",
                        data : { courseCode : courseCode },
                        success: console.log("pog")
                    })
                  }
                }
            });
        </script>

        <div class="container text-center py-2 mb-4 ">
            <div class="p-5 mb-4 lc-block">
                <img src="components/course_finder.png" alt="Course Finder Logo" style="max-width:60%;">
                <div class="lc-block mb-5">
                    <div editable="rich">
                        <p class="lead">Find your next class.<br></p>
                    </div>
                </div>
                <div class="lc-block mb-2">
                    <a class="btn btn-dark btn-lg"  href="https://cis3760f23-14.socs.uoguelph.ca/Eligibility_Finder.xlsm" role="button">Download</a>
                </div>
            </div>
        </div>


    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
</body>
</html>

