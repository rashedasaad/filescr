const sleep = async (dlay:number) => {
    return await new Promise(r => setTimeout(() => r(true), dlay))
};


document.getElementById("cards")!.onmousemove = (e) => {
    
for (const box of document.querySelectorAll(".box") as any) {
    const rect = box.getBoundingClientRect(),
        x = e.clientX - rect.left,
        y = e.clientY - rect.top
        

        box.style.setProperty("--mouse-x", `${x}px`);
        box.style.setProperty("--mouse-y", `${y}px`);
    };
};

/*
const sear  = document.querySelector(".sear") as HTMLInputElement;
const clear  = document.querySelector(".clear") as HTMLInputElement;

sear!.onclick = function(){
    document.querySelector(".search")!.classList.toggle('active');
};

clear!.onclick = function(){
    (document.getElementById("Search") as HTMLInputElement)!.value = "";
};

const sear1 = document.querySelector(".sear1") as HTMLInputElement;
const clear1= document.querySelector(".clear1") as HTMLInputElement;

sear1!.onclick = function(){
    document.querySelector(".search1")!.classList.toggle('active');
};

clear1!.onclick = function(){
    (document.getElementById("Search1") as HTMLInputElement)!.value = ""
};
*/



let yesOrNo = document.querySelectorAll(".yesOrNo");
let card_Delete = document.querySelector(".card_Delete") as HTMLDivElement;
let no_Poppap = document.querySelector(".no_Poppap") as HTMLDivElement;
const del = document.getElementById("delete") as HTMLInputElement;

yesOrNo.forEach((element) => {
    var myelement = element as HTMLInputElement;


    myelement!.onclick = async () => {
        card_Delete.style.transition = "all 0.6s ease 0s"
        card_Delete.style.opacity = "0"
        
        await sleep(100);
        card_Delete.style.opacity = "1"
        card_Delete.style.transition = "all 0.6s ease 0s"
        card_Delete.style.display = "block"
      
        del.value = myelement.value
        if (card_Delete.style.display == "block") {
            no_Poppap!.onclick = () => {
                card_Delete.style.display = "none";
            }
        }
    }
});