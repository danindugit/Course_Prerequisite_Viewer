//Course map global variable - this will get used when the course code is needed for a specific program
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
courseMap.set("crop science", "crop");
courseMap.set("culture and technology", "cts");
courseMap.set("economics", "econ");
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

// courseString should be in the form of "CIS*1300,CIS*1201,CIS*1500"
// make sure that the string is trimmed (no spaces between commas)
function getUltimatePrereq(courseString) {
   let result;

   $.ajax({
      url: 'apiCalls.php',
      method: 'POST',
      async: false,
      data: {
         action: 'callGetUltimatePrereqs', // the name of the PHP function
         param: courseString,
      },
      success: function (response) {
         result = JSON.parse(response);
      },
      error: function (xhr, status, error) {
         console.error(error);
      },
   });

   return result;
}

function jsonToArray(prereqJSON) {
   let coursesArray = [];
   for (let i = 0; i < Object.keys(prereqJSON).length; i++) {
      let currentCourseNum = "course" + i;
      if (prereqJSON.hasOwnProperty(currentCourseNum)) {
         coursesArray.push(prereqJSON[currentCourseNum]);
      }
   }

   return coursesArray;
}

function main(coursesString) {

   let possibleCourses = [];

   const trimmedString = coursesString.replace(/\s/g, "");

   let jsonData = getUltimatePrereq(trimmedString);
   // console.log("jsonData = ");
   // console.log(jsonData);

   possibleCourses = jsonToArray(jsonData.data);

   return possibleCourses;
}

function handleSubmit() {
   // console.log("Submit clicked");
   const inputTextBox = document.getElementById("input-text-box");
   let futureCourses = main(inputTextBox.value);
   // console.log(futureCourses);

   const eligibleCoursesDOM = document.getElementById("eligible-courses");
   eligibleCoursesDOM.innerHTML = '';

   futureCourses.forEach(element => {
      const newNode = document.createElement("p")
      newNode.style.padding = 0
      newNode.style.margin = 0
      newNode.style.paddingLeft = "18px"
      newNode.innerHTML = element
      eligibleCoursesDOM.appendChild(newNode)
   });
}

function parsePrereq(prereq) {
   let outp = [];

   if (prereq[0] <= '9' && prereq[0] >= '1' && prereq.includes(" of ") && !prereq.includes("credit")) {
      outp.push(prereq);
      return outp;
   }

   prereq = prereq.replace(" including ", ",");
   let arr = prereq.split(",");
   let inOf = false;
   let accum = "";

   if (arr.length == 1) return arr;

   for (let e of arr) {

      //MAIN LOOP   ==================================================
      e = e.trim();

      if (inOf) {

         if (e.slice(-1) == ')') {
            accum += e.slice(0, -1);
            outp.push(accum);
            inOf = false;
         } else accum += e + ',';

      } else if (e.includes("credit") || /^[A-Z][A-Z][A-Z][A-Z]?\*[0-9][0-9][0-9][0-9]$/.test(e))//lone course or credits
         outp.push(e);
      else if (e[0] == '(' && e.slice(-1) == ')' && e.includes(" or ")) {//or
         outp.push(e.slice(1, -1));
      } else if (e[0] == '(' && e[1] <= '9' && e[1] >= '1') {//X of
         inOf = true;
         accum = e.slice(1) + ',';
      } else {
         outp.push("UNKNOWN PREREQ");
         //return null;
      }
      //MAIN LOOP =====================================================

   }

   return (outp);
}

function matchPrereq(coursesTaken, prereqArray) {

   for (let prereq of prereqArray) {
      if (prereq == "UNKNOWN PREREQ") {
         return false;
      }

      else if (/^[0-9] of/.test(prereq)) {
         let digit = parseInt(prereq[0], 10);

         for (let course of coursesTaken) {
            if (prereq.toLowerCase().includes(course.toLowerCase())) {
               digit -= 1;
            }
         }

         if (digit > 0) {
            return false;
         }
      }

      else if (/ credits in /.test(prereq)) {
         let string = prereq.match(/(\d+\.\d+)\s+credits\s+in\s+(.+\s+)/);

         let creditsRequired = parseInt(string[1], 10);
         let program = string[2].trim();
         let programCode;
         let foundProgram;
         let numCreditsInProgram = 0;

         let programSplit = program.split(" ");

         for (let i = 0; i < programSplit.length; i++) {
            let substring = programSplit.slice(0, i + 1).join(' ');

            if (courseMap.has(substring.toLowerCase())) {
               programCode = courseMap.get(substring.toLowerCase());
               foundProgram = true;
               i = programSplit.length;
            }
         }
         if (!foundProgram) {
            programCode = programSplit[0];
         }

         for (let course of coursesTaken) {
            if (course.toLowerCase().includes(programCode.toLowerCase())) {
               numCreditsInProgram += 0.5;
            }
         }

         if (creditsRequired > numCreditsInProgram) {
            return false;
         }
      }

      else if (/ credits/.test(prereq)) {
         let creditsCompleted = coursesTaken.length / 2;

         let stringNumCredits = prereq.match(/^\d+\.\d+/);

         let numCreditsRequired = parseFloat(stringNumCredits[0]);

         if (numCreditsRequired > creditsCompleted) {
            return false;
         }
      }

      else if (/ or /.test(prereq)) {
         let digit = 1;

         for (let course of coursesTaken) {
            if (prereq.toLowerCase().includes(course.toLowerCase())) {
               digit -= 1;
            }
         }

         if (digit > 0) {
            return false;
         }
      }

      else {
         digit = 1;

         for (let course of coursesTaken) {
            if (prereq.toLowerCase() == course.toLowerCase()) {
               digit -= 1;
            }
         }

         if (digit > 0) {
            return false;
         }
      }
   }

   return true;

}

