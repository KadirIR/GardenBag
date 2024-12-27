const bar = document.getElementById("bar");
const nav = document.getElementById("navbar");
const close = document.getElementById("close");
// if(bar){
//     bar.addEventListener("click",()=>{
//         nav.classList.add("active");
//     });
//     close.addEventListener("click",()=>{
//         nav.classList.toggle("active");
//     })

// }
var count = 0;
var like = document.getElementById("like");
like.addEventListener("click", Likes);
function Likes(e) {
  if (count % 2 == 0) {
    like.style.color = "red";
    count++;
  } else {
    like.style.color = "black";
    count++;
  }
  e.preventDefault();
}