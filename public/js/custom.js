$(document).ready(function(){
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');
    $('[data-bs-toggle="tooltip"]').tooltip();
    $('[data-toggle="minimize"]').on("click", function() {
        if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
          body.toggleClass('sidebar-hidden');
        } else {
          body.toggleClass('sidebar-icon-only');
        }
    });

    $("#fullscreen-button").on("click", function toggleFullScreen() {
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
        document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
        }
    }
    }) 
})

/**
 * SELECT2
 */

select_option = function(id,placeholder){
    $(id).select2({
        placeholder: placeholder,
        allowClear: true,
        autoClose: true
    });
}

/**
 * VALIDASI MAX LENGTH
 */
validasi_maksimal_karaker = function(obj){
    $(obj).maxlength({
        warningClass: "badge mt-1 badge-success",
        limitReachedClass: "badge mt-1 badge-danger"
    });
}


/**
 * toast js
 * line 6 s.d 27
 * sukses('Success','Data tenaga kerja berhasil tersimpan','success','bottom-left'); 
 */
pesan_error = function(e,position='top-left'){
    console.log(e.status);
    if((e.status == 422) || (e.status == 401) || (e.status == 201)){
        icons = e.responseJSON.status;
        pesan = e.responseJSON.messages;
        title = "Error : "+e.status;
        info(title,pesan,icons,position);
    }else if((e.status == 405) || (e.status == 419)){
        icons = "error";
        pesan = e.responseJSON.message;
        title = "Error : "+e.status;
        info(title,pesan,icons,position);
    }else if(e.status == 500){
        icons = "error";
        pesan = e.responseText;
        title = "Error : "+e.status;
        info(title,pesan,icons,position);
    }
    
}
info = function(title,pesan,icons,position) {
    'use strict';
    resetToastPosition();
    $.toast({
        heading: title,
        text: pesan,
        // showHideTransition: 'slide',
        stack: false,
        icon: icons,
        loaderBg: '#f96868',
        position: String(position),
    })
}
resetToastPosition = function() {
    $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
    $(".jq-toast-wrap").css({
      "top": "",
      "left": "",
      "bottom": "",
      "right": ""
    }); //to remove previous position style
}

numberof = function(num){
    var str = num.toString().replace(/[^,\d]/g, ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
      if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
          output.push(".");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  };

// komfirmasi = function(title,pesan,icon,callback ) {
//     swal({
//         title: title,
//         text: pesan,
//         icon: icon,
//         showCancelButton: true,
//         confirmButtonColor: '#3f51b5',
//         cancelButtonColor: '#ff4081',
//         confirmButtonText: 'Great ',
//         buttons: {
//           cancel: {
//             text: "Cancel",
//             value: null,
//             visible: true,
//             className: "btn btn-danger",
//             closeModal: true,
//           },
//           confirm: {
//             text: "OK",
//             value: true,
//             visible: true,
//             className: "btn btn-primary",
//             closeModal: true
//           }
//         }
//     }).then((confirmed) => {
//         if (confirmed) {
//            callback();
//          }
//     });
// }