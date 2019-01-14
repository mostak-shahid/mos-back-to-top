jQuery(document).ready(function($) {
  $(window).load(function(){
    $('.mos-btt-wrapper .tab-con').hide();
    $('.mos-btt-wrapper .tab-con.active').show();
  });

  $('.mos-btt-wrapper .tab-nav > a').click(function(event) {
    event.preventDefault();
    var id = $(this).data('id');

    set_mos_btt_cookie('plugin_active_tab',id,1);
    $('#mos-btt-'+id).addClass('active').show();
    $('#mos-btt-'+id).siblings('div').removeClass('active').hide();

    $(this).closest('.tab-nav').addClass('active');
    $(this).closest('.tab-nav').siblings().removeClass('active');
  });
  $('.dropdown-toggle').click(function(event) {
    event.preventDefault();
    $(this).siblings('.dropdown-menu').toggle();
  });
  $('.iconpicker-item').click(function(){
    var value = $(this).data('value');
    //alert(value);
    $('.iconpicker-component').siblings('input').val(value);
    $('.iconpicker-component > i').removeAttr("class").addClass(value);
    $(this).closest('.dropdown-menu').hide();
  });
});
