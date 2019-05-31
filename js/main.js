$('.toggle').click(function(){
  $('.formulario').animate({
    height:"toggle",
    'padding-top':'toggle',
    'padding-bottom':'toggle',
    opacity:'toggle'
  },  "slow");
});

function mostrarMensaje() {
  var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
