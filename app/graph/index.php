<!DOCTYPE html>
<html>

<head>
    <title>Graph</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Graph">

</head>

<body>
    <?php
    include '../components/navbar.php';
    ?>

    <link href="style.css" rel="stylesheet" />

    <div class="container mt-5">
        <div class="d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #cbf5dd"></div>
                <p>First Level</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #f1f2c2"></div>
                <p>Second Level</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #fad1a7"></div>
                <p>Third Level</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #faaba5"></div>
                <p>Fourth Level</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #6E50AE"></div>
                <p>Selected</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #08AF3E"></div>
                <p>Next</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <div id="circle" style="background: #00FFFF"></div>
                <p>Required</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <hr id="line"/>
                <p>AND</p>
            </div>
            <div class="d-flex flex-column align-items-center m-2">
                <hr id="dashLine"/>
                <p>OR</p>
            </div>
    </div>

    <div class="container mt-5">
        <div>
            <label for="subject" class="form-label">Your Subject</label>
            <input type="text" class="form-control" id="subject" placeholder="ex: CIS">
            <button onclick="submitSubject()" id="submitButton" class="mt-3 w-100 btn btn-primary">Submit</button>
            <div id="loadingBar" style="display: none;">
                <div id="progress" style="width: 0%; height: 20px; background-color: #ffc72a;"></div>
            </div>
        </div>
        <div id="cy"></div>
    </div>

    <div id="courseModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="courseModalTitle" class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="courseModalBody" class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div>
            <label for="subject" class="form-label">Find Course</label>
            <input type="text" class="form-control" id="courseText" placeholder="ex: CIS*1300">
            <button id="courseButton" class="mt-3 w-100 btn btn-primary">Submit</button>
        </div>
    </div>

    <script src="cytoscape.min.js"></script>
    <script src="code.js"></script>
</body>

</html>