// returns a boolean - true if the prereq is an AND condition, false if OR
// AND condition if course MUST be taken, OR if the prereq could be true even if course not taken
// prereq is the prerequisite string
// course is the course code of the course to be checked
function isPrereqAnd(prereq, course) {
    //console.log("prereq: " + prereq + "        course: " + course);
    
    //If course is just on it's own in the prereq
    if(prereq.length >= course.length && prereq.length <= course.length+2)return true;
    
    ind = prereq.indexOf(course);
    
    //console.log(ind);
    
    ofInd = prereq.indexOf(" or ");
    
    if(ofInd != -1){//OR case check
        
        //console.log(prereq[ofInd+4]);
        
        if(ind < ofInd){//course is before 'or'
            //console.log("before or");
            if( (ofInd - course.length)==ind || (ofInd - course.length)-1==ind)return false;//simple or case
        }else{//course is after 'or'
            //console.log("after or");
            if((ofInd + 4)==ind || (ofInd+5)==ind )return false;//simple or case
            
            if( prereq[ofInd+4] == '(' ){
                //console.log("in brack")
                endInd = prereq.indexOf(')',ofInd+4);
                if(ind < endInd)return false;
            }
            
            if( prereq[ofInd+4] == '[' ){
                //console.log("in brack")
                endInd = prereq.indexOf(']',ofInd+4);
                if(ind < endInd)return false;
            }
            
            ofInd = prereq.indexOf(" or ",ofInd+4);
            
            if(ofInd != -1){//there's a second 'or'
                
                if((ofInd - course.length)==ind || (ofInd - course.length)-1==ind || (ofInd + 4)==ind || (ofInd+5)==ind )return false;//simple or case
                
                if( prereq[ofInd+4] == '(' ){
                    //console.log("in brack")
                    endInd = prereq.indexOf(')',ofInd+4);
                    if(ind < endInd)return false;
                }
                
                ofInd = prereq.indexOf(" or ",ofInd+4);
                
                if(ofInd != -1){//there's a third 'or'
                    if((ofInd - course.length)==ind || (ofInd - course.length)-1==ind || (ofInd + 4)==ind || (ofInd+5)==ind )return false;//simple or case
                }
            }
        }
    }//End of OR case

    ofInd = prereq.indexOf(" of ");
    if(ofInd == 1)return false;//simple X of case

    while( ofInd != -1 && ofInd < ind && !(prereq[ofInd-1] < '5') ){//get to the actual X of case
        ofInd = prereq.indexOf(" of ",ofInd+4);
    }
    
    if(ofInd != -1 && ofInd < ind){//X of check
        //console.log("X of!?")
        
        if(prereq[ofInd-2] == '('){
            endInd = prereq.indexOf(')',ofInd);
            if(ind < endInd)return false;
        }else if(prereq[ofInd-2]== '['){
            endInd = prereq.indexOf(']',ofInd);
            if(ind < endInd)return false;
        }
        
        ofInd = prereq.indexOf(" of ",ofInd+4);
        while( ofInd != -1 && ofInd < ind && !(prereq[ofInd-1] < '5') ){//get to the actual X of case
            ofInd = prereq.indexOf(" of ",ofInd+4);
        }
        
        if(ofInd != -1 && ofInd < ind){//there is a second X of
            //console.log("2 X of!??!?!?!?")
            if(prereq[ofInd-2] == '('){
                endInd = prereq.indexOf(')',ofInd);
                if(ind < endInd)return false;
            }else if(prereq[ofInd-2]== '['){
                endInd = prereq.indexOf(']',ofInd);
                if(ind < endInd)return false;
            }
        }
    }
    
    //console.log("FAILED TO FIND ANYTHING. DEFAULT TO AND")
    return true;
}

//module.exports = { parsePrereq, matchPrereq, isPrereqAnd, handleSubmit};
export { parsePrereq, matchPrereq, isPrereqAnd, handleSubmit };

