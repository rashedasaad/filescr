const sleep = async (dlay) => {
    return await new Promise(r => setTimeout(() => r(true), dlay))
}




//!

let Icon = document.querySelector(".toggle-settings .settin")
let opens = document.querySelector(".selct_box")
let leftt = document.querySelector(".leftt")
let com = document.querySelector(".com")

let left = true;
let comaa = true;

Icon.onclick = async () => {
    Icon.classList.toggle("fa-spin");
    document.querySelector(".selct_box").classList.toggle("clos");
    opens.style = "transition: ease .7s;"

    if (left) {
        left = false;
        leftt.style = "transition: .7s;left: max(-31vw, -30em);position: relative;"
    } else {
        left = true;
        leftt.style = "transition: .7s;left: 0px;position: relative;"
    };
    if (comaa) {
        comaa = false;
        com.style = "width: max(100vw, 100em);transition: ease .7s;"
    } else {
        comaa = true;
        com.style = "width: max(75vw, 75em);transition: ease .7s;"
    };
};


// ===================

let new_Script = document.querySelector(".albutton #new-script");
let card_new = document.querySelector(".card_new");
let Icon_d = document.querySelector(".Icon_d i");



new_Script.onclick = async () => {

    card_new.style = "transition: all 0.6s ease 0s;opacity: 0;"
    await sleep(100);
    card_new.style = "opacity: 1;transition: all 0.6s ease 0s;display: block;"


    if (card_new !== "block") {
        Icon_d.onclick = () => {
            card_new.style.display = "none";
        }
    }
}


let yesOrNo = document.querySelectorAll(".yesOrNo");
let open_update_actieve = document.querySelector(".open_update_actieve");
let card_Delete = document.querySelector(".card_Delete");
let no_Poppap = document.querySelector("#no_Poppap");
const del = document.getElementById("delete")

yesOrNo.forEach(element => {
    element.onclick = async () => {
        card_Delete.style = "transition: all 0.6s ease 0s;opacity: 0;"
        await sleep(100);
        card_Delete.style = "opacity: 1;transition: all 0.6s ease 0s;display: block;"
        console.log(element);
        del.value = element.value
        if (card_Delete !== "block") {
            no_Poppap.onclick = () => {
                card_Delete.style.display = "none";
            }
        }
    }
});








let update = document.querySelector(".update");
let Icon_update = document.querySelector(".update_cancle");
const yesornom = document.querySelector(".update_yesornom")

let id_active = document.querySelector(".id_active");
let server_name = document.querySelector(".server_name");
let ip_server = document.querySelector(".ip_server");
const discord_id = document.querySelector(".discord_id")

const alldata = document.querySelectorAll(".alldata")
alldata.forEach(element => {

    elm = element.querySelector(".update_yesornom")
    const discordid = element.querySelector(".discordid")
    const servername = element.querySelector(".servername")
    const ipserver = element.querySelector(".ipserver")
    const scriptid = element.querySelector(".scriptid")

    elm.onclick = async () => {
        
        discord_id.value = discordid.textContent;
        server_name.value = servername.textContent;
        ip_server.value = ipserver.textContent;
        id_active.value = scriptid.textContent;

        update.style = "transition: all 0.6s ease 0s;opacity: 0;"
        await sleep(100);
        update.style = "opacity: 1;transition: all 0.6s ease 0s;display: block;"

        if (update.style !== "block") {
            Icon_update.onclick = () => {
                update.style.display = "none";
            }
        }
    }
});







let Icon_script_cancle = document.querySelector(".Icon_script_cancle");

let id_script = document.querySelector(".id_script");
let scriptname = document.querySelector(".script_name");


const alldatascript = document.querySelectorAll(".alldatascript")
alldatascript.forEach(element => {

    elm = element.querySelector(".script_script")
    const script_id = element.querySelector(".script_id")
    const script_name = element.querySelector(".script_name")


    elm.onclick = async () => {
        
        id_script.value = script_id.textContent;
        scriptname.value = script_name.textContent;


        update.style = "transition: all 0.6s ease 0s;opacity: 0;"
        await sleep(100);
        update.style = "opacity: 1;transition: all 0.6s ease 0s;display: block;"

        if (update.style !== "block") {
            Icon_script_cancle.onclick = () => {
                update.style.display = "none";
            }
        }
    }
});