
function soloLetras(e) {
    
    var letra = e.keyCode;
    console.log(letra);
    if ((letra > 64 && letra < 91) || (letra > 96 && letra < 123) || (letra === 8) || (letra === 32) || (letra === 9) || (letra === 164) || (letra === 192)) {
        return true;
    } else {
        return false;
    }

}