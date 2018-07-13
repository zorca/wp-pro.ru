(function($){

//   AnsPress.models.UserMBox = Backbone.Model.extend({
//     defaults: {
//       id: '',
//       title: '',
//       col: '6',
//       order: 4,
//       wrapper: true,
//       user_id: true,
//       fetched: false,
//       content: '',
//     }
//   });

//   AnsPress.collections.UserMBoxs = Backbone.Collection.extend({
// 		model: AnsPress.models.UserMBox
// 	});

//   AnsPress.views.UserMBox = Backbone.View.extend({
// 		id: function(){
// 			return this.model.id;
// 		},
//     className: function(){
//       var klass = 'ap-user-col col-' + this.model.get('col');
//       klass += ! this.model.get('wrapper') ? ' no-wrapper' : '';
//       return klass;
//     },
//     initialize: function(opt){
//       this.model = opt.model;
//     },
//     template: '<div class="ap-about-box"><# if(\'\'!==title){ #><h3>{{title}}</h3><# } #>{{{content}}}</div>',
//     fetchMetaBox: function(){
//       var self = this;
//       AnsPress.ajax({
//         data: {
//           ap_ajax_action: 'ab_user_metabox_' + self.model.get('id'),
//           user_id: self.model.get('user_id')
//         },
//         success: function(data){
//           self.model.set('content', data.html);
//           self.model.set('fetched', true);
//           self.render();
//         }
//       });
//     },
//     render: function(){
//       if(this.model.get('fetched')){
//         var t = _.template(this.template);
//         this.$el.html(t(this.model.toJSON()));
//         this.$el.attr('class', this.className());
//         $('#metaboxes').masonry('layout');
//       } else {
//         this.fetchMetaBox();
//       }

//       return this;
//     }
//   });

//   AnsPress.views.UserMBoxs = Backbone.View.extend({
//     el: '#metaboxes',
//     initialize: function(options){
//       this.model = options.model;
//     },
//     renderItem: function(model){
//       var view = new AnsPress.views.UserMBox({model: model});
//       this.$el.append(view.render().$el);
//     },
//     render: function(){
//       var self = this;
//       this.model.each(function(model){
//         self.renderItem(model);
//       });
//       return self;
//     }
//   });

  $(document).ready(function(){
    $('#metaboxes').masonry({
      itemSelector: '.ap-user-col',
      columnWidth: '#metabox-width',
      gutter: 0
    });
  });
})(jQuery);
