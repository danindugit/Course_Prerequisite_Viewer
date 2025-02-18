let courseMap = new Map();

courseMap.set("accounting", "acct");
courseMap.set("agriculture", "agr");
courseMap.set("animal science", "ansc");
courseMap.set("anthropology", "anth");
courseMap.set("arabic", "arab");
courseMap.set("art history", "arth");
courseMap.set("arts and sciences", "asci");
courseMap.set("biochemistry", "bioc");
courseMap.set("biology", "biol");
courseMap.set("biomedical science", "biom");
courseMap.set("black canadian studies", "blck");
courseMap.set("botany", "bot");
courseMap.set("business", "bus");
courseMap.set("chemistry", "chem");
courseMap.set("chinese", "chin");
courseMap.set("classical", "clas");
courseMap.set("classics", "clas");
courseMap.set("computing and information science", "cis");
courseMap.set("computer science", "cis");
courseMap.set("co-op", "coop");
courseMap.set("co-operative education", "coop");
courseMap.set("crop science", "crop");
courseMap.set("culture and technology", "cts");
courseMap.set("economics", "econ");
courseMap.set("environmental design and rural developement", "edrd");
courseMap.set("engineering", "engg");
courseMap.set("english", "engl");
courseMap.set("environmental manegement", "envm");
courseMap.set("environmental sciences", "envs");
courseMap.set("equine", "eqn");
courseMap.set("european", "euro");
courseMap.set("finance", "fin");
courseMap.set("family relations and human developement", "frhd");
courseMap.set("food science", "food");
courseMap.set("french", "fren");
courseMap.set("geography", "geog");
courseMap.set("german", "germ");
courseMap.set("greek", "grek");
courseMap.set("history", "hist");
courseMap.set("horticulture science", "hort");
courseMap.set("hospitality and tourism management", "htm");
courseMap.set("human resources and organizational behaviour", "hrob");
courseMap.set("human kinetics", "hk");
courseMap.set("humanities", "humn");
courseMap.set("indigenous", "indg");
courseMap.set("international developement", "idev");
courseMap.set("italian", "ital");
courseMap.set("landscape architecture", "larc");
courseMap.set("latin", "lat");
courseMap.set("linguistics", "ling");
courseMap.set("management", "mgmt");
courseMap.set("marketing and consumer", "mcs");
courseMap.set("mathematics", "math");
courseMap.set("microbiology", "micr");
courseMap.set("molecular and cellular biology", "mcb");
courseMap.set("molecular biology and genetics", "mbg");
courseMap.set("music", "musc");
courseMap.set("nanoscience", "nano");
courseMap.set("neuroscience", "neur");
courseMap.set("nutrition", "nutr");
courseMap.set("pathology", "path");
courseMap.set("philosophy", "phil");
courseMap.set("physics", "phys");
courseMap.set("plant biology", "pbio");
courseMap.set("political science", "pols");
courseMap.set("population medicine", "popm");
courseMap.set("portugese", "port");
courseMap.set("psychology", "psyc");
courseMap.set("sociology", "soc");
courseMap.set("sociology and anthropology", "soan");
courseMap.set("spanish", "span");
courseMap.set("statistics", "stat");
courseMap.set("studio art", "sart");
courseMap.set("theatre", "thst");
courseMap.set("toxicology", "tox");
courseMap.set("zoology", "zoo");
courseMap.set("acct", "acct");
courseMap.set("agr", "agr");
courseMap.set("ansc", "ansc");
courseMap.set("anth", "anth");
courseMap.set("arab", "arab");
courseMap.set("arth", "arth");
courseMap.set("asci", "asci");
courseMap.set("bioc", "bioc");
courseMap.set("biol", "biol");
courseMap.set("biom", "biom");
courseMap.set("blck", "blck");
courseMap.set("bot", "bot");
courseMap.set("bus", "bus");
courseMap.set("chem", "chem");
courseMap.set("chin", "chin");
courseMap.set("clas", "clas");
courseMap.set("cis", "cis");
courseMap.set("coop", "coop");
courseMap.set("crop", "crop");
courseMap.set("cts", "cts");
courseMap.set("econ", "econ");
courseMap.set("edrd", "edrd");
courseMap.set("engg", "engg");
courseMap.set("engl", "engl");
courseMap.set("envm", "envm");
courseMap.set("envs", "envs");
courseMap.set("eqn", "eqn");
courseMap.set("euro", "euro");
courseMap.set("fin", "fin");
courseMap.set("frhd", "frhd");
courseMap.set("food", "food");
courseMap.set("fren", "fren");
courseMap.set("geog", "geog");
courseMap.set("germ", "germ");
courseMap.set("grek", "grek");
courseMap.set("hist", "hist");
courseMap.set("hort", "hort");
courseMap.set("htm", "htm");
courseMap.set("hrob", "hrob");
courseMap.set("hk", "hk");
courseMap.set("humn", "humn");
courseMap.set("indg", "indg");
courseMap.set("idev", "idev");
courseMap.set("ital", "ital");
courseMap.set("larc", "larc");
courseMap.set("lat", "lat");
courseMap.set("ling", "ling");
courseMap.set("mgmt", "mgmt");
courseMap.set("mcs", "mcs");
courseMap.set("math", "math");
courseMap.set("micr", "micr");
courseMap.set("mcb", "mcb");
courseMap.set("mbg", "mbg");
courseMap.set("musc", "musc");
courseMap.set("nano", "nano");
courseMap.set("neur", "neur");
courseMap.set("nutr", "nutr");
courseMap.set("path", "path");
courseMap.set("phil", "phil");
courseMap.set("phys", "phys");
courseMap.set("pbio", "pbio");
courseMap.set("pols", "pols");
courseMap.set("popm", "popm");
courseMap.set("port", "port");
courseMap.set("psyc", "psyc");
courseMap.set("soc", "soc");
courseMap.set("soan", "soan");
courseMap.set("span", "span");
courseMap.set("stat", "stat");
courseMap.set("sart", "sart");
courseMap.set("thst", "thst");
courseMap.set("tox", "tox");
courseMap.set("zoo", "zoo");

