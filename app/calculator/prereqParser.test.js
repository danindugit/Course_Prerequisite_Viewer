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



describe('isPrereqAnd', () => {
    test('Simple single course prereq', () => {
        const prereq = "ACCT*3330";
        const course = "ACCT*3330";
        expect(isPrereqAnd(prereq,course)).toEqual(true);
    });

    test('Simple or case', () => {
        const prereq = "ACCT*1220 or ACCT*2220";
        const course = "ACCT*1220";
        expect(isPrereqAnd(prereq,course)).toEqual(false);
    });

    test('Bracket or case', () => {
        const prereq = "[CIS*1910 or (CIS*2910 and ENGG*1500)], CIS*2520";
        const course = "ENGG*1500";
        expect(isPrereqAnd(prereq,course)).toEqual(false);
    });
    
    test('Bracket of case', () => {
        const prereq = "CHEM*1050, (1 of IPS*1510, MATH*1090, MATH*1210, MATH*2080)";
        const course = "MATH*1090";
        expect(isPrereqAnd(prereq,course)).toEqual(false);
    });

    test('2 of cases', () => {
        const prereq = "ECON*1050, (1 of IPS*1500, MATH*1030, MATH*1080, MATH*1200), (1 of ECON*2740, PSYC*1010, PSYC*2010, SOAN*2120, STAT*2040, STAT*2060, STAT*2080, STAT*2120)";
        const course = "STAT*2080";
        expect(isPrereqAnd(prereq,course)).toEqual(false);
    });

    test('deduce AND case in complex prereq', () => {
        const prereq = "ECON*1050, (1 of IPS*1500, MATH*1030, MATH*1080, MATH*1200), (1 of ECON*2740, PSYC*1010, PSYC*2010, SOAN*2120, STAT*2040, STAT*2060, STAT*2080, STAT*2120)";
        const course = "ECON*1050";
        expect(isPrereqAnd(prereq,course)).toEqual(true);
    });

    test('complex and weird of case', () => {
        const prereq = "[1 of or ECON*3610, ECON*3810, (ECON*3860 or FIN*3400)], (ECON*3710 or ECON*3620)";
        const course = "ECON*3810";
        expect(isPrereqAnd(prereq,course)).toEqual(false);
    });

    test('complex and case', () => {
        const prereq = "[CIS*1910 or (CIS*2910 and ENGG*1500)], CIS*2520";
        const course = "CIS*2520";
        expect(isPrereqAnd(prereq,course)).toEqual(true);
    });

});

describe('parsePrereq', () => {
    test('parses standard prerequisite string correctly', () => {
        const prereq = "CIS*1300, MATH*1200";
        expect(parsePrereq(prereq)).toEqual(['CIS*1300', 'MATH*1200']);
    });

    test('handles invalid input', () => {
        const prereq = "UNKNOWN PREREQ";
        expect(parsePrereq(prereq)).toEqual(['UNKNOWN PREREQ']);
    });

    test('X of course,course,course... test', () => {
        const prereq = "2 of CIS*1000,CIS*2000,CIS*3000,CIS*4000";
        expect(parsePrereq(prereq)).toEqual(['2 of CIS*1000,CIS*2000,CIS*3000,CIS*4000']);
    });

    test('combo test', () => {
        const prereq = "CIS*1300,GEOG*2420,(1 of CIS*2200,CIS*2300,CIS*2400),CIS*1910,(CIS*3200 or CIS*3300),(ewe, wwwe)";
        expect(parsePrereq(prereq)).toEqual(['CIS*1300','GEOG*2420','1 of CIS*2200,CIS*2300,CIS*2400','CIS*1910','CIS*3200 or CIS*3300','UNKNOWN PREREQ','UNKNOWN PREREQ']);
    });

    test('including test', () => {
        const prereq = "5.0 credits including CIS*1300";
        expect(parsePrereq(prereq)).toEqual(['5.0 credits','CIS*1300']);
    });

});

//matchprereq tests 
describe('matchPrereq', () => {
    test('returns true when prerequisites are met', () => {
        const coursesTaken = ['CIS*1300', 'MATH*1200'];
        const prereqArray = ['CIS*1300'];
        expect(matchPrereq(coursesTaken, prereqArray)).toBe(true);
    });

    describe('matchPrereq', () => {
        test('returns false for unknown prerequisite', () => {
            expect(matchPrereq(['course1'], ['UNKNOWN PREREQ'])).toBe(false);
        });

        test('returns true when single prerequisite is met', () => {
            expect(matchPrereq(['MATH*1200'], ['MATH*1200'])).toBe(true);
        });

        test('returns false when single prerequisite is not met', () => {
            expect(matchPrereq(['MATH*1200'], ['CIS*2500'])).toBe(false);
        });

        test('handles "X of" prerequisites correctly', () => {
            expect(matchPrereq(['MATH*1200', 'CIS*1300'], ['2 of CIS*1300, MATH*1200, course3'])).toBe(true);
            expect(matchPrereq(['MATH*1200'], ['2 of MATH*1200, CIS*1300, CIS*2500'])).toBe(false);
        });

        test('handles "credits in" prerequisites correctly', () => {
            //fake courseMap for testing
            const courseMap = new Map([
                ['computing and information science', 'cis'],
                ['accounting', 'acct']
            ]);
            global.courseMap = courseMap;


        });



        test('handles "or" prerequisites correctly', () => {
            expect(matchPrereq(['course1'], ['course1 or course2'])).toBe(true);
            expect(matchPrereq(['course3'], ['course1 or course2'])).toBe(false);
        });

        test('handles credit prerequisites correctly', () => {
            expect(matchPrereq(['course1', 'course2', 'course3', 'course4'], ['2.0 credits'])).toBe(true);
            expect(matchPrereq(['course1'], ['2.0 credits'])).toBe(false);
        });


    });
});
