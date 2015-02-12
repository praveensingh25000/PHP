(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['alert'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression;


  buffer += "<div class=\"alert alert-";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + " fade in\">\r\n    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">\r\n        <i class=\"icon icon-remove\"></i>\r\n    </button>\r\n    <strong>";
  if (stack1 = helpers.message) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.message; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "</strong>\r\n</div>";
  return buffer;
  });
templates['bid_button'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, stack2, options, functionType="function", escapeExpression=this.escapeExpression, helperMissing=helpers.helperMissing, self=this;

function program1(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "data-projectid=\"";
  if (stack1 = helpers.projectId) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.projectId; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"";
  return buffer;
  }

  buffer += "<a href=\"#\" id=\"clights-dealer-cm-gotoquote\" \r\n	data-action=\"";
  options = {hash:{},data:data};
  buffer += escapeExpression(((stack1 = helpers.ternary || depth0.ternary),stack1 ? stack1.call(depth0, "open", "create", depth0.hasBid, options) : helperMissing.call(depth0, "ternary", "open", "create", depth0.hasBid, options)))
    + "\"\r\n   ";
  stack2 = helpers['if'].call(depth0, depth0.hasBid, {hash:{},inverse:self.noop,fn:self.program(1, program1, data),data:data});
  if(stack2 || stack2 === 0) { buffer += stack2; }
  buffer += "\r\nclass=\"btn btn-primary clights_caps\">Build Quote</a>\r\n<a href=\"#\" id=\"clights-dealer-cm-gotobid\"\r\n   data-action=\"";
  options = {hash:{},data:data};
  buffer += escapeExpression(((stack1 = helpers.ternary || depth0.ternary),stack1 ? stack1.call(depth0, "open", "create", depth0.hasBid, options) : helperMissing.call(depth0, "ternary", "open", "create", depth0.hasBid, options)))
    + "\"\r\n   ";
  stack2 = helpers['if'].call(depth0, depth0.hasBid, {hash:{},inverse:self.noop,fn:self.program(1, program1, data),data:data});
  if(stack2 || stack2 === 0) { buffer += stack2; }
  buffer += "\r\n   style=\"display:";
  options = {hash:{},data:data};
  buffer += escapeExpression(((stack1 = helpers.ternary || depth0.ternary),stack1 ? stack1.call(depth0, "", "none", depth0.hasBid, options) : helperMissing.call(depth0, "ternary", "", "none", depth0.hasBid, options)))
    + "\"\r\n   class=\"btn btn-primary clights_caps\">";
  options = {hash:{},data:data};
  buffer += escapeExpression(((stack1 = helpers.ternary || depth0.ternary),stack1 ? stack1.call(depth0, "Design", "Start Design", depth0.hasBid, options) : helperMissing.call(depth0, "ternary", "Design", "Start Design", depth0.hasBid, options)))
    + "</a>\r\n";
  return buffer;
  });
templates['daylight_scale_popover'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, stack2, functionType="function", escapeExpression=this.escapeExpression;


  buffer += "<div class=\"clights_daylight_scale_range\"> <input type=\"range\" min=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.range),stack1 == null || stack1 === false ? stack1 : stack1.min)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\" max=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.range),stack1 == null || stack1 === false ? stack1 : stack1.max)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\" name=\"nightvision\" value=\"";
  if (stack2 = helpers.nightvision) { stack2 = stack2.call(depth0, {hash:{},data:data}); }
  else { stack2 = depth0.nightvision; stack2 = typeof stack2 === functionType ? stack2.apply(depth0) : stack2; }
  buffer += escapeExpression(stack2)
    + "\" /> </div>";
  return buffer;
  });
