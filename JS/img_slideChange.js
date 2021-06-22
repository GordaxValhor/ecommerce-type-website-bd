
    const nextButton = document.querySelector(".next-button");
    const prevButton = document.querySelector(".prev-button");
    const slides = Array.from(document.querySelector(".slider").children);
    const slider = document.querySelector(".slider");
    var slidenumber = 0;
    var amountToMove = 0;
    nextButton.addEventListener("click", function(){
        for(let i=0;i<slides.length;i++)
        {
            const currentClassname = slides[i].classList[3];
            //console.log(currentClassname);
            if((currentClassname) == 'current-slide'){
               slidenumber = i;
            }
        }
        if(slides[slidenumber].nextElementSibling)
        {
            slides[slidenumber].classList.remove('current-slide');
            slides[slidenumber].nextElementSibling.classList.add('current-slide');
            amountToMove = 320 + amountToMove;
            slider.style.transform = 'translateX(-'+ amountToMove +'px)';
        }
    });
    prevButton.addEventListener("click", function(){
        for(let i=0;i<slides.length;i++)
        {
            const currentClassname = slides[i].classList[3];
            if((currentClassname) == 'current-slide'){
               slidenumber = i;
            }
        }
        if( slides[slidenumber].previousElementSibling){
            slides[slidenumber].classList.remove('current-slide');
            slides[slidenumber].previousElementSibling.classList.add('current-slide');
            amountToMove = amountToMove - 320;
            slider.style.transform = 'translateX(-'+ amountToMove +'px)';
        }
        
    });