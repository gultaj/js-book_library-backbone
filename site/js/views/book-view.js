
var app = app || {};

app.BookView = Backbone.View.extend({
	className: 'book-container',

	events: {
		'click .delete': 'deleteBook'
	},

	template: _.template($('#bookTemplate').html()),

	render: function() {
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	},

	deleteBook: function() {
		this.model.destroy();
		this.remove();
	}
});