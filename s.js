function grades(z)
{
  let p;
  if(z>=90 && z<101){
  p= 10;}
  if(z>=80 && z<=89){
    p= 9;}
  if(z>=70 && z<=79){
  p= 8;}
  if(z>=60 && z<=69){
    p= 7;}
  if(z>=50 && z<=59){
    p= 6;}
  if(z>=40 && z<=49){
    p= 5;}
  if(z>=30 && z<=39){
    p= 4;}
  if(z>=20 && z<=29){
    p=3;}
  if(z>=10 && z<=19){
    p= 2;}
  if(z>=0 && z<=9){
    p= 1;}
    return p;
};
// Function for calculating grades
const calculate = () => {
  
    // Getting input from user into height variable.
    let a= document.querySelector("#a").value;
    let b = document.querySelector("#b").value;
    let c = document.querySelector("#c").value;
    let d = document.querySelector("#d").value;
    let e = document.querySelector("#e").value;
    let aa= document.querySelector("#aa").value;
    let bb = document.querySelector("#bb").value;
    let cc = document.querySelector("#cc").value;
    let dd = document.querySelector("#dd").value;
    let ee = document.querySelector("#ee").value;
    let aaa=grades(parseFloat(a));
    let bbb=grades(parseFloat(b));
    let ccc=grades(parseFloat(c));
    let ddd=grades(parseFloat(d));
    let eee=grades(parseFloat(e));
    let sum=(parseFloat(a)+parseFloat(b)+parseFloat(c)+parseFloat(d)+parseFloat(e));
    let cgpa;
    let tc;
    let s;
    tc=(parseFloat(aa)+parseFloat(bb)+parseFloat(cc)+parseFloat(dd)+parseFloat(ee));
    s=((parseFloat(aa)*aaa)+(parseFloat(bb)*bbb)+(parseFloat(cc)*ccc)+(parseFloat(dd)*ddd)+(parseFloat(ee)*eee));
    cgpa=s/tc;
    

    // Checking the values are empty if empty than
    // show please fill them
    if (a == "" || b == "" || c == "" || d == ""|| e == "" || aa == "" || bb == "" || cc == "" || dd == ""|| ee == "") {
      document.querySelector("#showdata").innerHTML
           = "Please enter all the fields";
    } else {
    
      // Checking the condition for the fail and pass
      if (cgpa >= 6) {
        document.querySelector(
          "#showdata"
        ).innerHTML = 
          ` Your total marks are ${sum}.<br>
          Your CGPA is ${cgpa}.<br> You are Pass. `;
      } else {
        document.querySelector(
          "#showdata"
        ).innerHTML = 
        ` Your total marks are ${sum}.<br>
        Your CGPA is ${cgpa}.<br> You are Fail. `;
      }
    }
  };