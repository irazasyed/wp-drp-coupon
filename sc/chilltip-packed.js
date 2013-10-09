/*	ChillTip Version 1.2 - jQuery PlugIn Packed	by Christopher Hill - (http://www.chillwebdesigns.co.uk/) Last Modification: 25/12/10
	For more information, visit: (http://www.chillwebdesigns.co.uk/chilltip.html)
	Licensed under the Creative Commons Attribution 3.0 Unported License - http://creativecommons.org/licenses/by/3.0/
	- Free for use in both personal and commercial projects
	- Attribution requires leaving author name, author link, and the license info intact */
	
	// Settings for modification.													.
	ChillTipClassName	= "ChillTip"; // Name of Class Used in the html
	ChillTipColor 		= "#000"; 	  // ChillTip background color in hex		
	ChillTipBorderColor = "#333"; 	  // ChillTip border colour in hex
	ChillTipBorderWidth	= "2"; 		  // ChillTip border size in pixels
	ChillTipTextColor	= "#fff"; 	  // ChillTip main font colour in hex		
	ChillTipTextSize	= "11"; 	  // ChillTip content text size in pixels
	ChillTipTextPadding	= "10"; 	  // ChillTip text padding size in pixels
	ChillTipOpacity 	= "90"; 	  // ChillTip opacity in % (0-100)	
	ChillTipWidth		= "250"; 	  // Maximum width of ChillTip in pixels	
	ChillTipFadeTime	= 250; 		  // ChillTip fade in time in milliseconds
	ChillTipTopOffset 	= 15; 		  // ChillTip mouse top offset in pixels
	ChillTipRightOffset = 15; 		  // ChillTip mouse right offset in pixels
	ChillTipTextFont	= "Arial, Helvetica, sans-serif"; // ChillTip content font family
	
	// The colors below can be changed to get the colour you desire
	ColorOne			= "#0033ff";  // This is color Blue in hex
	ColorTwo			= "#ff00cc";  // This is color Pink in hex
	ColorThree			= "#33cc00";  // This is color Green in hex
	ColorFour			= "#9900ff";  // This is color purple in hex	
	ColorFive			= "#ff0000";  // This is color Red in hex
	ColorSix			= "#ffff00";  // This is color Yellow in hex	

(function($){$(function(){eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$.10.11=d(){5.Z(d(){4 8=5.8;a($(5).E(\'8\')!=\'\'&&$(5).E(\'8\')!=\'Y\'){5.8=\'\';$(5).V(d(){$(\'W\').X(\'<w 12="1"><p>\'+8+\'</p></w>\');$(\'#1\').3({19:1a,18:17+\'f 14\',15:16,1b:\'H\',I:J,y:\'g\',K:\'G\',T:n+\'f\',R:\'S\',9:\'g\',Q:\'P\'});$(\'#1 p\').3({7:M,L:\'z\',N:O+\'f\',13:\'0\',1h:1w+\'f\',1x:\'1v\',9:\'g\'});$(\'#1 p b.1u\').3({7:1s});$(\'#1 p b.1t\').3({7:1z});$(\'#1 p b.1C\').3({7:1E});$(\'#1 p b.1D\').3({7:1c});$(\'#1 p b.1A\').3({7:1B});$(\'#1 p b.1y\').3({7:1r});a($.x.1i&&$.x.1g<=6){4 v=$(\'#1\').9();a(v>n){$(\'#1\').3({9:n})}}a(c==\'1f\'){$(\'#1\').t(s)}q{$(\'#1\').3({1d:\'1e(u=c)\',1j:\'0.\'+c,1k:\'0.\'+c,u:\'0.\'+c}).t(s)}},d(){$(\'#1\').1p()})}}).3({1o:\'1n\'});4 l=$(D).1l();4 j=$(D).9();4 k=$(\'#1\').9();4 m=$(\'#1\').y();5.1m(d(e){a(j-(h*2)>=k+e.C){o=e.C+h}q{o=j-k-h}a(l+(r*2)>=e.A-m){i=l+r}q{i=e.A-m-r}4 B=o;4 F=i;$(\'#1\').3({z:B,1q:F})});U 5}',62,103,'|chilltip||css|var|this||color|title|width|if|span|ChillTipOpacity|function||px|auto|ChillTipRightOffset|top_pos|borderR|chillW|borderT|chillH|ChillTipWidth|left_pos||else|ChillTipTopOffset|ChillTipFadeTime|fadeIn|opacity|ChillPWidth|div|browser|height|left|pageY|chillL|pageX|window|attr|chillT|10px|none|fontFamily|ChillTipTextFont|minWidth|float|ChillTipTextColor|fontSize|ChillTipTextSize|1001|Zindex|position|absolute|maxWidth|return|hover|body|append|undefined|each|fn|ChillTip|id|margin|solid|borderColor|ChillTipBorderColor|ChillTipBorderWidth|border|background|ChillTipColor|display|ColorFour|filter|alpha|100|version|padding|msie|mozOpacity|khtmlOpacity|scrollTop|mousemove|pointer|cursor|remove|top|ColorSix|ColorOne|two|one|justify|ChillTipTextPadding|textAlign|six|ColorTwo|five|ColorFive|three|four|ColorThree'.split('|'),0,{}))
$('.'+ChillTipClassName).ChillTip();});})(jQuery)