// declare modal/popup window
const myModal = new bootstrap.Modal(document.getElementById('courseModal'))
var coursesInSubject
var coursesInSubjectNodes
// Fetching all courses for the subject
async function fetchCoursesInSubject(courseCode) {
  const formData = new FormData()
  formData.append("courseCode", courseMap.get(courseCode.toLowerCase()))
  try {
    const response = await fetch("https://cis3760f23-14.socs.uoguelph.ca/api/get_courses_in_subject/", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();
    return result.data
  } catch (error) {
    console.error("Error:", error);
  }
}

// Fetching edges for the course 
async function fetchPrereqsForCourse(courseCode) {
  const formData = new FormData()
  formData.append("courseCode", courseCode)
  try {
    const response = await fetch("https://cis3760f23-14.socs.uoguelph.ca/api/fetch_prereqs_for_course/", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();
    return result.data
  } catch (error) {
    console.error("Error:", error);
  }
}

// Fetching data for single course
async function fetchCourseData(courseCode) {
  const formData = new FormData()
  formData.append("courseCode", courseCode)
  try {
    const response = await fetch("https://cis3760f23-14.socs.uoguelph.ca/api/get_course/", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();
    return result.data
  } catch (error) {
    console.error("Error:", error);
  }
}

//input + main interaction
function submitSubject() {
  subject = document.getElementById("subject").value

  main(subject)
}

document.getElementById('submitButton').addEventListener('click', function () {
  // Show the loading bar
  var loadingBar = document.getElementById('loadingBar');
  loadingBar.style.display = 'block';

  // Animate the loading bar
  var progress = document.getElementById('progress');
  var width = 0;
  var interval = setInterval(function () {
    if (width >= 100) {
      clearInterval(interval);
      loadingBar.style.display = 'none';
    } else {
      width++;
      progress.style.width = width + '%';
    }
  }, 15);
});



async function main(subject) {

  const courses = await fetchCoursesInSubject(subject)
  
  // format courses to create nodes. called init beacuse more nodes can appear after creating edges 
  const initNodes = []
  courses.forEach((course) => {
    try {
      if (course.courseCode != "") {
        initNodes.push({ data: { id: course.courseCode, name: course.courseCode } })
      }
    } catch { }
  })
  coursesInSubject = courses;
  // finding edges and adding more nodes
  const moreNodes = []
  const courseEdges = []
  for (let i = 0; i < initNodes.length; i++) {
    const prereqs = await fetchPrereqsForCourse(initNodes[i].data.id)
    

    // parse only clean prereqs
    prereqs.forEach((prereq) => {
      // console.log(prereq.data.source);
      if (
        prereq.data.source != '' &&
        !prereq.data.source.includes("credits") &&
        !prereq.data.source.includes("work") &&
        !prereq.data.source.includes("[") &&
        !prereq.data.source.includes("]") &&
        !prereq.data.source.includes("(") &&
        !prereq.data.source.includes(")") &&
        !prereq.data.source.includes("above") &&
        !prereq.data.source.includes("equivalent")
      ) {
        courseEdges.push(prereq)

        // add more nodes based on prereqs if not in the initNodes
        const found = initNodes.find((node) => node.data.id == prereq.data.source);
        if (!found) {
          moreNodes.push({ data: { id: prereq.data.source, name: prereq.data.source } })
        }
      }
    })
  }
  // all course nodes
  const courseNodes = initNodes.concat(moreNodes);
  coursesInSubjectNodes = courseNodes;

  courseNodes.forEach((node)=>{
    const index = node.data.name.indexOf("*")
    const year = node.data.name.slice(index+1);

    if(year[0] == 1){
      node.classes = "firstYear" 
    }else if(year[0] == 2){
      node.classes = "secondYear" 
    }else if(year[0] == 3){
      node.classes = "thirdYear" 
    }else if(year[0] == 4){
      node.classes = "fourthYear" 
    }
  })

  // graph config
  var cy = cytoscape({
    container: document.getElementById('cy'),

    boxSelectionEnabled: false,
    autounselectify: true,

    style: cytoscape.stylesheet()
      .selector('node')
      .css({
        'height': 100,
        'width': 100,
        'background-color': '#FFC72A',
        'border-color': '#0D99FF',
        'border-width': 3,
        'border-opacity': 0.5,
        'color': '#000000',
        'text-valign': 'center',
        'content': 'data(name)',
        'label': 'data(name)',
      })
      .selector('edge.dashed')
        .css({
          'line-style': 'dashed',
          'line-dash-pattern': [6, 3],
          'line-dash-offset': 24,
      })
      .selector('.firstYear')
        .css({
          'background-color': '#cbf5dd',
        })
      .selector('.secondYear')
        .css({
          'background-color': '#f1f2c2',
        })
      .selector('.thirdYear')
        .css({
          'background-color': '#fad1a7',
        })
      .selector('.fourthYear')
        .css({
          'background-color': '#faaba5',
        })
      .selector('edge')
      .css({
        'curve-style': 'bezier',
        'width': 6,
        'target-arrow-shape': 'triangle',
        'line-color': '#C20430',
        'target-arrow-color': '#C20430'
      })
      .selector('node.highlight')
      .css({
        'background-color': '#00FFFF'
      })
      .selector('edge.highlight')
      .css({
        'line-color': '#08a4a7',
        'target-arrow-color': '#08a4a7'
      })
      .selector('node.going_to')
      .css({
        'background-color': '#08AF3E'
      })
      .selector('edge.going_to')
      .css({
        'line-color': '#068C31',
        'target-arrow-color': '#068C31'
      })
      .selector('node.selected')
      .css({
        'background-color': '#6E50AE'
      })
      ,

    elements: {
      nodes: courseNodes,
      edges: courseEdges
    },

    layout: {
      name: 'breadthfirst',
      directed: true,
      padding: 20,
      spacingFactor: 4,
    }
  }); // cy init

  cy.on('mouseover', 'node', function(event) {
    var node = this;
    node.addClass('selected');
    var prereqNodes = event.target.incomers()
    var goingNodes = event.target.outgoers()
    var i = 0;
    var highlightElement = function() {
      if (i < prereqNodes.length) {
        prereqNodes.addClass('highlight');
        goingNodes.addClass('going_to');
        i++;
        highlightElement();
      }
    };
    highlightElement();
  })
  cy.on('mouseout', 'node', function(event) {
    var node = this;
    node.removeClass('selected');
    var prereqNodes = event.target.incomers()
    var goingNodes = event.target.outgoers()
    var i = 0;
    var removeHighlight = function() {
      if (i < prereqNodes.length) {
        prereqNodes.removeClass('highlight');
        goingNodes.removeClass('going_to');
        i++;
        removeHighlight();
      }
    };
    removeHighlight();
  })

  cy.on('dbltap', 'node', async function () {
    var nodes = this;

    const courseData = await fetchCourseData(nodes[0]._private.data.id)
    console.log(courseData);

    // modify data of modal
    title = document.getElementById("courseModalTitle")
    title.innerHTML = nodes[0]._private.data.id

    body = document.getElementById("courseModalBody")

    const jsx =
      `
        <div class="d-flex flex-column">
          <span><b>Title:</b> ${courseData.courseTitle}</span>
          <span><b>Description:</b> ${courseData.courseDescription}</span>
          <span><b>Credits:</b> ${courseData.credits}</span>
          <span><b>Department:</b> ${courseData.department}</span>
          <span><b>Location:</b> ${courseData.location}</span>
          <span><b>Prerequisites:</b> ${courseData.prerequisites}</span>
          <span><b>Restrictions:</b> ${courseData.restrictions}</span>
          <span><b>Semesters:</b> ${courseData.semesters}</span>
        </div>
      `

    body.innerHTML = jsx

    myModal.show()
  }); // on tap

  document.getElementById('courseButton').addEventListener('click', function() {

    var course = document.getElementById('courseText').value

    //add highlight to course node
    var foundNode = cy.elements('[id = "'+course+'"]');
    foundNode.addClass('selected');
    var prereqNodes = foundNode.incomers()
    var goingNodes = foundNode.outgoers()
    var i = 0;
    var highlightNewElement = function() {
      if (i < prereqNodes.length) {
        prereqNodes.addClass('highlight');
        goingNodes.addClass('going_to');
        i++;
        highlightNewElement();
    }
  };
  highlightNewElement();

  
  })


  function isPrereqAnd(toCoursePrerequisite, fromCourse){
    // console.log("fromCourse: " + fromCourse);
    // console.log("toCoursePrerequisite: " + toCoursePrerequisite);

    if(toCoursePrerequisite.includes(`${fromCourse} or`) || toCoursePrerequisite.includes(`or ${fromCourse}`)){
      return false
    } else{
      return true
    }
  }

  courseEdges.forEach(async(edge)=>{
    const fromCourse = edge.data.source
    const toCourse = edge.data.target
    const res = await fetchCourseData(toCourse)
    const toCoursePrerequisite = res.prerequisites
    
    if(!isPrereqAnd(toCoursePrerequisite, fromCourse)){
      var foundNode = cy.elements('[id = "'+edge.data.id+'"]');
      foundNode.addClass("dashed")
    }
  })
}