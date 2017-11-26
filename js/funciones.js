// JavaScript Document alertaweb
$(document).ready(inicio);

function inicio() {
    $("#btnBuscar").click(buscarPregunta);
    $("#txtBuscar").keypress(buscarPreguntaIntro);
    $("#btnLogin").click(loginusuario);
    $("#nickname").blur(campoRequerido).blur(validarusuario);
    $("#pass").blur(campoRequerido);
    $("#email").blur(campoRequerido);
    $("#nickname").blur(campoRequerido);
    $("#pais").blur(campoRequerido);
    $("#passrep").blur(validarclave);
    $("#formularioRegistro").submit(validarFormRegistro);
    $("#formpregunta").submit(comprobarformpregunta);
    $("#usuario_clave_conf").blur(validarclavecambiarpass);
    $("#formcambiarpass").submit(comprobarformcambiarpass);
    $("#formrespuesta").submit(comprobarrespuesta);
    $(".btnLike").click(anadirLike);
    $("#formaddcat").submit(validarFormCategorias);
    $("#formeditpregunta").submit(validarFormEditPregunta);
    $("#formeditrespuesta").submit(validarFormEditRespuesta);
    $("#formedituser").submit(validarFormEditUsuario);
	$("#clave").keypress(loginintro);
}

function validarFormRegistro() {
    comprobartodo();
    if ($("#input").val().length < 1) {
		$("#alertaweb").find("div").remove();
        $("#alertaweb").html("<div class='alert alert-danger'><div class='col-lg-8 col-md-8'><i class='glyphicon glyphicon-remove-sign'></i> Captcha requerido<br></div></div>");
        return false;
    }
	return validarclave();
}

