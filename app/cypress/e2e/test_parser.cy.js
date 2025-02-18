describe('parser spec', () => {
   it('Visits parser', () => {
     cy.visit('/calculator')
   })
 })

 describe("Test Eligible Courses", () => {
   it("should check eligibility for 2nd year CS courses", () => {
     // visit the webpage where the textarea, button, and result are located
     cy.visit("/calculator");
 
     // type "CIS*1910" into the textarea with id "input-text-box"
     cy.get("#input-text-box")
       .type("CIS*1910, CIS*1300, MATH*1200, CIS*2500, CIS*2910, MATH*1160")
       .should("have.value", "CIS*1910, CIS*1300, MATH*1200, CIS*2500, CIS*2910, MATH*1160");
 
     // click the button with id "btnSubmit"
     cy.get("#btnSubmit").click();
 
     // assert that the div with id "eligible-courses" contains the specified text
     cy.get("#eligible-courses")
       .should("include.text", "CIS*2030")
       .should("include.text", "CIS*2430")
       .should("include.text", "CIS*2520");
   });

   it("should check requirement for credits in a certain department", () => {
      // visit the webpage where the textarea, button, and result are located
      cy.visit("/calculator");
  
      // type "CIS*1910" into the textarea with id "input-text-box"
      cy.get("#input-text-box")
        .type("MATH*1160, STAT*2040")
        .should("have.value", "MATH*1160, STAT*2040");
  
      // click the button with id "btnSubmit"
      cy.get("#btnSubmit").click();
  
      // assert that the div with id "eligible-courses" contains the specified text
      cy.get("#eligible-courses")
        .should("include.text", "MATH*3240");
    });

    it("should check requirement for total number of credits", () => {
      // visit the webpage where the textarea, button, and result are located
      cy.visit("/calculator");
  
      // type "CIS*1910" into the textarea with id "input-text-box"
      cy.get("#input-text-box")
        .type("HIST*4030, HIST*4040, HIST*4070, HIST*4080, HIST*4100, HIST*4120, HIST*4140, HIST*4160, HIST*4170, HIST*4180, HIST*4200, HIST*4220, HIST*4230, HIST*4250, HIST*4270, HIST*4280, HIST*4450, HIST*4470, HIST*4580, HIST*4620, HIST*4700, HIST*4820, HIST*4970, HORT*2450, HORT*3010, HORT*3050, HORT*3150, HORT*3270, HORT*3280, HORT*3310, HORT*3430, HORT*3510, HORT*4200, HORT*4300, HORT*4380, HORT*4420, HORT*4450, HTM*2030, HTM*2070, HTM*2740, HTM*3030, HTM*3060, HTM*3080, HTM*3090, HTM*3120, HTM*3160, HTM*3180, HTM*3780, HTM*4050, HTM*4060, HTM*4080")
        .should("have.value", "HIST*4030, HIST*4040, HIST*4070, HIST*4080, HIST*4100, HIST*4120, HIST*4140, HIST*4160, HIST*4170, HIST*4180, HIST*4200, HIST*4220, HIST*4230, HIST*4250, HIST*4270, HIST*4280, HIST*4450, HIST*4470, HIST*4580, HIST*4620, HIST*4700, HIST*4820, HIST*4970, HORT*2450, HORT*3010, HORT*3050, HORT*3150, HORT*3270, HORT*3280, HORT*3310, HORT*3430, HORT*3510, HORT*4200, HORT*4300, HORT*4380, HORT*4420, HORT*4450, HTM*2030, HTM*2070, HTM*2740, HTM*3030, HTM*3060, HTM*3080, HTM*3090, HTM*3120, HTM*3160, HTM*3180, HTM*3780, HTM*4050, HTM*4060, HTM*4080");
  
      // click the button with id "btnSubmit"
      cy.get("#btnSubmit").click();
  
      // assert that the div with id "eligible-courses" contains the specified text
      cy.get("#eligible-courses")
        .should("include.text", "MGMT*3030");
    });
 });

 describe("Tests on iPhone 6", () => {
   it("should check eligibility for 2nd year CS courses", () => {
      cy.viewport('iphone-6')
     // visit the webpage where the textarea, button, and result are located
     cy.visit("/calculator");
 
     // type "CIS*1910" into the textarea with id "input-text-box"
     cy.get("#input-text-box")
       .type("CIS*1910, CIS*1300, MATH*1200, CIS*2500, CIS*2910, MATH*1160")
       .should("have.value", "CIS*1910, CIS*1300, MATH*1200, CIS*2500, CIS*2910, MATH*1160");
 
     // click the button with id "btnSubmit"
     cy.get("#btnSubmit1").click();
 
     // assert that the div with id "eligible-courses" contains the specified text
     cy.get("#eligible-courses")
       .should("include.text", "CIS*2030")
       .should("include.text", "CIS*2430")
       .should("include.text", "CIS*2520");
   });

   it("should check requirement for credits in a certain department", () => {
      // visit the webpage where the textarea, button, and result are located
      cy.viewport('iphone-6')
      cy.visit("/calculator");
  
      // type "CIS*1910" into the textarea with id "input-text-box"
      cy.get("#input-text-box")
        .type("MATH*1160, STAT*2040")
        .should("have.value", "MATH*1160, STAT*2040");
  
      // click the button with id "btnSubmit"
      cy.get("#btnSubmit1").click();
  
      // assert that the div with id "eligible-courses" contains the specified text
      cy.get("#eligible-courses")
        .should("include.text", "MATH*3240");
    });

    it("should check requirement for total number of credits", () => {
      // visit the webpage where the textarea, button, and result are located
      cy.viewport('iphone-6')
      cy.visit("/calculator");
  
      // type "CIS*1910" into the textarea with id "input-text-box"
      cy.get("#input-text-box")
        .type("HIST*4030, HIST*4040, HIST*4070, HIST*4080, HIST*4100, HIST*4120, HIST*4140, HIST*4160, HIST*4170, HIST*4180, HIST*4200, HIST*4220, HIST*4230, HIST*4250, HIST*4270, HIST*4280, HIST*4450, HIST*4470, HIST*4580, HIST*4620, HIST*4700, HIST*4820, HIST*4970, HORT*2450, HORT*3010, HORT*3050, HORT*3150, HORT*3270, HORT*3280, HORT*3310, HORT*3430, HORT*3510, HORT*4200, HORT*4300, HORT*4380, HORT*4420, HORT*4450, HTM*2030, HTM*2070, HTM*2740, HTM*3030, HTM*3060, HTM*3080, HTM*3090, HTM*3120, HTM*3160, HTM*3180, HTM*3780, HTM*4050, HTM*4060, HTM*4080")
        .should("have.value", "HIST*4030, HIST*4040, HIST*4070, HIST*4080, HIST*4100, HIST*4120, HIST*4140, HIST*4160, HIST*4170, HIST*4180, HIST*4200, HIST*4220, HIST*4230, HIST*4250, HIST*4270, HIST*4280, HIST*4450, HIST*4470, HIST*4580, HIST*4620, HIST*4700, HIST*4820, HIST*4970, HORT*2450, HORT*3010, HORT*3050, HORT*3150, HORT*3270, HORT*3280, HORT*3310, HORT*3430, HORT*3510, HORT*4200, HORT*4300, HORT*4380, HORT*4420, HORT*4450, HTM*2030, HTM*2070, HTM*2740, HTM*3030, HTM*3060, HTM*3080, HTM*3090, HTM*3120, HTM*3160, HTM*3180, HTM*3780, HTM*4050, HTM*4060, HTM*4080");
  
      // click the button with id "btnSubmit"
      cy.get("#btnSubmit1").click();
  
      // assert that the div with id "eligible-courses" contains the specified text
      cy.get("#eligible-courses")
        .should("include.text", "MGMT*3030");
    });
 });

 describe("Tests on iPad Mini", () => {
   it("should check eligibility for 2nd year CS courses", () => {
      cy.viewport('ipad-mini');
     // visit the webpage where the textarea, button, and result are located
     cy.visit("/calculator");
 
     // type "CIS*1910" into the textarea with id "input-text-box"
     cy.get("#input-text-box")
       .type("CIS*1910, CIS*1300, MATH*1200, CIS*2500, CIS*2910, MATH*1160")
       .should("have.value", "CIS*1910, CIS*1300, MATH*1200, CIS*2500, CIS*2910, MATH*1160");
 
     // click the button with id "btnSubmit"
     cy.get("#btnSubmit").click();
 
     // assert that the div with id "eligible-courses" contains the specified text
     cy.get("#eligible-courses")
       .should("include.text", "CIS*2030")
       .should("include.text", "CIS*2430")
       .should("include.text", "CIS*2520");
   });

   it("should check requirement for credits in a certain department", () => {
      // visit the webpage where the textarea, button, and result are located
      cy.viewport('ipad-mini');
      cy.visit("/calculator");
  
      // type "CIS*1910" into the textarea with id "input-text-box"
      cy.get("#input-text-box")
        .type("MATH*1160, STAT*2040")
        .should("have.value", "MATH*1160, STAT*2040");
  
      // click the button with id "btnSubmit"
      cy.get("#btnSubmit").click();
  
      // assert that the div with id "eligible-courses" contains the specified text
      cy.get("#eligible-courses")
        .should("include.text", "MATH*3240");
    });

    it("should check requirement for total number of credits", () => {
      // visit the webpage where the textarea, button, and result are located
      cy.viewport('ipad-mini');
      cy.visit("/calculator");
  
      // type "CIS*1910" into the textarea with id "input-text-box"
      cy.get("#input-text-box")
        .type("HIST*4030, HIST*4040, HIST*4070, HIST*4080, HIST*4100, HIST*4120, HIST*4140, HIST*4160, HIST*4170, HIST*4180, HIST*4200, HIST*4220, HIST*4230, HIST*4250, HIST*4270, HIST*4280, HIST*4450, HIST*4470, HIST*4580, HIST*4620, HIST*4700, HIST*4820, HIST*4970, HORT*2450, HORT*3010, HORT*3050, HORT*3150, HORT*3270, HORT*3280, HORT*3310, HORT*3430, HORT*3510, HORT*4200, HORT*4300, HORT*4380, HORT*4420, HORT*4450, HTM*2030, HTM*2070, HTM*2740, HTM*3030, HTM*3060, HTM*3080, HTM*3090, HTM*3120, HTM*3160, HTM*3180, HTM*3780, HTM*4050, HTM*4060, HTM*4080")
        .should("have.value", "HIST*4030, HIST*4040, HIST*4070, HIST*4080, HIST*4100, HIST*4120, HIST*4140, HIST*4160, HIST*4170, HIST*4180, HIST*4200, HIST*4220, HIST*4230, HIST*4250, HIST*4270, HIST*4280, HIST*4450, HIST*4470, HIST*4580, HIST*4620, HIST*4700, HIST*4820, HIST*4970, HORT*2450, HORT*3010, HORT*3050, HORT*3150, HORT*3270, HORT*3280, HORT*3310, HORT*3430, HORT*3510, HORT*4200, HORT*4300, HORT*4380, HORT*4420, HORT*4450, HTM*2030, HTM*2070, HTM*2740, HTM*3030, HTM*3060, HTM*3080, HTM*3090, HTM*3120, HTM*3160, HTM*3180, HTM*3780, HTM*4050, HTM*4060, HTM*4080");
  
      // click the button with id "btnSubmit"
      cy.get("#btnSubmit").click();
  
      // assert that the div with id "eligible-courses" contains the specified text
      cy.get("#eligible-courses")
        .should("include.text", "MGMT*3030");
    });
 });

