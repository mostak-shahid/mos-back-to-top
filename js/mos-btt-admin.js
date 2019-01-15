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

  $("button.open-window").live("click", function(e){
    e.preventDefault();
    var imageUploader = wp.media({
      'title'     : 'Upload Image',
      'button'    : {
        'text'  : 'Set the image'
      },
      'multiple'  : false
    });
    imageUploader.open();
    var button = $(this);
    imageUploader.on("select", function(){
      var image = imageUploader.state().get("selection").first().toJSON();
      console.log(image);
      var image_link = image.url;
      $("input.btt_img_url").val(image_link);
      button.siblings('input.btt_img_url').val(image_link);
      button.siblings('input.btt_img_id').val(image.id);
      button.siblings('input.btt_img_width').val(image.width);
      button.siblings('input.btt_img_height').val(image.height);
      button.parent().siblings('div.btt-img-wrapper').find('img').attr('src', image_link);
    })
  });
  $("button.remove-img").live("click", function(d){
    d.preventDefault();
    $(this).siblings('input.btt_img_url').val('');
    $(this).parent().siblings('div.btt-img-wrapper').find('img').attr('src', '');
  })
});
