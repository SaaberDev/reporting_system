(function($) {
	$.widget("ui.supertoggle", {

		currentVal:false, //current value

		options: {
			onVal:true, //value for on state
			onContent:"Close", //html for button when on
			offVal:false, //value for off state
			offContent:"Reopen", //html for button when off
			defaultState:true, //state of button on loading
		},

  		//object constructor
  		_create: function() {
  			var self = this;
  			var element = self.element;
  			var options = self.options;

  			element.addClass("supertoggle");

  			element.click(function(){
  				self._toggle(!self.currentVal);
  			});

        element.on("mouseover", function(e){
          element.css({"cursor":"pointer"});
        })

  			//handle value changed by jquery .val() method
  			element.on("valueSet", function(e){
  				var newVal = element.data("value") == options.onVal ? true : false;
  				self._toggle(newVal);
  			});

  			//setup default state
  			var startVal = options.defaultState == options.onVal ? true : false;
  			self._toggle(startVal);
  		},

  		_toggle:function(newVal){

  			var self = this;
  			var element = self.element;

  			if(newVal){
  				element.data("value", self.options.onVal);
  				element.html(self.options.onContent);
          element.removeClass("off").addClass("on")
  			}else{
  				element.data("value", self.options.offVal);
  				element.html(self.options.offContent);
          element.removeClass("on").addClass("off")
  			}

  			self.currentVal = newVal;

  		},

  		//allow options to be changed after creation
  		_setOption: function(option, value) {
  			$.Widget.prototype._setOption.apply( this, arguments );
  		},

  		//cleanup on element deletion
  		destroy: function() {

  		},

  	});
})(jQuery);
