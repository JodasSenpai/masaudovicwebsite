$(document).ready(function(){
	// Mobile menu hide/show
	$("#burgermenu").on('click touch', function (e) {
		e.stopPropagation();
		$("#leftmenu").toggleClass("active");
	});
	
	// Close menu when clicking outside
	$(document).on('click touchstart', function(e) {
		// Only close if menu is open and click is outside menu and burger icon
		if ($("#leftmenu").hasClass("active")) {
			if (!$(e.target).closest('#leftmenu, #burgermenu').length) {
				$("#leftmenu").removeClass("active");
			}
		}
	});
	
	// Prevent menu from closing when clicking inside it
	$("#leftmenu").on('click touchstart', function(e) {
		e.stopPropagation();
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