var Main = function(){};

/**
 * Fired on document ready
 */

Main.prototype.onReady = function() {

	// initialize Analytics.

	this.$el = $('body');
	this.resize();
	this.initialMatches = 26;

	this.$formSearch = this.$el.find('input[name$="search"]');
	
	this.$dogPage = this.$el.find('#dog');
	
	this.$header = this.$el.find('> .header');	

	//init subPages 
	if($(".page#agency").length>0){

		this.currentPage = new Agency();
		this.currentPage.init($(".page#agency"));

	}


	//hide first
	this.$el.find('.autocomplete-container').hide();

	this.$formSearch.on('focus',function(e) {
		this.$el.find('.autocomplete-container').show();

	}.bind(this));

	this.$formSearch.on('keyup',function(e) {

		var currentField = $(e.currentTarget);
		var currentValue = currentField.val().toLowerCase();

		// var autoCompleteTpl = '<ul>'
		// this.$el.find('.autocomplete-container').show();

		if(currentValue.length>0){

			var matches = 0;
    		this.$el.find('.autocomplete-container').find(".autocomplete-result").filter(function() {

        		var str = $(this).find("a").html().toLowerCase();
        		var re = new RegExp(currentValue,"g");

				var res = str.match(re);
				if(res){
					$(this).show();
					matches++;
				}else{
					$(this).hide();
				}
    		
    		});
			
			if(matches==1)this.$el.find('.autocomplete-container .agency-number').html("1 agency");
			else if(matches==0)this.$el.find('.autocomplete-container .agency-number').html("0 agency");
			else this.$el.find('.autocomplete-container .agency-number').html(matches+"agencies");


		}else{

			this.$el.find('.autocomplete-container').find(".autocomplete-result").show();
			this.$el.find('.autocomplete-container .agency-number').html(this.initialMatches+"agencies");

		}

	}.bind(this));


	this.bindEvents();


}

Main.prototype.bindEvents = function() {

	this.$dogPage.on('click',function(){

		id = this.$dogPage.data('id');

		$.ajax({
		  method: "POST",
		  url: "/updatelike/",
		  data: { name: "John", location: "Boston" }
		})
		  .done(function( msg ) {
		    console.log(msg);
		  });
		
		return false;
	});

	this.$header.find('.icon.facebook').on('click',function(){
		this.shareFacebook();
	}.bind(this));
	
	this.$header.find('.icon.twitter').on('click',function(){
		this.shareTwitter();
	}.bind(this));   	

	$(window).on('resize', function(){

		this.resize();
		if(this.currentPage) this.currentPage.resize();

	}.bind(this));


}

Main.prototype.resize = function() {

	this.windowWidth = $(window).width();
	this.windowHeight = $(window).height();
	
}

Main.prototype.shareFacebook = function() {

	FB.ui({
        method: 'feed',
        link: "http://dogagency.dev/",
        caption: "Dog agency index caption",  
        description : "Humans are good but ugly. Pick your next agency based on something that really matters: cute dogs.",
        name : "Dog agency index name",
        picture : "http://104.131.195.130/images/agency-yes.jpg"
    }, function(response){});

}

Main.prototype.shareTwitter = function() {

	window.open("https://twitter.com/intent/tweet?url=http://dogagency.dev/&amp;text=Humans are good but ugly. Pick your next agency based on something that really matters: cute dogs.", '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');

}

var main = new Main();
$(document).ready(main.onReady.bind(main));