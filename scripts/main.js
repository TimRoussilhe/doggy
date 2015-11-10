var Main = function(){};

/**
 * Fired on document ready
 */

Main.prototype.onReady = function() {

	// initialize Analytics.

	this.$el = $('body');

	this.$formSearch = this.$el.find('input[name$="search"]');

	this.$agencyPage = this.$el.find('#agency');

	this.$dogPage = this.$el.find('#dog');
	
	this.$header = this.$el.find('> .header');	


	//hide first
	this.$el.find('.autocomplete-container').hide();

	this.$formSearch.on('keyup',function(e) {

		var currentField = $(e.currentTarget);
		var currentValue = currentField.val().toLowerCase();

		var autoCompleteTpl = '<ul>'

		if(currentValue.length>=2){

			$.ajax({
			  method: "POST",
			  url: "/getagencies/",
			  data: { query: currentValue}
			})
		  	.done(function( datas ) {
		  		
		  		var items = JSON.parse(datas)

		  		$.each(items,function(index,item){
		  			
		  			var url = '/agencies/'+item.Name_slug;
					autoCompleteTpl +='<li class="autocomplete-result"><a href="'+url+'">'+item.Name+'</a></li>'

				});

				autoCompleteTpl+='</ul>'

				this.$el.find('.autocomplete-container').html(autoCompleteTpl);
		  		this.$el.find('.autocomplete-container').show();

		  	}.bind(this));

		}else{

			this.$el.find('.autocomplete-container').html("");
		  	this.$el.find('.autocomplete-container').hide();

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

	this.$agencyPage.find('.icon.facebook').on('click',function(){
		this.shareFacebookAgency();
	}.bind(this));
	
	this.$agencyPage.find('.icon.twitter').on('click',function(){
		this.shareTwitterAgency();
	}.bind(this));

}

Main.prototype.resize = function() {



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


Main.prototype.shareFacebookAgency = function() {

	var currentAgency = this.$agencyPage.find('h1').text();

	FB.ui({
        method: 'feed',
        link: "http://dogagency.dev/",
        caption: currentAgency+"Dog agency index ",  
        description : "Humans are good but ugly. Pick your next agency based on something that really matters: cute dogs.",
        name : currentAgency,
        picture : "http://104.131.195.130/images/agency-yes.jpg"
    }, function(response){});

}

Main.prototype.shareTwitterAgency = function() {

	var currentAgency = this.$agencyPage.find('h1').text();
	var currentAgencySlug = this.$agencyPage.find('h1').data('slug');

	window.open("https://twitter.com/intent/tweet?url=http://dogagency.dev/agencies/"+currentAgencySlug+"&amp;text=At "+currentAgency+" ,humans are good but ugly. Come check their cute dogs", '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');

}



var main = new Main();
$(document).ready(main.onReady.bind(main));