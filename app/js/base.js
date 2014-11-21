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
  $("#agregar-cabana").submit(function(event){
    event.preventDefault();

    var codigo = event.target[0]['value'];
    var capacidad_adultos = event.target[1]['value'];
    var capacidad_ninos = event.target[2]['value'];

    //verificar los datos del tamano
    if(event.target[3]['checked'] == true){
      var tamano = event.target[3]['value'];
    }     
    
    if(event.target[4]['checked'] == true){
      var tamano = event.target[4]['value'];
    }

    if(event.target[5]['checked'] == true){
      var tamano = event.target[5]['value'];
    } 

    if(event.target[6]['checked'] == true){
      var aire_acondicionado = event.target[6]['value'];
    } 

    if(event.target[7]['checked'] == true){
      var aire_acondicionado = event.target[7]['value'];
    } 

    if(event.target[8]['checked'] == true){
      var calefaccion = event.target[8]['value'];
    } 

    if(event.target[9]['checked'] == true){
      var calefaccion = event.target[9]['value'];
    } 

    var descripcion = event.target[10]['value'];
    var file = event.target[11]['value'];

    $.post( "agregar_cabana", { cod: codigo, cap_adultos: capacidad_adultos, cap_ninos: capacidad_ninos, tam: tamano, aire_acond: aire_acondicionado, calef:calefaccion, desc: descripcion})
      .done(function( data ) {
      var datajson = JSON.parse(data);
      alert( "Mensaje: " + datajson.mensaje );

      //agregamos el regisro en el listado de la tabla
      $("table#registro-cabanas").append('<tr id="paquete-cod-'+datajson.cod+'"><td class="cod-paquete">'+datajson.cod+'</td><td><button id="'+datajson.cod+'" class="modificar-paquete">modificar</button><button id="'+datajson.cod+'" class="eliminar-paquete">Eliminar</button></td></tr>');

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