<!DOCTYPE html>
<html>
<head>
    <title>Documentation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        code{
            background-color: #f7f7f7;
        }
        .bold{ 
         font-weight: bold;
         font-size: 18px;
        }  
    </style>
</head>
<body class="container">
   <?php
       include '../components/navbar.php';
   ?>
   <br>
   <div class="text-center">
      <img src="../components/course_finder.png" alt="Course Finder Logo" style="max-height:320px;">
   </div>

   <br>
   <h1>Course Nav API</h1>
   <hr>
   <p>A simple API which provides you with courses' JSON data, and it allows to manipulate it.</p>

   <h2>Production host</h2>
   <hr>
   <a href="https://cis3760f23-14.socs.uoguelph.ca/api/">https://cis3760f23-14.socs.uoguelph.ca/api/</a>
   <br>
   <p>Make sure that parameters are used for GET and request body data is used for POST while requesting.</p>

   <h2>API</h2>
   <hr>
   <code class="bold">GET /get_courses</code>
   <br>
   <p>
      This method uses a GET request to pull all course records from the table parsedData in the database courseData, then returns them as a JSON object.
      <br>
      example: <code>https://cis3760f23-14.socs.uoguelph.ca/api/get_courses</code>
   </p>
   <pre>
   {
      "status": 200,
      "message": "Courses found",
      "data": [
         {
               "courseCode": "ACCT*3230",
               "courseTitle": "Intermediate Management Accounting",
               "semesters": "Winter and Summer",
               "numLectures": "3",
               "numLabs": null,
               "credits": "0.50",
               "courseDescription": "This course continues the managerial decision making focus of ACCT*2230. Topics include process costing, transfer pricing, the decision making process, variances and performance measurement.",
               "offerings": "Also offered through Distance Education format.",
               "prerequisites": "ACCT*2230",
               "equates": "BUS*3230",
               "restrictions": "Enrolment may be restricted to particular degrees or programs. See department for more information.",
               "department": "Department of Management",
               "location": "Guelph"
         },
         {
               "courseCode": "ACCT*3280",
               "courseTitle": "Auditing I",
               "semesters": "Summer and Fall",
               "numLectures": "3",
               "numLabs": null,
               "credits": "0.50",
               "courseDescription": "Auditing I is an examination of the principles and theory underlying the practice of auditing. Concepts of materiality and audit risk are examined and discussed. Sources and techniques for gathering auditing evidence will also be examined. Modern organizations rely on information systems, technology and internal controls to manage and monitor their operations and the impact of these systems on the quality of information produced and on the scope of audits are important elements of this course.",
               "offerings": null,
               "prerequisites": "ACCT*3330",
               "equates": null,
               "restrictions": null,
               "department": "Department of Management",
               "location": "Guelph"
         },
         ...
      ]
   }
   </pre>


   <br>
   <code class="bold">GET /get_course</code>
   <br>
   <p>
      Parameters: courseCode, courseName, courseDescription <br>
      This method uses a GET request to pull the course record with the given parameters. <br>
      example: <code>https://cis3760f23-14.socs.uoguelph.ca/api/get_course?courseCode=CTS*1000</code>
   </p>
   <pre>
   {
        "status": 200,
        "message": "Record found!",
        "data": {
            "courseCode": "CTS*1000",
            "courseTitle": "Culture and Technology: Keywords",
            "semesters": "Fall Only",
            "numLectures": "3",
            "numLabs": null,
            "credits": "0.50",
            "courseDescription": "The course will introduce core concepts and skills for digital literacy in connection with big questions facing culture and society. Students will engage with words used to think through the relationships between information and communication technologies and big ideas related to ethics, culture, and how we understand what it is to be human. Students will learn to write for a web audience through the creation of their own weblog.",
            "offerings": null,
            "prerequisites": null,
            "equates": null,
            "restrictions": "This is a Priority Access Course. Enrolment may be restricted to particular programs, specializations, majors or semester levels during certain periods.",
            "department": "Dean's Office, College of Arts",
            "location": "Guelph"
        }
    }
   </pre>

   <br>
   <code class="bold">GET /get_prereqs</code>
   <br>
   <p>
      Parameters: courseCodes <br>
      This method uses a GET request to pull course records with all of the given course parameters. <br>
      example: <code>https://cis3760f23-14.socs.uoguelph.ca/api/get_prereqs?courseCodes=CIS*1300,CIS*1910</code>
   </p>
   <pre>
   {
    "status": 200,
    "message": "Records found!",
    "data": [
        {
            "courseCode": "CIS*2910",
            "courseTitle": "Discrete Structures in Computing II",
            "semesters": "Winter Only",
            "numLectures": "3",
            "numLabs": "2",
            "credits": "0.50",
            "courseDescription": "This course is a further introduction to discrete structures and formal methodologies used in computer science, including sequences, summations, recursion, combinatorics, discrete probability, and graph theory.",
            "offerings": null,
            "prerequisites": "(CIS*1300 or ENGG*1410), (CIS*1910 or ENGG*1500)",
            "equates": null,
            "restrictions": null,
            "department": "School of Computer Science",
            "location": "Guelph"
         }
      ]
   }
   </pre>

   <code class="bold">GET /get_more_prereqs</code>
   <br>
   <p>
      Parameters: courseCodes <br>
      This method uses a GET request to pull course records with at least one of the given course prerequisites. <br>
      example: <code>https://cis3760f23-14.socs.uoguelph.ca/api/get_more_prereqs?courseCodes=CIS*1300,CIS*1910</code>
   </p>
   <pre>
   {
    "status": 200,
    "message": "Records found!",
    "data": [
        {
            "courseCode": "CIS*2170",
            "courseTitle": "User Interface Design",
            "semesters": "Winter Only",
            "numLectures": "3",
            "numLabs": "2",
            "credits": "0.75",
            "courseDescription": "This course is a practical introduction to the area of user interface construction. Topics include user interface components and their application, best practices for user interface design, approaches to prototyping, and techniques for assessing interface suitability.",
            "offerings": null,
            "prerequisites": "1 of CIS*1200, CIS*1300, CIS*1500",
            "equates": null,
            "restrictions": null,
            "department": "School of Computer Science",
            "location": "Guelph"
        },
        {
            "courseCode": "CIS*2250",
            "courseTitle": "Software Design II",
            "semesters": "Winter Only",
            "numLectures": "3",
            "numLabs": "2",
            "credits": "0.50",
            "courseDescription": "This course focuses on the process of software design. Best practices for code development and review will be the examined. The software development process and tools to support this will be studied along with methods for project management. The course has an applied focus and will involve software design and development experiences in teams, a literacy component, and the use of software development tools.",
            "offerings": null,
            "prerequisites": "CIS*1250, CIS*1300",
            "equates": null,
            "restrictions": "Restricted to BCOMP.SENG majors.",
            "department": "School of Computer Science",
            "location": "Guelph"
        },
        ...
      ]
   }
   </pre>

   <br>
   <code class="bold">POST /add_course</code>
   <br>
   <p>
      Data: courseCode, courseTitle, semesters, numLectures, numLabs, credits, courseDescription, offerings, offerings, prereqs <br>
      This method uses a POST request to create a new course record with the given parameters.
   </p>
   <pre>
   {
      "status": 201,
      "message": "Record created successfully",
   }  
    </pre>

   <br>
   <code class="bold">POST /update_course</code>
   <br>
   <p>
      Data: courseCode, courseTitle, semesters, numLectures, numLabs, credits, courseDescription, offerings, prereqs<br>
      This method uses a POST request to update the course record with the given parameters and course code.
   </p>
   <pre>
   {
        "status": 200,
        "message": "Record updated successfully",
   }  
   </pre>

   <br>
   <code class="bold">POST /delete_course</code>
   <br>
   <p>
      Data: courseCode<br>
      This method uses a POST request to delete the course record with the given course code.
   </p>
   <pre>
   {
        "status": 200,
        "message": "Record deleted successfully",
   }  
   </pre>

</body>
</html>
  
