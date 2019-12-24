
class ManifestantID {


    constructor(id, lieux, membre, date) {
        this.id = id;
        this.lieux = lieux;
        this.membre = membre;
        this.date = date;
    }
    //setters
    set_nom(nom) {
        this.nom = nom;
    }
    set_prenom(prenom) {
        this.prenom = prenom;
    }
    set_lieu(lieux) {
        this.lieux = lieux;
    }
    set_date(date) {
        this.date = date;
    }

    //getters
    get_id() {
        return this.id;
    }
    get_membre_id() {
        return this.membre;
    }
    get_nom() {
        return this.nom;
    }
    get_prenom() {
        return this.prenom;
    }
    get_lieux_id() {
        return this.lieux;
    }
    get_date() {
        return this.date;
    }
}


class Manifestant {


    constructor(nom, prenom, lieux, date) {
        this.nom = nom;
        this.prenom = prenom;
        this.lieux = lieux;
        this.date = date;
    }
    //setters
    set_nom(nom) {
        this.nom = nom;
    }
    set_prenom(prenom) {
        this.prenom = prenom;
    }
    set_lieu(lieux) {
        this.lieux = lieux;
    }
    set_date(date) {
        this.date = date;
    }

    //getters
    get_id() {
        return this.nom;
    }
    get_membre_id() {
        return this.nom;
    }
    get_nom() {
        return this.nom;
    }
    get_prenom() {
        return this.prenom;
    }
    get_lieux_id() {
        return this.lieux;
    }
    get_date() {
        return this.date;
    }
}

function GenerateTable(Array) {

for (let index = 0; index < Array.length; index++) {

    $('#mytable').DataTable().row.add([
        Array[index]['nom'], Array[index]['prenom'], Array[index]['lieux'],Array[index]['date']
      ]).draw();
    
}

}

function GenerateArrayManifestants(ManifData, LieuxData, MembresData) {

    var manifArrayID = new Array();
    var JsonLenght = Object.keys(ManifData).length;
    console.log('lenght');
    console.log(JsonLenght);

    console.log('data');
    console.log(ManifData);
    console.log(LieuxData);
    console.log(MembresData);


    //Adding Data to an array
    for (let i = 0; i < JsonLenght; i++) {

        //Creating the member object from the json file
        var manifestant = new ManifestantID(ManifData[i]['id'], ManifData[i]['lieux'], ManifData[i]['membre'], ManifData[i]['date']);

        //Adding the member in the Members Array
        manifArrayID.push(manifestant);
    }
    console.log('first array');
    console.log(manifArrayID);

    console.log('test');
    // console.log(MembresData[6]['nom']);

    //collectiong data from Table lieux and Membre
    var manifArray = new Array();
    for (let i = 0; i < JsonLenght; i++) {
        var MembreId = manifArrayID[i].get_membre_id();
        var lieuxId = manifArrayID[i].get_lieux_id();
        var theDate = manifArrayID[i].get_date();
        var MemberName;
        var Memberprenom;
        var lieuxName;

        //search in the member table the name associated with the MemberID
        for (let i = 0; i < Object.keys(MembresData).length; i++) {
            if (MembresData[i]['id'] == MembreId) {
                MemberName = MembresData[i]['nom'];
                Memberprenom = MembresData[i]['prenom']

            }
        }
        //search in the lieux table the name associated with the tableID
        for (let i = 0; i < Object.keys(LieuxData).length; i++) {
            if (LieuxData[i]['id'] == lieuxId) {
                lieuxName = LieuxData[i]['nom'];
            }
        }

        //Creating the member object from the json file
        var manifestant = new Manifestant(MemberName, Memberprenom, lieuxName, theDate);

        //Adding the member in the Members Array
        manifArray.push(manifestant);
    }
    console.log(manifArray);

    return manifArray;


}


$(document).ready(function () {
    //catching the data
    var jsonDataManif = ManifData;
    var jsonDatalieux = LieuxData;
    var jsonDataMembres = MembresData;

    var ArryManifestants =  GenerateArrayManifestants(ManifData, LieuxData, MembresData);

    GenerateTable(ArryManifestants);

   
});

