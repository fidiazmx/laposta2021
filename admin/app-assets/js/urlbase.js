const urlbaseprod     = "laposta2021.herokuapp.com/admin";
const urlbaseproddev  = "develop.zzz.com";
const urlbasedev      = "laposta.local/admin";
const urlbasedevlocal = "laposta.local/admin";
//const urlbasedev      = "localhost";
//const urlbasedevlocal = "localhost";

//var usourl = window.location.hostname == urlbase  ? urlbase : urldev;
var usourl;
usourl = document.location.protocol + '//' + urlbaseprod
/*
switch (window.location.hostname) {
    case urlbaseprod:
        usourl = document.location.protocol + '//' + urlbaseprod;
    break;    
    case urlbaseproddev:
        usourl = document.location.protocol + '//' + urlbaseproddev;
    break;    
    case urlbasedev:
        usourl = document.location.protocol + '//' + urlbasedev;
    break;    
    default:
        usourl = document.location.protocol + '//' + urlbasedevlocal;
        break;
}
*/