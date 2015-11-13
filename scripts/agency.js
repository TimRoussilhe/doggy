var Agency = function(){};


Agency.prototype.init = function(el) {

	this.render(el);

	this.resize();

	this.initState();

}


Agency.prototype.render = function(el) {

	this.$el = el;
	this.$container = this.$el.find('#main-container');

}

Agency.prototype.initState = function() {

	TweenLite.set(this.$container,{y:main.windowHeight,opacity:1,force3D : true});
	TweenLite.to(this.$container, 1 ,{y:0, force3D: true,delay:1,force3D : true , ease : Power2.EaseInOut});

}

Agency.prototype.bindEvents = function() {

	this.$el.find('.icon.facebook').on('click',function(){
		this.shareFacebookAgency();
	}.bind(this));
	
	this.$el.find('.icon.twitter').on('click',function(){
		this.shareTwitterAgency();
	}.bind(this));

}

Agency.prototype.resize = function() {
	console.log(main.windowHeight);

	this.$container.css('marginLeft',-(this.$container.width()/2));
	this.$container.css('marginTop',-(this.$container.height()/2));

}

Agency.prototype.shareFacebook = function() {

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

Agency.prototype.shareTwitter = function() {

	var currentAgency = this.$agencyPage.find('h1').text();
	var currentAgencySlug = this.$agencyPage.find('h1').data('slug');

	window.open("https://twitter.com/intent/tweet?url=http://dogagency.dev/agencies/"+currentAgencySlug+"&amp;text=At "+currentAgency+" ,humans are good but ugly. Come check their cute dogs", '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');

}

