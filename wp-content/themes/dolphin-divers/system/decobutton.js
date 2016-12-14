var DECOBUTTON = new Array();
DECOBUTTON[0] = new Array('<span style="color:#000000">','</span>');
DECOBUTTON[1] = new Array('<span style="color:#808080">','</span>');
DECOBUTTON[2] = new Array('<span style="color:#c0c0c0">','</span>');
DECOBUTTON[3] = new Array('<span style="color:#800000">','</span>');
DECOBUTTON[4] = new Array('<span style="color:#ff0000">','</span>');
DECOBUTTON[5] = new Array('<span style="color:#808000">','</span>');
DECOBUTTON[6] = new Array('<span style="color:#ECCC91">','</span>');
DECOBUTTON[7] = new Array('<span style="color:#008000">','</span>');
DECOBUTTON[8] = new Array('<span style="color:#00ff00">','</span>');
DECOBUTTON[9] = new Array('<span style="color:#008080">','</span>');
DECOBUTTON[10] = new Array('<span style="color:#00ffff">','</span>');
DECOBUTTON[11] = new Array('<span style="color:#000080">','</span>');
DECOBUTTON[12] = new Array('<span style="color:#800080">','</span>');
DECOBUTTON[13] = new Array('<span style="color:#ff00ff">','</span>');
DECOBUTTON[14] = new Array('<span style="color:#0000ff">','</span>');
DECOBUTTON[15] = new Array('<span style="color:#FF6600">','</span>');

DECOBUTTON[16] = new Array('<span style="font-size:50%;">','</span>');
DECOBUTTON[17] = new Array('<span style="font-size:65%;">','</span>');
DECOBUTTON[18] = new Array('<span style="font-size:80%;">','</span>');
DECOBUTTON[19] = new Array('<span style="font-size:120%;">','</span>');
DECOBUTTON[20] = new Array('<span style="font-size:135%;">','</span>');
DECOBUTTON[21] = new Array('<span style="font-size:150%;">','</span>');
DECOBUTTON[22] = new Array('<span style="font-style:italic;">','</span>');
DECOBUTTON[23] = new Array('<span style="font-weight:bold;">','</span>');

var UNDOTEMP = "";

window.onload = function() {
timerID = setTimeout("decobuttonpreview()",200);
document.getElementById(targetobj).value = window.opener.document.getElementById(sourceobj).value;
}
function decobuttonpreview() {
var vv = document.getElementById(targetobj).value;
var str = vv.replace(/\n/g,"<br>");
document.getElementById('decobuttonpreview').innerHTML = str;
setTimeout("decobuttonpreview()",200);
}

function decobuttontagreset() {
var target = document.getElementById(targetobj);
var pos = getAreaRange(target);
if(pos.start == pos.end){return;}
var target = document.getElementById(targetobj);
var pos = getAreaRange(target);
var val = target.value;
UNDOTEMP = val;
var str = val.slice(pos.start, pos.end);
var range = str.replace(/<\/?[^>]+>/gi, "");
var beforeNode = val.slice(0, pos.start);
var afterNode  = val.slice(pos.end);
var insertNode;

if (range || pos.start != pos.end) {
insertNode = range;
target.value = beforeNode + insertNode + afterNode;
}else if (pos.start == pos.end) {
insertNode = "";
target.value = beforeNode + insertNode + afterNode;
}
decobuttonpreview();
}	// func


function decobuttontagresetall() {
UNDOTEMP = document.getElementById(targetobj).value;
var vv = document.getElementById(targetobj).value;
var str = vv.replace(/<\/?[^>]+>/gi, "");
document.getElementById(targetobj).value = str;
decobuttonpreview();
}	// func




// <![CDATA[
function decobuttonsurroundHTML(codeno) {
tag = DECOBUTTON[codeno][0];
tagend = DECOBUTTON[codeno][1];
var target = document.getElementById(targetobj);
var pos = getAreaRange(target);
if(pos.start == pos.end){return;}
var val = target.value;
UNDOTEMP = val;	// UNDO
var range = val.slice(pos.start, pos.end);
var beforeNode = val.slice(0, pos.start);
var afterNode  = val.slice(pos.end);
var insertNode;

if (range || pos.start != pos.end) {
insertNode = tag + range + tagend;
target.value = beforeNode + insertNode + afterNode;
}else if (pos.start == pos.end) {
insertNode = tag + tagend ;
target.value = beforeNode + insertNode + afterNode;
}
}

function decobuttonundo() {
document.getElementById(targetobj).value = UNDOTEMP;
}	//func

function getAreaRange(obj) {
	var pos = new Object();
	
	if (isIE) {
		obj.focus();
		var range = document.selection.createRange();
		var clone = range.duplicate();
		
		clone.moveToElementText(obj);
		clone.setEndPoint( 'EndToEnd', range );

		pos.start = clone.text.length - range.text.length;
		pos.end   = clone.text.length - range.text.length + range.text.length;
  	}

	else if(window.getSelection()) {
		pos.start = obj.selectionStart;
		pos.end   = obj.selectionEnd;
	}

	return pos;
}
var isIE = (navigator.appName.toLowerCase().indexOf('internet explorer')+1?1:0);
// ]]>

function decobuttonhelp(){
window.open("decobuttonhelp.html","decobuttonhelp","width=610,height=320,directories=no,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no,top=0,left=10");

}



document.write('\
<img src="img/decobutton.jpg" width="840" height="40" border="0" usemap="#Map" />\
<map name="Map" id="Map">\
<!-- system -->\
<area shape="rect" coords="653,12,704,37" href="javascript:void(0)" onClick="decobuttontagreset()"  />\
<area shape="rect" coords="704,12,757,37" href="javascript:void(0)" onClick="decobuttontagresetall()" />\
<area shape="rect" coords="759,13,809,37" href="javascript:void(0)" onClick="decobuttonundo()" />\
<area shape="rect" coords="812,13,836,37" href="javascript:void(0)" onclick="decobuttonhelp()" />\
<!-- color -->\
<area shape="rect" coords="3,12,27,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(0);" />\
<area shape="rect" coords="30,12,54,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(1);" />\
<area shape="rect" coords="59,12,83,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(2);" />\
<area shape="rect" coords="87,12,111,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(3);" />\
<area shape="rect" coords="114,12,138,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(4);" />\
<area shape="rect" coords="141,12,166,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(5);" />\
<area shape="rect" coords="169,12,194,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(6);" />\
<area shape="rect" coords="197,12,222,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(7);" />\
<area shape="rect" coords="225,12,250,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(8);" />\
<area shape="rect" coords="254,12,277,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(9);" />\
<area shape="rect" coords="282,12,306,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(10);" />\
<area shape="rect" coords="310,12,334,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(11);" />\
<area shape="rect" coords="338,12,362,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(12);" />\
<area shape="rect" coords="366,12,390,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(13);" />\
<area shape="rect" coords="393,12,418,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(14);" />\
<area shape="rect" coords="421,12,446,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(15);" />\
<!-- deco -->\
<area shape="rect" coords="448,12,473,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(16);" />\
<area shape="rect" coords="474,12,499,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(17);" />\
<area shape="rect" coords="499,12,523,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(18);" />\
<area shape="rect" coords="524,12,548,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(19);" />\
<area shape="rect" coords="549,12,573,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(20);" />\
<area shape="rect" coords="574,12,599,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(21);" />\
<area shape="rect" coords="600,12,625,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(22);" />\
<area shape="rect" coords="626,12,651,36" href="javascript:void(0)" onClick="decobuttonsurroundHTML(23);" />\
</map>\
');