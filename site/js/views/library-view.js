
var app = app || {};

app.LibraryView = Backbone.View.extend({
	el: '#books',

	events: {
		'click #add': 'addBook'
	},
	
	initialize: function() {
		this.$list = this.$('#book-list');
		this.collection = new app.Library();
		this.collection.fetch({reset: true});
		this.render();
		this.listenTo(this.collection, 'add', this.renderBook);
		this.listenTo( this.collection, 'reset', this.render );
	},

	render: function() {
		this.collection.each(function(book) {
			this.renderBook(book);
		}, this);
	},

	renderBook: function(book) {
		var view = new app.BookView({model: book});
		this.$list.append(view.render().el);
		console.log(book);
	},

	addBook: function(event) {
		event.preventDefault();
		var formData = {};
		this.$('#addBook div').children('input').each(function(i, elem) {
			if ($(elem).val()) {
				formData[elem.id] = $(elem).val();
				$(elem).val('');
			}
		});
		this.collection.create(formData, {
                wait: true
            });

	}
});