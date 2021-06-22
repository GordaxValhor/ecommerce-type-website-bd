let 
    menu=document.querySelector(".menu");
    menu_button=document.querySelector(".menu-icon");

function start(){
    var ok=0;
}
function showMenu(){
    menu.style.display="block";
}
function hideMenu(){
    menu.style.display="none";
}
var ok=0;
start();
menu_button.addEventListener("click",function(){
    if(ok==0)
        {
            showMenu();
            ok=1;
        }
    else 
    {
        hideMenu();
        ok=0;
    }
  })