templates['dealer_cm_dropdown'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n        ";
  stack1 = helpers.each.call(depth0, depth0.items, {hash:{},inverse:self.noop,fn:self.program(2, program2, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n    ";
  return buffer;
  }
function program2(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n            <li data-itemid=\"";
  if (stack1 = helpers.id) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.id; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\">\r\n                <a href=\"#\" data-tag=\"clights_dropdown_item_link\">";
  if (stack1 = helpers.name) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.name; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "</a>\r\n            </li>\r\n        ";
  return buffer;
  }

function program4(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n        <li>\r\n            <a href=\"#\" class=\"btn btn-link disabled\">No ";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "s</a>\r\n        </li>\r\n    ";
  return buffer;
  }

  buffer += "<ul id=\"clights-dealer-cm-dropdown\" class=\"dropdown-menu\" data-type=\"";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\" style=\"width: 100%;\">\r\n    ";
  stack1 = helpers['if'].call(depth0, depth0.hasItems, {hash:{},inverse:self.program(4, program4, data),fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n</ul>";
  return buffer;
  });
templates['dealer_cm_modal'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  
  return "\r\n                <span class=\"badge badge-important pull-right\">ADMIN</span>\r\n            ";
  }

function program3(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n                <span class=\"badge badge-info pull-right\">"
    + escapeExpression(((stack1 = ((stack1 = depth0.user),stack1 == null || stack1 === false ? stack1 : stack1.name)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "</span>\r\n            ";
  return buffer;
  }

function program5(depth0,data) {
  
  
  return "new";
  }

function program7(depth0,data) {
  
  var stack1;
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  return escapeExpression(stack1);
  }

  buffer += "<div id=\"clights-dealer-cm-modal\"\r\n     class=\"modal clights_pane clights_modal hide fade\"\r\n     data-showing=\"";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"\r\n     data-keyboard=\"false\"\r\n     data-backdrop=\"static\"\r\n     data-screen=\"";
  if (stack1 = helpers.layout) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.layout; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\">\r\n    <div class=\"modal-header\">\r\n        <h3 class=\"clights_caps\">\r\n            <img class=\"pull-left\" src=\"img/logo_ttl-300.png\" alt=\"Christmas Decor\" width=\"300\" height=\"90\">\r\n            ";
  stack1 = helpers['if'].call(depth0, depth0.admin, {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n        </h3>\r\n    </div>\r\n    <div class=\"modal-body clights_justify\">\r\n        <div id=\"clights-dealer-cm-actions\">\r\n            <button id=\"clights-new-cm\"\r\n                    class=\"btn btn-primary clights_caps btn-block\">New ";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "</button>\r\n            <div class=\"btn-group\" style=\"width: 100%;\">\r\n                <button class=\"btn dropdown-toggle clights_caps btn-block\"\r\n                   data-toggle=\"dropdown\">Existing ";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + " <span class=\"caret\"></span>\r\n                </button>\r\n                <ul id=\"clights-dealer-cm-dropdown\"\r\n                    class=\"dropdown-menu\"\r\n                    data-type=\"";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\" style=\"width: 100%;\">\r\n                </ul>\r\n            </div>\r\n            <button id=\"clights-account-settings\"\r\n                    class=\"btn clights_caps btn-block disabled\">Account Settings</button>\r\n            <button id=\"clights-logout\"\r\n                    class=\"btn btn-danger clights_caps btn-block\">Logout</button>\r\n        </div>\r\n        <form class=\"form-horizontal\" id=\"clights-dealer-cm-form\"\r\n              data-itemtype=\"";
  stack1 = helpers['if'].call(depth0, depth0.isNew, {hash:{},inverse:self.program(7, program7, data),fn:self.program(5, program5, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\">\r\n        </form>\r\n        <div class=\"clights_justified_block clights_break\"></div>\r\n    </div>\r\n    <div class=\"modal-footer clights_pane\">\r\n        <a href=\"#\" id=\"clights-dealer-cm-delete\" class=\"btn btn-danger clights_caps\">Delete</a>\r\n        <a href=\"#\" id=\"clights-dealer-cm-save\" class=\"btn btn-success clights_caps\">Save</a>\r\n    </div>\r\n</div>";
  return buffer;
  });
templates['dealer_cm_modal_form'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this, helperMissing=helpers.helperMissing;

function program1(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.name)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program3(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.address_1)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program5(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.city)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program7(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.state)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program9(depth0,data) {
  
  
  return "number";
  }

function program11(depth0,data) {
  
  
  return "text";
  }

function program13(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.zip)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program15(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.phone)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program17(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n    <div class=\"control-group\">\r\n        <label class=\"control-label clights_caps\" for=\"username\">Username</label>\r\n\r\n        <div class=\"controls\">\r\n            <input type=\"text\" id=\"username\" placeholder=\"Username\"\r\n                   name=\"username\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(18, program18, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n        </div>\r\n    </div>\r\n    <div class=\"control-group\">\r\n        <label class=\"control-label clights_caps\" for=\"password\">Password</label>\r\n\r\n        <div class=\"controls\">\r\n            <input type=\"password\" id=\"password\" placeholder=\"Password\"\r\n                   name=\"password\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(20, program20, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n        </div>\r\n    </div>\r\n";
  return buffer;
  }
function program18(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.username)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program20(depth0,data) {
  
  var buffer = "", stack1;
  buffer += " value=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.password)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\"";
  return buffer;
  }

function program22(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n    <div class=\"control-group\">\r\n        <label class=\"control-label clights_caps\" for=\"clights-cm-bid-date\">Bid Date</label>\r\n\r\n        <div class=\"controls\">\r\n            <input type=\"date\" id=\"clights-cm-bid-date\" placeholder=\"Bid Date\"\r\n                   name=\"bid_date\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(23, program23, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n        </div>\r\n    </div>\r\n";
  return buffer;
  }
function program23(depth0,data) {
  
  var buffer = "", stack1, options;
  buffer += " value=\"";
  options = {hash:{},data:data};
  buffer += escapeExpression(((stack1 = helpers.dateInputVal || depth0.dateInputVal),stack1 ? stack1.call(depth0, ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.bid_date), options) : helperMissing.call(depth0, "dateInputVal", ((stack1 = depth0.item),stack1 == null || stack1 === false ? stack1 : stack1.bid_date), options)))
    + "\"";
  return buffer;
  }

  buffer += "<div class=\"control-group\">\r\n    <label class=\"control-label clights_caps\" for=\"clights-cm-name\">Name</label>\r\n\r\n    <div class=\"controls\">\r\n        <input type=\"text\" id=\"clights-cm-name\" placeholder=\"Name\"\r\n                name=\"name\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n    </div>\r\n</div>\r\n<div class=\"control-group\">\r\n    <label class=\"control-label clights_caps\" for=\"clights-cm-address\">Address</label>\r\n\r\n    <div class=\"controls\">\r\n        <input type=\"text\" id=\"clights-cm-address\" placeholder=\"Address\"\r\n               name=\"address_1\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(3, program3, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n    </div>\r\n</div>\r\n<div class=\"control-group\">\r\n    <label class=\"control-label clights_caps\" for=\"city\">City</label>\r\n\r\n    <div class=\"controls\">\r\n        <input type=\"text\" id=\"city\" placeholder=\"City\"\r\n               name=\"city\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(5, program5, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n    </div>\r\n</div>\r\n<div class=\"control-group\">\r\n    <label class=\"control-label clights_caps\" for=\"state\">State/ZIP</label>\r\n\r\n    <div class=\"controls controls-row\">\r\n        <input class=\"span2\" type=\"text\" id=\"state\" placeholder=\"State\"\r\n               name=\"state\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(7, program7, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n        <input class=\"span1\"\r\n               type=\"";
  stack1 = helpers['if'].call(depth0, depth0.isHandheld, {hash:{},inverse:self.program(11, program11, data),fn:self.program(9, program9, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\"\r\n               id=\"ZIP\" placeholder=\"ZIP\"\r\n               name=\"zip\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(13, program13, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n    </div>\r\n</div>\r\n<div class=\"control-group\">\r\n    <label class=\"control-label clights_caps\" for=\"clights-cm-phone\">Phone</label>\r\n\r\n    <div class=\"controls\">\r\n        <input type=\"tel\" id=\"clights-cm-phone\" placeholder=\"Phone\"\r\n               name=\"phone\" ";
  stack1 = helpers.unless.call(depth0, depth0['new'], {hash:{},inverse:self.noop,fn:self.program(15, program15, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += ">\r\n    </div>\r\n</div>\r\n";
  stack1 = helpers['if'].call(depth0, depth0.admin, {hash:{},inverse:self.program(22, program22, data),fn:self.program(17, program17, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n";
  return buffer;
  });
templates['delete_confirm_popover'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  
  return "all the dealer's customers and bids. ";
  }

function program3(depth0,data) {
  
  
  return " the saved bid, if any. Click again below to confirm. ";
  }

  buffer += "<div id=\"clights-confirm-delete\">\r\n    <p>This ";
  if (stack1 = helpers.type) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.type; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + " will be permanently deleted along with ";
  stack1 = helpers['if'].call(depth0, depth0.isDealer, {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "</p>\r\n    <button id=\"clights-cancel-delete\" class=\"btn\">Cancel</button>\r\n</div>";
  return buffer;
  });
templates['estimate_ttl'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, self=this;

function program1(depth0,data) {
  
  
  return "\r\n    <div class=\"logo_ttl\">\r\n        <img src=\"img/logo_ttl-238x30.png\" alt=\"Christmas Decor\">\r\n    </div>\r\n    <div class=\"clights_total_767max clights_needs_update\"></div>\r\n";
  }

function program3(depth0,data) {
  
  
  return "\r\n    <div class=\"logo_ttl\"></div>\r\n    <div class=\"clights_ttl_label\">TOTAL</div>\r\n    <div class=\"clights_total_amt\"><span></span></div>\r\n";
  }

  buffer += "\r\n";
  stack1 = helpers['if'].call(depth0, depth0.isHandheld, {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n";
  return buffer;
  });
templates['hb_helpers'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "Handlebars.registerHelper('dateInputVal', function(unixTime) {\r\n//    console.log(unixTime);\r\n    var fmtDate = new Handlebars.SafeString(\r\n        Date.create(parseInt(unixTime)).format('{yyyy}-{MM}-{dd}')\r\n    );\r\n//    console.log(fmtDate);\r\n    return fmtDate;\r\n});\r\n\r\nHandlebars.registerHelper('ternary', function(valIfTrue, valIfFalse) {\r\n    valIfTrue = valIfTrue || 'true';\r\n    valIfFalse = valIfFalse || \"false\";\r\n    var args = arguments\r\n        , numConditions = args.length - 2\r\n        , conditions = Array.prototype.slice.call(args, 2)\r\n        , results = [];\r\n    console.log('ternary conditions:', numConditions);\r\n    [].forEach.call(conditions, function (condition) {\r\n        results.push(!!condition)\r\n    });\r\n    return !_.contains(results, false)\r\n        ? new Handlebars.SafeString(valIfTrue)\r\n        : new Handlebars.SafeString(valIfFalse);\r\n});\r\n\r\n";
  });
templates['info_actions_pane'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"clights-info-actions\" class=\"container clights_pane clights_workspace\"\r\n     data-clightspane=\"workspace\">\r\n    <div class=\"row-fluid\">\r\n        <div class=\"span10\">\r\n            <div class=\"clights_estimate_ttl\"></div>\r\n        </div>\r\n        <div class=\"span2 clights_actions\">\r\n            <div id=\"clights-home\" class=\"clights_action\"><i class=\"icon-home icon-2x\"></i></div>\r\n            <div class=\"clights_action disabled\"><i class=\"icon-wrench icon-2x\"></i></div>\r\n            <div id=\"clights-day-for-night\" class=\"clights_action\"><i class=\"icon-eye-open icon-2x\"></i></div>\r\n            <div id=\"clights-upload\" class=\"clights_action\"><i class=\"icon-camera icon-2x\"></i></div>\r\n            <div id=\"clights-preview\" class=\"clights_action\"><i class=\"icon-picture icon-2x\"></i></div>\r\n            <div id=\"clights-logout\" class=\"clights_action\"><i class=\"icon-signout icon-2x\"></i></div>\r\n        </div>\r\n    </div>\r\n</div>\r\n";
  });
templates['layers_pane'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"clights-layers\" class=\"container-fluid clights_pane clights_workspace\"\r\n     data-clightspane=\"workspace\">\r\n    <div class=\"row-fluid\">\r\n        <div class=\"span8 clights_layers_table\">\r\n            <div class=\"row-fluid clights_thead\">\r\n                <div class=\"clights_layer_chkbox span1 clights_th\"></div>\r\n                <div class=\"clights_layer_name span3 clights_th\">Items</div>\r\n                <div class=\"clights_layer_desc span4 clights_th\">Description</div>\r\n                <div class=\"clights_layer_color span1 clights_th\">Color</div>\r\n                <div class=\"clights_layer_price span1 clights_th\">Price</div>\r\n            </div>\r\n            <div class=\"row-fluid clights_tbody\">\r\n                <div class=\"span12\"></div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n";
  });
templates['layer_items_popover'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n        <tr><td>";
  if (stack1 = helpers.name) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.name; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "</td></tr>\r\n        ";
  return buffer;
  }

  buffer += "<table id=\"clights-layer-items\" class=\"table table-striped\">\r\n    <tbody>\r\n        ";
  stack1 = helpers.each.call(depth0, depth0.itemNames, {hash:{},inverse:self.noop,fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n    </tbody>\r\n</table>\r\n";
  return buffer;
  });
templates['layer_row'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "data-color=\"";
  if (stack1 = helpers.color) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.color; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"";
  return buffer;
  }

function program3(depth0,data) {
  
  
  return " clights_add_new_row";
  }

function program5(depth0,data) {
  
  
  return " clights_selected";
  }

  buffer += "<div id=\"layer_";
  if (stack1 = helpers.id) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.id; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"\r\n     data-layerid=\"";
  if (stack1 = helpers.id) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.id; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"\r\n     ";
  stack1 = helpers['if'].call(depth0, depth0.hasColor, {hash:{},inverse:self.noop,fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n     class=\"row-fluid clights_tr";
  stack1 = helpers['if'].call(depth0, depth0.isNew, {hash:{},inverse:self.noop,fn:self.program(3, program3, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n     ";
  stack1 = helpers['if'].call(depth0, depth0.active, {hash:{},inverse:self.noop,fn:self.program(5, program5, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\">\r\n    <div class=\"clights_row_bg\"></div>\r\n    <div class=\"clights_layer_chkbox span1 clights_td clights_row_checkbox\">\r\n        <button class=\"btn btn-inverse\">\r\n            <i class=\"icon-ok\"></i>\r\n        </button>\r\n    </div>\r\n    <div class=\"clights_layer_name span3 clights_td\" data-fieldname=\"itemName\">\r\n        <span class=\"clights_click_to_add clights_caps\">Add new item</span>\r\n        <div class=\"clights_display_field\">";
  if (stack1 = helpers.name) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.name; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "</div>\r\n        <div class=\"input-append\">\r\n            <input class=\"span2\" type=\"text\" name=\"name\" id=\"\" value=\"";
  if (stack1 = helpers.name) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.name; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\">\r\n            <button class=\"clights_save_field btn btn-success\" type=\"button\">Save</button>\r\n            <!--<button class=\"clights_cancel_field_edit btn btn-danger\" type=\"button\">Cancel</button>-->\r\n        </div>\r\n\r\n    </div>\r\n    <div class=\"clights_layer_desc span4 clights_td\" data-fieldname=\"description\">\r\n        <span class=\"clights_display_field\">";
  if (stack1 = helpers.description) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.description; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "</span>\r\n        <div class=\"input-append\">\r\n            <input class=\"span2\" type=\"text\" name=\"description\" id=\"\" value=\"";
  if (stack1 = helpers.description) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.description; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\">\r\n            <button class=\"clights_save_field btn btn-success\" type=\"button\">Save</button>\r\n        </div>\r\n    </div>\r\n    <div class=\"clights_layer_color span1 clights_td clights_colorpicker\"\r\n         data-fieldname=\"color\" data-color=\"";
  if (stack1 = helpers.color) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.color; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\">\r\n        <div class=\"btn-group clights_colorpicker_dropdown\">\r\n            <button class=\"btn btn-inverse clights_swatch ";
  if (stack1 = helpers.color) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.color; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\"></button>\r\n            <button class=\"btn btn-inverse dropdown-toggle\" data-toggle=\"dropdown\">\r\n                <span class=\"caret\"></span>\r\n            </button>\r\n            <ul class=\"dropdown-menu\"></ul>\r\n        </div>\r\n    </div>\r\n    <div class=\"clights_layer_price span1 clights_td\" data-fieldname=\"price\">\r\n        <input type=\"number\" name=\"price\"\r\n               pattern=\"[0-9]+([\\.|,][0-9]+)?\" step=\"0.01\"\r\n                title=\"This should be a number with up to 2 decimal places.\"\r\n                value=\"";
  if (stack1 = helpers.price) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.price; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\">\r\n    </div>\r\n    <div class=\"clights_layer_buttons span1 clights_td clights_layer_actions\">\r\n        <button class=\"btn btn-link clights_edit\">\r\n            <i class=\"icon-pencil\"></i>\r\n        </button>\r\n        <button class=\"btn btn-link clights_remove\">\r\n            <i class=\"icon-remove\"></i>\r\n        </button>\r\n    </div>\r\n</div>";
  return buffer;
  });
templates['layer_scale_popover'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, stack2, functionType="function", escapeExpression=this.escapeExpression;


  buffer += "<div class=\"clights_layer_scale_range\"> <input type=\"range\" min=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.range),stack1 == null || stack1 === false ? stack1 : stack1.min)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\" max=\""
    + escapeExpression(((stack1 = ((stack1 = depth0.range),stack1 == null || stack1 === false ? stack1 : stack1.max)),typeof stack1 === functionType ? stack1.apply(depth0) : stack1))
    + "\" name=\"scale\" value=\"";
  if (stack2 = helpers.scale) { stack2 = stack2.call(depth0, {hash:{},data:data}); }
  else { stack2 = depth0.scale; stack2 = typeof stack2 === functionType ? stack2.apply(depth0) : stack2; }
  buffer += escapeExpression(stack2)
    + "\" /> </div>";
  return buffer;
  });
templates['login_modal'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"clights-login\" class=\"modal clights_pane clights_modal hide fade\"\r\n        data-backdrop=\"static\"\r\n        data-keyboard=\"false\">\r\n    <div class=\"modal-header\">\r\n        <h3 class=\"clights_caps\">Log In</h3>\r\n    </div>\r\n    <form id=\"clights-login-form\" class=\"form-horizontal\" style=\"margin: 0;\">\r\n        <div class=\"modal-body\">\r\n\r\n            <div class=\"control-group\">\r\n                <label class=\"control-label clights_caps\" for=\"username\">Username</label>\r\n\r\n                <div class=\"controls\">\r\n                    <input type=\"text\"\r\n                           id=\"username\" name=\"username\"\r\n                           autocapitalize=\"off\"\r\n                           autocorrect=\"off\"\r\n                           placeholder=\"username\">\r\n                </div>\r\n            </div>\r\n            <div class=\"control-group\">\r\n                <label class=\"control-label clights_caps\" for=\"password\">Password</label>\r\n\r\n                <div class=\"controls\">\r\n                    <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n        <div class=\"modal-footer clights_pane\" style=\"padding: 15px 15px 0;\">\r\n            <div class=\"control-group\">\r\n                <div class=\"controls\">\r\n                    <button type=\"submit\" class=\"btn btn-primary clights_caps\">Sign in</button>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </form>\r\n</div>";
  });
templates['modal_external'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"clights-modal-div\" class=\"modal clights_pane clights_modal hide fade\"\r\n        data-backdrop=\"static\"\r\n        data-keyboard=\"false\">\r\n		\r\n		hello world!!\r\n</div>		";
  });
templates['popovers_container'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"clights_popovers_container\" data-clightspane=\"workspace\" style=\"z-index: 2000;\">\r\n    <div class=\"clights_nopadding\"></div>\r\n</div>";
  });
templates['swatches'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = "", stack1;
  buffer += "\r\n    <li><a class=\"btn btn-small clights_swatch ";
  if (stack1 = helpers.swatch) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.swatch; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\" data-swatch=\"";
  if (stack1 = helpers.swatch) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.swatch; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\" title=\"";
  if (stack1 = helpers.name) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.name; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + "\" href=\"#\"></a></li>\r\n";
  return buffer;
  }

  stack1 = helpers.each.call(depth0, depth0.patterns, {hash:{},inverse:self.noop,fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\r\n\r\n";
  return buffer;
  });
templates['toolbar'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  var buffer = "", stack1, functionType="function", escapeExpression=this.escapeExpression, self=this;

function program1(depth0,data) {
  
  var buffer = "";
  return buffer;
  }

function program3(depth0,data) {
  
  
  return " disabled";
  }

  buffer += "<div id=\"clights-toolbar\" class=\"clights_toolbar_buttons\" data-layerid=";
  if (stack1 = helpers.layerId) { stack1 = stack1.call(depth0, {hash:{},data:data}); }
  else { stack1 = depth0.layerId; stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1; }
  buffer += escapeExpression(stack1)
    + ">\r\n    <div class=\"btn-group btn-group-vertical\">\r\n        <button id=\"clights-add-wreath\" class=\"btn\">\r\n            <i class=\"icon-wreath icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Wreath</span>\r\n        </button>\r\n        <button id=\"clights-add-bow\" class=\"btn\">\r\n            <i class=\"icon-bow icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Bow</span>\r\n        </button>\r\n        <button id=\"clights-add-lights-line\" class=\"btn\">\r\n            <i class=\"icon-straight-lights icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Line</span>\r\n        </button>\r\n        <button id=\"clights-add-lights-curve\" class=\"btn\">\r\n            <i class=\"icon-curve-lights icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Curve</span>\r\n        </button>\r\n        <button id=\"clights-remove-item\" class=\"btn btn-danger";
  stack1 = helpers['if'].call(depth0, depth0.selection, {hash:{},inverse:self.program(3, program3, data),fn:self.program(1, program1, data),data:data});
  if(stack1 || stack1 === 0) { buffer += stack1; }
  buffer += "\">\r\n            <i class=\"icon-trash icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Remove</span>\r\n        </button>\r\n        <button id=\"clights-scale-layer\" class=\"btn\">\r\n            <i class=\"icon-resize-full icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Scale</span>\r\n        </button>\r\n        <button id=\"clights-layer-info\" class=\"btn\">\r\n            <i class=\"icon-details icon-1x\"></i>\r\n            <span class=\"clights_btn_label\">Layer</span>\r\n        </button>\r\n        <button id=\"clights-toggle-tools\" class=\"btn primary clights_tools_expand expanded\">\r\n            <i class=\"icon-double-angle-down icon-1x clights_collapse\"></i>\r\n            <span class=\"clights_btn_label\">Hide</span>\r\n            <i class=\"icon-double-angle-up icon-1x clights_expand\"></i>\r\n            <span class=\"clights_btn_label\">Show</span>\r\n        </button>\r\n    </div>\r\n</div>";
  return buffer;
  });
templates['upload_modal'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<div id=\"clights-upload-modal\" class=\"modal clights_pane clights_modal hide fade\">\r\n    <div class=\"modal-header\">\r\n        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\r\n        <h3 class=\"clights_caps\">Upload photo to start bid</h3>\r\n    </div>\r\n    <div class=\"modal-body\">\r\n        <form class=\"form-inline\" action=\"\">\r\n            <input type=\"file\" name=\"bid_photo\" id=\"bid-photo\">\r\n        </form>\r\n    </div>\r\n    <div class=\"modal-footer clights_pane\">\r\n        <a href=\"#\" class=\"btn clights_caps\" data-dismiss=\"modal\">Cancel</a>\r\n        <a href=\"#\" id=\"clights-upload-bid-photo\" class=\"btn btn-primary clights_caps\">Upload</a>\r\n    </div>\r\n</div>";
  });
templates['viewport'] = template(function (Handlebars,depth0,helpers,partials,data) {
  this.compilerInfo = [4,'>= 1.0.0'];
helpers = this.merge(helpers, Handlebars.helpers); data = data || {};
  


  return "<canvas id=\"canvas\"></canvas>\r\n";
  });
})();