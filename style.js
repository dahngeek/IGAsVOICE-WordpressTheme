jQuery(document).ready(main);
 
var contador = 1;
 
function main($){
	$('.menu_bar').click(function(){
		if(contador == 1){
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-200%'
			});
		}
 
	});
 
	$('.ir-arriba').click(function(){
		$('body,html').animate({
			scrollTop:'0px'
		}, 300);
	});
	$(window).scroll(function(){
		if($(this).scrollTop() > 0){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
			}
	});
 
 };

window.onload = function() {
 
    function bgadj(){
             
        var element = document.getElementById("bg");
         
        var ratio =  element.width / element.height;   
         
        if ((window.innerWidth / window.innerHeight) < ratio){
         
            element.style.width = 'auto';
            element.style.height = '100%';
             
            <!-- si la imagen es mas ancha que la ventana la centro -->
            if (element.width > window.innerWidth){
             
                var ajuste = (window.innerWidth - element.width)/2;
                 
                element.style.left = ajuste+'px';
             
            }
         
        }
        else{  
         
            element.style.width = '100%';
            element.style.height = 'auto';
            element.style.left = '0';
 
        }
         
    }
<!-- llamo a la función bgadj() por primera vez al terminar de cargar la página -->
    bgadj();
    <!-- vuelvo a llamar a la función  bgadj() al redimensionar la ventana -->
    window.onresize = function() {
        bgadj();
 
    }
 
}	