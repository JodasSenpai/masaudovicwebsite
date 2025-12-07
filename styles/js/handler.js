$(document).ready(function(){
	// Mobile menu hide/show
	var burger = 0;
	$("#burgermenu").on('click touch', function () {
		if(burger%2==0){
			$("#burgermenu").attr("src","/media/img/menu-2.png");
			$("#leftmenu").animate({left: '5px'});
		}else{
			$("#burgermenu").attr("src","/media/img/menu-1.png");
			$("#leftmenu").animate({left: '-260px'});
		}
		burger++;
	});
	  $(document).on('click touchstart', function(e) {
    // only if menu is currently open
    if (burger % 2 !== 0) {
      // if the click/touch happened outside #leftmenu AND outside the burger icon
      if (!$(e.target).closest('#leftmenu, #burgermenu').length) {
        // run the same “close” code
        $("#burgermenu").attr("src","/media/img/menu-1.png");
        $("#leftmenu").animate({left: '-260px'});
        burger++;
      }
    }
  });
	// Skripta show more za meni
		$(".menielement-vec").on('click touch', function () {
			if($(this).attr( "data-menistatus" )=="zaprt"){
				$(this).attr("data-menistatus","odprt");
				$(this).find( ".triangle" ).text("▾");
				$(this).closest('.menielement').children(".menielement-skrit").slideDown("slow");
			}
			else{
				$(this).attr("data-menistatus","zaprt");
				$(this).find( ".triangle" ).text("▸");
				$(this).closest('.menielement').find(".menielement-skrit").slideUp("slow");
			}
		});
		
});

function formatDateTime(dateString) {
    if (!dateString || dateString === '/' || dateString === '0000-00-00 00:00:00') {
        return '/';
    }
    let dateTimeParts = dateString.split(' ');

    let datePart = dateTimeParts[0];
    let timePart = dateTimeParts[1];

    let dateParts = datePart.split('-');
    let year = dateParts[0];
    let month = dateParts[1];
    let day = dateParts[2];

    let timeParts = timePart.split(':');
    let hours = timeParts[0];
    let minutes = timeParts[1];

    return `${day}.${month}.${year} ${hours}:${minutes}`;
}
function formatDate(dateString) {
    let dateParts = dateString.split('-'); 
    let year = dateParts[0];
    let month = dateParts[1];
    let day = dateParts[2];
    return `${day}.${month}.${year}`;
}