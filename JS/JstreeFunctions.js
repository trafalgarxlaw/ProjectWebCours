
$(document).ready(function () {
//create event listner
document.getElementById('AdminBtn').addEventListener('click', AjaxCall);
document.getElementById('DeleteBtn').addEventListener('click', RemoveTree);

});
//Classes
class Membres {


    constructor(id, parent, text, icon) {
        this.id = id;
        this.parent = parent;
        this.text = text;
        this.icon = icon;
    }
    //setters
    set_id(id) {
        this.id = id;
    }
    set_parent(parent) {
        this.parent = parent;
    }
    set_text(text) {
        this.text = text;
    }
    set_icon(icon) {
        this.icon = icon;
    }

    //getters
    get_id() {
        return this.id;
    }
    get_parent() {
        return this.parent;
    }
    get_text() {
        return this.text;
    }
    get_icon() {
        return this.icon;
    }
}

function CreateMembersArray(jsonData) {
    var JsonLenght = Object.keys(jsonData).length;

    var member = new Membres();
    var memebers = new Array();

    //Addinc Default members tot he array.

    //Creating the member object racines
    var racine1 = new Membres("CADRE", "#", "Cadres du syndicat", "x");
    var racine2 = new Membres("DELEGUE", "#", "Délégués syndicauxt", "x");
    var racine3 = new Membres("MEMBRE", "#", "Simples membres", "x");

    //Adding the member in the Members Array
    memebers.push(racine1);
    memebers.push(racine2);
    memebers.push(racine3);


    //Adding the rest from the json object
    for (let i = 0; i < JsonLenght; i++) {

        //Creating the member object from the json file
        var member = new Membres(i, jsonData[i]['fonction'], jsonData[i]['prenom'] + ' ' + jsonData[i]['nom'], jsonData[i]['photo']);

        //Adding the member in the Members Array
        memebers.push(member);


    }


    JsonMemebers = JSON.stringify(memebers);
    JsonMembersParsed = JSON.parse(JsonMemebers);

    return JsonMembersParsed;
}


function createJSTree(jsonData) {

    $('#jstree').jstree({
        'core': {
            'data':
                jsonData
        }
    });
}

//Loading the json object with ajax
function loadDoc() {
    var jsonData;
    //Ajax call
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            jsonData = this.responseText;
        }
    };
    xhttp.open("GET", "PHP/organigramme.php", false);
    xhttp.send();

    response = JSON.parse(jsonData);
    return response;
}

// Executed when we click on organigramme.php 
function AjaxCall() {

    //loading the json passed from organigramme.php
    var jsonData = loadDoc();
    console.log(jsonData);
    //Initialisation of the js tree
    InitializeTree(jsonData);
}

//Creaction of a JStree using JSON
function InitializeTree(jsonData) {
    //Hidden elements control
    document.getElementById("hiddenDiv").hidden = false;
    document.getElementById("AdminBtn").hidden = true;
    document.getElementById("DeleteBtn").hidden = false;

    //Starting initialisation
    $(document).ready(function () {
        document.getElementById('jstree_title').innerHTML = "Voici l’arborescence de l’organigramme du syndicat";
        var JsonMemebers = CreateMembersArray(jsonData);
        createJSTree(JsonMemebers);
    });
}



//Removes the jstree from the page
function RemoveTree() {
    document.getElementById("AdminBtn").hidden = false;
    document.getElementById("DeleteBtn").hidden = true;
    document.getElementById("hiddenDiv").hidden = true;
}



