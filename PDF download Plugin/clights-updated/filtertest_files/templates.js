(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['layer_row'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [3,'>= 1.0.0-rc.4'];
helpers = helpers || Handlebars.helpers; data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  
  return " clights_add_new_row";
  }

function program3(depth0,data) {
  
  
  return " clights_selected";
  }

  buffer += "<div id=\"";
  if (stack1 = helpers._id) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0._id; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"\r\n     class=\"row-fluid clights_tr";
  stack1 = helpers['if'].call(depth0, depth0.isNew, {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\">\r\n    <div class=\"clights_row_bg\"></div>\r\n    <div class=\"clights_layer_chkbox span1 clights_td clights_row_checkbox\">\r\n        <button class=\"btn btn-inverse\">\r\n            <i class=\"icon-ok\"></i>\r\n        </button>\r\n    </div>\r\n    <div class=\"clights_layer_name span3 clights_td clights_caps\" data-fieldname=\"itemName\">Add new item</div>\r\n    <div class=\"clights_layer_desc span4 clights_td\" data-fieldname=\"description\">\r\n        <input type=\"text\" name=\"description\" id=\"\">\r\n    </div>\r\n    <div class=\"clights_layer_color span1 clights_td clights_colorpicker\" data-fieldname=\"color\">\r\n        <div class=\"btn-group clights_colorpicker_dropdown\">\r\n            <button class=\"btn btn-inverse clights_swatch\"></button>\r\n            <button class=\"btn btn-inverse dropdown-toggle\" data-toggle=\"dropdown\">\r\n                <span class=\"caret\"></span>\r\n            </button>\r\n            <ul class=\"dropdown-menu\"></ul>\r\n        </div>\r\n    </div>\r\n    <div class=\"clights_layer_price span1 clights_td\" data-fieldname=\"price\">\r\n        <input type=\"number\" name=\"price\"\r\n               pattern=\"[0-9]+([\\.|,][0-9]+)?\" step=\"0.01\"\r\n                title=\"This should be a number with up to 2 decimal places.\">\r\n    </div>\r\n    <div class=\"clights_layer_buttons span1 clights_td clights_layer_actions\">\r\n        <button class=\"btn btn-link clights_edit\">\r\n            <i class=\"icon-pencil\"></i>\r\n        </button>\r\n        <button class=\"btn btn-link clights_remove\">\r\n            <i class=\"icon-remove\"></i>\r\n        </button>\r\n    </div>\r\n</div>";
  return buffer;
  });
templates['swatches'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [3,'>= 1.0.0-rc.4'];
helpers = helpers || Handlebars.helpers; data = data || {};
  


  return "<li><a class=\"btn btn-small clights_swatch white\" data-swatch=\"white\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch red\" data-swatch=\"red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch green\" data-swatch=\"green\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch blue\" data-swatch=\"blue\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch orange\" data-swatch=\"orange\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch violet\" data-swatch=\"violet\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch yellow\" data-swatch=\"yellow\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch white_red\" data-swatch=\"white_red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch red_red\" data-swatch=\"red_red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch green_red\" data-swatch=\"green_red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch blue_red\" data-swatch=\"blue_red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch orange_red\" data-swatch=\"orange_red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch violet_red\" data-swatch=\"violet_red\" href=\"#\"></a></li>\r\n<li><a class=\"btn btn-small clights_swatch yellow_red\" data-swatch=\"yellow_red\" href=\"#\"></a></li>\r\n\r\n";
  });
templates['upload_modal'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [3,'>= 1.0.0-rc.4'];
helpers = helpers || Handlebars.helpers; data = data || {};
  


  return "<div id=\"clights-upload-modal\" class=\"modal clights_pane hide fade\">\r\n    <div class=\"modal-header\">\r\n        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\r\n        <h3 class=\"clights_baps\">Upload photo to start bid</h3>\r\n    </div>\r\n    <div class=\"modal-body\">\r\n        <form class=\"form-inline\" action=\"\">\r\n            <input type=\"file\" name=\"bid_photo\" id=\"bid-photo\">\r\n        </form>\r\n    </div>\r\n    <div class=\"modal-footer\">\r\n        <a href=\"#\" class=\"btn\">Close</a>\r\n        <a href=\"#\" class=\"btn btn-primary\">Upload</a>\r\n    </div>\r\n</div>";
  });
})();