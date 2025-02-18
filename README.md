![arrakis-header2](https://cis3760f23-14.socs.uoguelph.ca/components/course_finder.png)
# Course Nav API

A simple API which provides you with courses' JSON data, and it allows to manipulate it.

## Production host 
[https://cis3760f23-14.socs.uoguelph.ca/api/](https://cis3760f23-14.socs.uoguelph.ca/api/)

Make sure that **parameters** are used for GET and **request body data** is used for POST while requesting. 

## API

### `GET /get_courses`
This method uses a GET request to pull all course records from the table parsedData in the database courseData, then returns them as a JSON object.<br/>
example: `https://cis3760f23-14.socs.uoguelph.ca/api/get_courses`<br/>
```json
    {
    "status": 200,
    "message": "Courses found" ,
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
```
### `GET /get_course`
Parameters: courseCode, courseName, courseDescription<br/>
This method uses a GET request to pull the course record with the given parameters.<br/>
example: `https://cis3760f23-14.socs.uoguelph.ca/api/get_course?courseCode=CTS*1000`<br/>
```json
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
```
### `POST /add_course`
Data: courseCode, courseTitle, semesters, numLectures, numLabs, credits, courseDescription, offerings, offerings, prereqs<br/>
This method uses a POST request to create a new course record with the given parameters.<br/>
```json
    {
        "status": 201,
        "message": "Record created successfully",
    }  
```

### `POST /update_course`
Data: courseCode, courseTitle, semesters, numLectures, numLabs, credits, courseDescription, offerings, prereqs<br/>
This method uses a POST request to update the course record with the given parameters and course code.<br/>
```json
    {
        "status": 200,
        "message": "Record updated successfully",
    }  
```

### `POST /delete_course`
Data: courseCode<br/>
This method uses a POST request to delete the course record with the given course code.<br/>
```json
    {
        "status": 200,
        "message": "Record deleted successfully",
    }  
```
