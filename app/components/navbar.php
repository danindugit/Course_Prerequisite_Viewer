<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cis3760f23-14.socs.uoguelph.ca/components/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <style>
    .nav-link{
      color: #C20430 !important;
    }
  </style>
  <ul class="nav nav-tabs d-flex justify-content-center mt-5">
    <li class="nav-item">
      <a id="homepage" class="nav-link" href="/">Home</a>
    </li>
    <li class="nav-item">
      <a id="calculator" class="nav-link" href="/calculator">Prerequisite Parser</a>
    </li>
    <li class="nav-item">
      <a id="graph" class="nav-link" href="/graph">Graph</a>
    </li>
    <li class="nav-item">
      <a id="about" class="nav-link" href="/about">Demos</a>
    </li>
    <li class="nav-item">
      <a id="how_to_use" class="nav-link" href="/how_to_use">How To</a>
    </li>
    <li class="nav-item">
      <a id="bad_reviews" class="nav-link" href="/bad_reviews">Reviews</a>
    </li>
    <li class="nav-item">
      <a id="upcoming_features" class="nav-link" href="/upcoming_features">Upcoming Features</a>
    </li>
    <li class="nav-item">
      <a id="work_distribution" class="nav-link" href="/work_distribution">Work Distribution</a>
    </li>
    <li class="nav-item">
      <a id="documentation" class="nav-link" href="/documentation">Documentation</a>
    </li>
  </ul>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    let page = window.location.href;
    page = page.replace("https://cis3760f23-14.socs.uoguelph.ca/", "");
    if (page == ""){
	    page = "homepage";
    }
    page = page.replace("/", "");
    const link = document.getElementById(page);
    link.classList.add("active");
  </script>
</body>
</html>
