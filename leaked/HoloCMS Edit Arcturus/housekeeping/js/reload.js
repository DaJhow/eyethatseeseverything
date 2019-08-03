$(document).ready(function() {
$.ajaxSetup({ cache: false });
setInterval(function() {
$('#inscrit').load('./stats.php?s=1');
}, 5000);
setInterval(function() {
$('#ban').load('./stats.php?s=2');
}, 5000);
setInterval(function() {
$('#visites').load('./stats.php?s=3');
}, 5000);
setInterval(function() {
$('#online').load('./stats.php?s=4');
}, 5000);
setInterval(function() {
$('#record').load('./stats.php?s=5');
}, 5000);
setInterval(function() {
$('#progress-inscrit').load('./stats.php?progress=inscrit');
}, 5000);
setInterval(function() {
$('#progress-online').load('./stats.php?progress=online');
}, 5000);
setInterval(function() {
$('#progress-visites').load('./stats.php?progress=visite');
}, 5000);
setInterval(function() {
$('#progress-record').load('./stats.php?progress=record');
}, 5000);
});