function validarFormEditUsuario() {
    if ($("#nickname").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
    if ($("#email").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
    if ($("#pais").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
}

function validarFormEditRespuesta() {
    if ($("#answer").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
}

function validarFormEditPregunta() {
    if ($("#question").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    } else if ($("#questiontext").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
}

function validarFormCategorias() {
    if ($("#catname").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    } else if ($("#catdesc").val().length < 1) {
		$(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
}

function anadirLike() {
    $.ajax({
        url: 'inc/like.php',
        type: 'POST',
        data: "idanswer=" + $(this).attr("alt"),
        dataType: "text",
        context: this,
        success: function (datos) {
            // la comprobacion es sarisfactoria
            // en otro caso sacar error
            if (datos.trim() == 1) {
                $(this).attr("disabled", "disabled");
            }
        }
    });
}

function comprobarrespuesta() {
    if ($("#message").val().length < 1) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
}

function comprobarformcambiarpass() {
    if ($("#usuario_clave").val() == "" || $("#usuario_clave_conf").val() == "") {
		$(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Campo requerido</div>");
        return false;
    }
	return validarclavecambiarpass();
}

function comprobarformpregunta() {
    comprobartodo();
    if ($("#message").val().length < 1) {
		$("#alertaweb").find("div").remove();
        $("#alertaweb").append("<div class='alert alert-danger'><div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Texto requerido</div></div>");
        return false;
    }
    if ($("#input").val().length < 1) {
		$("#alertaweb").find("div").remove();
        $("#alertaweb").append("<div class='alert alert-danger'><div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i>  Captcha requerido</div></div>");
        return false;
    }
}

function validarusuario() {
    $.ajax({
        url: 'inc/comprobarusuario.php',
        type: 'POST',
        data: "nickname=" + $(this).val(),
        dataType: "text",
        success: function (datos) {
            // si se devuelve 0 la comprobacion es sarisfactoria
            // en otro caso sacar error
            if (datos.trim() != "0") {
                $("#nickname").parent().find("div").remove();
                $("#nickname").parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i> El usuario ya existe</div>");
            }
        }
    });
}

function comprobartodo() {
    $("input").each(campoRequerido);
    var errores = $(".errorformulario");
    if (errores.length > 0) {
        return false;
    }
}

function validarclave() {
    // comprobar que las claves coincidan
    if ($("#pass").val() != $("#passrep").val()) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i> Las claves no coinciden.</div>");
		return false;
	}else if($("#pass").val().length < 6 && $("#passrep").val().length < 6 ){
		$(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i> La clave debe tener al menos 6 caracteres.</div>");
		return false;
    } else {
        $(this).parent().find("div").remove();
    }
}

function validarclavecambiarpass() {
    // comprobar que las claves coincidan
    if ($("#usuario_clave").val() != $("#usuario_clave_conf").val()) {
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i> Las claves no coinciden.</div>");
		return false;
    } else if($("#usuario_clave").val().length < 6 && $("#usuario_clave_conf").val().length < 6 ){
		$(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i> La clave debe tener al menos 6 caracteres.</div>");
		return false;
    }else {
        $(this).parent().find("div").remove();
    }
}

function campoRequerido() {
    if ($(this).val() == "") {
        // me creo un elemento contiguo al campo que ha dado el error
        $(this).parent().find("div").remove();
        $(this).parent().append("<div class='text-danger'><i class='glyphicon glyphicon-remove-sign'></i> No se puede dejar en blanco</div>");
    } else {
        $(this).parent().find("div").remove();
    }
}

function buscarPregunta() {

    if ($("#txtBuscar").val().length < 1) {
        alert("Debe insertar algún texto antes de buscar");
    } else {
        window.location = "buscar.php?texto=" + $("#txtBuscar").val();
    }
}

function buscarPreguntaIntro(evento) {
    if (evento.keyCode == 13) {
        buscarPregunta();
    }
}

function loginintro(evento) {
    if (evento.keyCode == 13) {
        loginusuario();
    }
}

function loginusuario() {
    // autenticar al usuario mediante AJAX y poner la variable de session
    // usuario para saber en todos las demas que el usuario ha iniciado sesion
    if (($("#usuario").val().length < 1) || ($("#clave").val().length < 1)) {
		alert("No se pueden dejar campos en blanco");
    } else {
        $.ajax({
            url: "inc/autenticarusuario.php",
            type: "POST",
            data: "usuario=" + $("#usuario").val() + "&clave=" + $("#clave").val(),
            dataType: "text",
			context: this,
            success: function (datos) {
                if (datos.trim() == "0") {
					alert("Usuario o contraseña incorrectos");
				} else {
                    location.reload();
                }
            }
        });
    }

}


//Caja de respuesta

$(document).on('click', '.panel-heading span.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).ready(function () {
    $('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();
});

//Caja de respuesta

/** * * jquery.charcounter.js version 1.2 * requires jQuery version 1.2 or higher * Copyright (c) 2007 Tom Deater (http://www.tomdeater.com) * Licensed under the MIT License: * http://www.opensource.org/licenses/mit-license.php * */
(function ($) { /** * attaches a character counter to each textarea element in the jQuery object * usage: $("#myTextArea").charCounter(max, settings); */
    $.fn.charCounter = function (max, settings) {
        max = max || 100;
        settings = $.extend({
            container: "<span></span>",
            classname: "charcounter",
            format: "(%1 caracteres restantes)",
            pulse: true,
            delay: 0
        }, settings);
        var p, timeout;

        function count(el, container) {
            el = $(el);
            if (el.val().length > max) {
                el.val(el.val().substring(0, max));
                if (settings.pulse && !p) {
                    pulse(container, true);
                };
            };
            if (settings.delay > 0) {
                if (timeout) {
                    window.clearTimeout(timeout);
                }
                timeout = window.setTimeout(function () {
                    container.html(settings.format.replace(/%1/, (max - el.val().length)));
                }, settings.delay);
            } else {
                container.html(settings.format.replace(/%1/, (max - el.val().length)));
            }
        };

        function pulse(el, again) {
            if (p) {
                window.clearTimeout(p);
                p = null;
            };
            el.animate({
                opacity: 0.1
            }, 100, function () {
                $(this).animate({
                    opacity: 1.0
                }, 100);
            });
            if (again) {
                p = window.setTimeout(function () {
                    pulse(el)
                }, 200);
            };
        };
        return this.each(function () {
            var container;
            if (!settings.container.match(/^<.+>$/)) {
                // use existing element to hold counter message 
                container = $(settings.container);
            } else {
                // append element to hold counter message (clean up old element first) 
                $(this).next("." + settings.classname).remove();
                container = $(settings.container).insertAfter(this).addClass(settings.classname);
            }
            $(this).unbind(".charCounter").bind("keydown.charCounter", function () {
                count(this, container);
            }).bind("keypress.charCounter", function () {
                count(this, container);
            }).bind("keyup.charCounter", function () {
                count(this, container);
            }).bind("focus.charCounter", function () {
                count(this, container);
            }).bind("mouseover.charCounter", function () {
                count(this, container);
            }).bind("mouseout.charCounter", function () {
                count(this, container);
            }).bind("paste.charCounter", function () {
                var me = this;
                setTimeout(function () {
                    count(me, container);
                }, 10);
            });
            if (this.addEventListener) {
                this.addEventListener('input', function () {
                    count(this, container);
                }, false);
            };
            count(this, container);
        });
    };
})(jQuery);
$(function () {
    $(".counted").charCounter(1500, {
        container: "#counter"
    });
});