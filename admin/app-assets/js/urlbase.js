const urlbaseprod     = "laposta2021.herokuapp.com";
const urlbaseproddev  = "develop.zzz.com";
const urlbasedev      = "laposta.local";
const urlbasedevlocal = "laposta.local";
//const urlbasedev      = "localhost";
//const urlbasedevlocal = "localhost";

//var usourl = window.location.hostname == urlbase: ? urlbase : urldev;
var usourl;

switch (window.location.hostname) {
    case urlbaseprod:
        usourl = document.location.protocol + '//' + urlbaseprod + '/admin';
    break;    
    case urlbaseproddev:
        usourl = document.location.protocol + '//' + urlbaseproddev + '/admin';
    break;    
    case urlbasedev:
        usourl = document.location.protocol + '//' + urlbasedev + '/admin'; ;
    break;    
    default:
        usourl = document.location.protocol + '//' + urlbasedevlocal + '/admin';;
        break;
}
