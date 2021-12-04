const urlbaseprod     = "adminvveracruz-webapp2.herokuapp.com";
const urlbaseproddev  = "develop.zzz.com";
const urlbasedev      = "adminvveracruz-webapp.local";
const urlbasedevlocal = "adminvveracruz-webapp.local";
//const urlbasedev      = "localhost";
//const urlbasedevlocal = "localhost";

//var usourl = window.location.hostname == urlbase  ? urlbase : urldev;
var usourl;
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
