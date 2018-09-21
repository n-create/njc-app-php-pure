/**
 * $().ajaxDialog
 * @version 0.1 (updated: 2009/10/25)
 * @author Takeshi Takatsudo (http://zudolab.net/blog/)
 * @license Dual licensed under the MIT and GPL licenses.
 * @dependOn jQuery UI - dialog (http://jqueryui.com/)
 */
(function($){ // start $ encapsulation

	var whileLoading = false;

	$.fn.ajaxDialog = function(options){
		this.click(function(e){
			e.preventDefault();
			if(!whileLoading){
				whileLoading = true;
				var $opener = $(this);
				$.ajax({
					url: $opener.attr('href'),
					success: function(data){
						var $div = $('<div></div>');
						if(!options.close){
							options.close = function(){
								$div.remove();
							};
						}
						if(!options.title){
							options.title = $opener.attr('title');
						}
						$div.html(data).dialog(options);
						whileLoading = false;
					},
					error: function(){
						whileLoading = false;
					}
				});
			}
		});
		return this;
	};
	
})(jQuery); // end $ encapsulation