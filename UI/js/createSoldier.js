$(document).ready(function() {

    $("#fSoldier").submit(function () {
        var countryid = $("#dropdownCountry :selected").val();
        $("#fSoldier").append("<input type='hidden' name='country' value=" + countryid + ">");
        var gunId = $("#dropdownGun :selected").val();
        $("#fSoldier").append("<input type='hidden' name='gun' value=" + gunId + ">");
        var armourid = $("#dropdownArmour :selected").val();
        $("#fSoldier").append("<input type='hidden' name='armour' value=" + armourid + ">");
        var helmetid = $("#dropdownHelmet :selected").val();
        $("#fSoldier").append("<input type='hidden' name='helmet' value=" + helmetid + ">");
    })

}