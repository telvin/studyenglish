//vidaltek spinner

(function($) {

    var methods = {
        init: function(options) {

            // Establish our default settings
            var settings = $.extend({
                numericFormat: 'float',
                upSelector   : '#upArrow',
                downSelector : '#downArrow',
                min          : 0,
                max          : 999,
                step         : 1,
                onIncreased      : null,
                onDecreased    : null,
                onComplete     : null

            }, options);

            // Repeat over each element in selector
            return this.each(function() {
                var $this = $(this);

                // Attempt to grab saved settings, if they don't exist we'll get "undefined".
                //var settings = $this.data('vdtspinner');

                // If we could't grab settings, create them from defaults and passed options
                if(typeof(settings) == 'undefined') {

                    var defaults = {
                        propertyName: 'value',
                        onSomeEvent: function() {}
                    }

                    settings = $.extend(true,{}, defaults, options);

                    // Save our newly created settings
                } else {
                    // We got settings, merge our passed options in with them (optional)
                    settings = $.extend(true, {}, settings, options);

                    // If you wish to save options passed each time, add:
                    // $this.data('pluginName', settings);
                }

                $this.data('vdtspinner', settings);

                function getNumber(input, format){
                    if(format == 'float')
                        return parseFloat(input).toFixed(2);
                    else{
                        return parseInt(input);
                    }
                }


                var dymProp = 'html';
                if( $(this).is('input:text') ) {
                    dymProp = 'val';
                }

                var temp = 0;

                var _this = $(this);

                $(settings.upSelector).bind('click', function(){
                    var currentVal =  $('#' + $(_this).attr('id'))[dymProp]();

                    temp = parseFloat(currentVal) + settings.step;

                    //$.isNumeric(currentVal)
                    if(temp <= settings.max){
                       $(_this)[dymProp](getNumber(temp, settings.numericFormat));
                        var currentVal =  $('#' + $(_this).attr('id'))[dymProp]();

                        if ($.isFunction( settings.onIncreased)) {
                            settings.onIncreased.call(_this);
                        }
                    }

                    if ($.isFunction( settings.onComplete)) {
                        settings.onComplete.call(_this, temp);
                    }

                });

                $(settings.downSelector).bind('click', function(){
                    var currentVal =  $('#' + $(_this).attr('id'))[dymProp]();
                    temp = parseFloat(currentVal) - settings.step;
                    if(temp >= settings.min){
                        $(_this)[dymProp](getNumber(temp, settings.numericFormat));

                        if ($.isFunction( settings.onDecreased)) {
                            settings.onDecreased.call( _this );
                        }
                    }
                    if ($.isFunction( settings.onComplete)) {
                        settings.onComplete.call( _this, temp );
                    }

                });

            });
        },
        destroy: function(options) {
            // Repeat over each element in selector
            return $(this).each(function() {
                var $this = $(this);
                var settings = $this.data('vdtspinner');
                // run code here

                if(settings != undefined){

                    $(settings.upSelector).unbind('click');
                    $(settings.downSelector).unbind('click');
                    // Remove settings data when deallocating our plugin
                    $this.removeData('vdtspinner');
                }
            });
        }
    }

    $.fn.vdtspinner = function() {
        var method = arguments[0];

        if(methods[method]) {
            method = methods[method];
            arguments = Array.prototype.slice.call(arguments, 1);
        } else if( typeof(method) == 'object' || !method ) {
            method = methods.init;
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.pluginName' );
            return this;
        }

        return method.apply(this, arguments);
    }

}(jQuery));
