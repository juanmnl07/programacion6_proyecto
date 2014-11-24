$(document).ready(function() {
  var menu = $('#navigation-menu');
  var menuToggle = $('#js-mobile-menu');
  var signUp = $('.sign-up');

  $(menuToggle).on('click', function(e) {
    e.preventDefault();
    menu.slideToggle(function(){
      if(menu.is(':hidden')) {
        menu.removeAttr('style');
      }
    });
  });

  // underline under the active nav item
  $(".nav .nav-link").click(function() {
    $(".nav .nav-link").each(function() {
      $(this).removeClass("active-nav-item");
    });
    $(this).addClass("active-nav-item");
    $(".nav .more").removeClass("active-nav-item");
  });

  //tabs del formulario de inicio de sesion y registro
  $('.accordion-tabs-minimal').each(function(index) {
    $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
  });

  $('.accordion-tabs-minimal').on('click', 'li > a', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $(this).closest('.accordion-tabs-minimal')
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      $(this).next().toggleClass('is-open').toggle();
      accordionTabs.find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });

  //Funcionalidad off-canvas menu administrativo
  $('.js-menu-trigger').on('click touchstart', function(e){
    $('.js-menu').toggleClass('is-visible');
    $('.js-menu-screen').toggleClass('is-visible');
    e.preventDefault();
  });

  $('.js-menu-screen').on('click touchstart', function(e){
    $('.js-menu').toggleClass('is-visible');
    $('.js-menu-screen').toggleClass('is-visible');
    e.preventDefault();
  });


  //FUNCIONALIDAD TABS (CONTENIDO DASHBOARD)
  $('.accordion-tabs-minimal').each(function(index) {
    $(this).children('li').first().children('a').addClass('is-active').next().addClass('is-open').show();
  });

  $('.accordion-tabs-minimal').on('click', 'li > a', function(event) {
    if (!$(this).hasClass('is-active')) {
      event.preventDefault();
      var accordionTabs = $(this).closest('.accordion-tabs-minimal')
      accordionTabs.find('.is-open').removeClass('is-open').hide();

      $(this).next().toggleClass('is-open').toggle();
      accordionTabs.find('.is-active').removeClass('is-active');
      $(this).addClass('is-active');
    } else {
      event.preventDefault();
    }
  });

//handler formulario mantenimiento de cabanas
  $("#agregar-cabana").submit(function(e){
    e.preventDefault();

      var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: 'agregar_cabana',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);

                var datajson = JSON.parse(data);

                $("table#registro-cabanas").append('<tr id="paquete-cod-'+datajson.cod+'"><td class="cod-paquete">'+datajson.cod+'</td><td><button id="'+datajson.cod+'" class="modificar-paquete">modificar</button><button id="'+datajson.cod+'" class="eliminar-paquete">Eliminar</button></td></tr>');
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });

  });

  //handler formulario mantenimiento de paquetes
  $("#agregar-paquete").submit(function(event){
    event.preventDefault();

    var cod_cabana = event.target[0]['value'];
    var fecha_ingreso = event.target[1]['value'];
    var fecha_salida = event.target[2]['value'];
    var estado = event.target[3]['value'];
    var costo = event.target[4]['value'];

        console.log(costo);

    $.post( "agregar_paquete", { codigo_cabana: cod_cabana, fecha_ing: fecha_ingreso, fecha_sal: fecha_salida, est: estado, id_costo: costo})
      .done(function( data ) {
      alert( "Mensaje: " + data.mensaje);
    });

  });

  //handler para cuando el usuario seleccina la opcion de eliminar registros
  //cabana
  $(".eliminar-cabana").click(function(){
    var cod_cabana = $(this).attr("id");
    $.post( "eliminar_cabana", { cod: cod_cabana})
      .done(function( data ) {
      alert( "Mensaje: " + data );

      //eliminamos el elemento dentro del listado
      $('#cabana-cod-'+cod_cabana).fadeOut(300, function(){ $(this).remove();});

    });
  });

  //paquete
  $(".eliminar-paquete").click(function(){
    var cod_paquete = $(this).attr("id");
    $.post( "eliminar_paquete", { cod: cod_paquete})
      .done(function( data ) {
      alert( "Mensaje: " + data );

      //eliminamos el elemento dentro del listado
      $('#paquete-cod-'+cod_paquete).fadeOut(300, function(){ $(this).remove();});

    });
  });

}); 