/**
 * Created by Sal on 5/17/13 at Time: 10:06 PM Eastern US time.
 */
var SWATCH_COLORS = [
        "white",
        "red",
        "green",
        "blue",
        "amber",
        "white_red",
        "white_green",
        "white_blue",
        "white_amber",
        "white_white_red",
        "white_white_green",
        "white_white_blue",
        "white_white_amber"
    ]
    , LIGHT_PATTERNS = [
        { name: 'All White', patternNames: ['clear'], patternIds: [3], swatch: 'white' },
        { name: 'All Red', patternNames: ['red'], patternIds: [4], swatch: 'red' },
        { name: 'All Green', patternNames: ['green'], patternIds: [5], swatch: 'green' },
        { name: 'All Blue', patternNames: ['blue'], patternIds: [7], swatch: 'blue' },
        { name: 'All Amber', patternNames: ['amber'], patternIds: [6], swatch: 'amber' },
        { name: 'White Red', patternNames: ['clear', 'red'], patternIds: [3, 4], swatch: 'white_red' },
        { name: 'White Green', patternNames: ['clear', 'green'], patternIds: [3, 5], swatch: 'white_green' },
        { name: 'White Blue', patternNames: ['clear', 'blue'], patternIds: [3, 7], swatch: 'white_blue' },
        { name: 'White Amber', patternNames: ['clear', 'amber'], patternIds: [3, 6], swatch: 'white_amber' },
        { name: 'White White Red', patternNames: ['clear', 'clear', 'red'], patternIds: [3, 3, 4], swatch: 'white_white_red' },
        { name: 'White White Green', patternNames: ['clear', 'clear', 'green'], patternIds: [3, 3, 5], swatch: 'white_white_green' },
        { name: 'White White Blue', patternNames: ['clear', 'clear', 'blue'], patternIds: [3, 3, 7], swatch: 'white_white_blue' },
        { name: 'White White Amber', patternNames: ['clear', 'clear', 'amber'], patternIds: [3, 3, 6], swatch: 'white_white_amber' },
        { name: 'All Colors', patternNames: ['clear', 'red', 'green', 'blue', 'amber'], patternIds: [3, 4, 5, 7, 6], swatch: 'all_colors' }
    ]
    , userAgent = userAgent || navigator.userAgent
    , iOS = iOS || userAgent.match(/(iPad|iPhone|iPod)/i)
    , pickEvent = iOS ? 'touchstart' : 'click'
    , layers = {}
    , imageRatio
    , canvasRatio
    , padX
    , padY
    , imageScale = {}
    , house
    , imageSrc
    , oFReader = new FileReader()
    , rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i
    , redraw
    , updateAndRedraw
    // default per-layer value referenced by items in the layer to determine their size.
    , customer
    , project
    , dealer
    , userObj
    , isAdmin
    , staticSize = 35
    , staticItems = []
    , LIGHT_HEIGHT = 20
    , LIGHT_HEIGHT_TO_SPACING_RATIO = 1.2;

/* User Session functions */

function checkSession() {
    $.get('api/dealer/current', {}, function (result) {
        if (result.id != 0) {
            dealer = result.id;
            $.get('api/dealer/' + dealer, {}, function (result) {
                userObj = result;
                $(document).trigger('clights:userSessionCreated')
            });
        } else {
            $(document).trigger('clights:userSessionNeeded')
        }
    });
}

function checkProject() {
    $.get('api/project/current', {}, function (result) {
        if (result.id != 0) {
            project = result.id;
            $(document).trigger('clights:projectSelected')
        } else {
            $(document).trigger('clights:projectNeeded')
        }
    });
}

function presentLoginModal () {
    $(Handlebars.templates.login_modal())
        .appendTo('body')
        .modal();
}

function presentDealerCmModal () {
    $.get('api/dealer/current', {}, function (result) {
        var type = result['admin'] ? 'dealer' : 'customer';
        $.get('api/' + type, {}, function (result) {
            $('#clights-dealer-cm-modal').remove();
            $(Handlebars.templates.dealer_cm_modal({
                layout: isHandheld() ? 'handheld' : isPortraitTabletOrLess() ? 'tablet' : 'desktop',
                isHandheld: isHandheld(),
                type: type,
                admin: type == 'dealer',
                user: userObj,
                hasItems: result.length > 0,
                items: result,
                isNew: true
            }))
                .appendTo('body')
                .modal();
            refreshDealerCmDropdown(type, result);
            resetDealerCmForm();
        });
    });
}

function validateDealerCmForm ($form) {
    var $modal = $form.parents('.clights_modal')
        , type = $modal.attr('data-showing')
        , _form = _($form.serializeArray())
        , data = _.object(
            _form.map(function (o) {
                return o.name
            }).value(),
            _form.map(function (o) {
                return o.value.trim() == ''
                    ? null
                    : o.name == 'bid_date'
                        ? Date.create(o.value).getTime()
                        : o.value.trim()
            }).value()
        )
        , hasRequiredFields = type == 'dealer'
            ? (!!data.username && !!data.password && !!data.name && !!data.city && !!data.state)
            : (!!data.name && !!data.address_1 && !!data.city && !!data.phone);
    return {
        _form: _form,
        hasRequiredFields: hasRequiredFields,
        missingFields: hasRequiredFields
            ? _.keys(
            _form.reduce(function (result, field) {
                result[field.name] = field.value;
                return result;
            }, {}))
            : null,
        data: data
    }
}

function refreshDealerCmDropdown(type, items) {
    var dropdownPopulate = function (items) {
        $('#clights-dealer-cm-dropdown')
            .replaceWith(
                Handlebars.templates.dealer_cm_dropdown({
                    type: type,
                    hasItems: items.length > 0,
                    items: items
                })
            );
    };
    if (_.isUndefined(items)) {
        $.get('api/' + type, {}, function (result) {
            dropdownPopulate(result)
        });
    } else {
        dropdownPopulate(items)
    }
}

function resetDealerCmForm() {
    var $modal = $('#clights-dealer-cm-modal')
        , $form = $('#clights-dealer-cm-form')
        , type = $modal.attr('data-showing');
    $form.html(
            Handlebars.templates.dealer_cm_modal_form({
                layout: isHandheld() ? 'handheld' : isPortraitTabletOrLess() ? 'tablet' : 'desktop',
                isHandheld: isHandheld(),
                type: type,
                admin: type == 'dealer'
            })
        )
        .attr({'data-itemtype': 'new'});
    $('#clights-dealer-cm-save, #clights-dealer-cm-delete')
        .toggleClass('disabled', true);
    $('#clights-dealer-cm-gotobid').remove();	$('#clights-dealer-cm-gotoquote').remove();
}

function loadDealerCmForm(type, itemId) {
    var formLoadCallback = function (result) {
        $('#clights-dealer-cm-form')
            .html(
                Handlebars.templates.dealer_cm_modal_form({
                    layout: isHandheld() ? 'handheld' : isPortraitTabletOrLess() ? 'tablet' : 'desktop',
                    isHandheld: isHandheld(),
                    type: type,
                    admin: type == 'dealer',
                    item: result
                })
            )
            .attr({
                'data-itemid': itemId,
                'data-itemtype': type
            });
    };
    $.get('api/' + type + '/' + itemId, {}, function (result) {
        $('#clights-dealer-cm-gotobid').remove();		$('#clights-dealer-cm-gotoquote').remove();
        if (type == 'customer') {
            refreshBidButton(itemId)
        }
        formLoadCallback(result)
    })
}

function refreshBidButton(cmId, callback) {
    $.get('api/project/customer/' + cmId, {}, function (project) {
        $('#clights-dealer-cm-gotobid').remove();		$('#clights-dealer-cm-gotoquote').remove();				
        $('#clights-dealer-cm-modal .modal-footer')
            .append(
                Handlebars.templates.bid_button({
                    hasBid: !!project,
                    projectId: project && project.id || 0
                })
            );
        if (_.isFunction(callback)) {
            callback(Array.prototype.slice.apply(arguments, 2))
        }
    });
}

/* House Image Initialization functions */

oFReader.onload = function (oFREvent) {
    imageSrc = oFREvent.target.result;
    $.ajax({
        url: 'api/project/' + project,
        data: {
            amount: $('.clights_total_amt').text(),
            image: imageSrc
        },
        type: 'PUT'
    }).done(function (result) {
            console.log(result);
            var newImg, fit;
            newImg = new Image();
            newImg.onload = function () {
                if (_.isUndefined(CFab.canvas)) {
                    $(document).trigger('clights:projectSelected')
                } else {
                    CFab.canvas.remove(CFab.house);
                    fit = CFab.imageCenterFit(newImg);
                    CFab.house = new fabric.Image(newImg, {
                        left: (fit.scale.width / 2) + fit.padX,
                        top: (fit.scale.height / 2) + fit.padY,
                        width: fit.scale.width,
                        height: fit.scale.height,
                        selectable: false
                    });
                    CFab.canvas.add(_.extend(CFab.house, {_fit: fit, _isHouseImg: true}));
                    CFab.applyDayForNight(undefined, true);
                }
            };
            newImg.src = imageSrc;
        });
};

function loadImageFile() {
    if (document.getElementById("bid-photo").files.length === 0) { return; }
    var oFile = document.getElementById("bid-photo").files[0];
    if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }
    oFReader.readAsDataURL(oFile);
}

function getImageUrl () {
    $(Handlebars.templates.upload_modal())
        .appendTo('body')
        .modal();
}

function getProjectImage (project, callback) {
    house = new Image();
    if (_.isUndefined(imageSrc)) {
        $.get('./api/project/' + project, {}, function (result) {
            // console.log(result);
            imageSrc = result.image;
            house.addEventListener('load', callback, false);
            house.src = imageSrc;
        });
    } else {
        house.src = imageSrc;
        house.addEventListener('load', callback, false);
    }
}

function getLayer(id) {
    var url = _.isUndefined(id)
            ? 'api/project/layer/' + project
            : 'api/project/layer/' + project + '/' + id
        , data;
    $.ajax({
        url: url,
        type: 'GET',
        async: false
    })
        .done(function (json) {
            data = _.isArray(json)
                ? _.map(json, function(layer) { return parseLayer(layer) })
                : parseLayer(json)
        });
    return data;
}

function parseLayer(json) {
    _.each(json, function(v, k) {
        if (_.contains(['id', 'project', 'scale'], k)) {
            json[k] = parseInt(v)
        } else if (_.contains(['active'], k)) {
            json[k] = !!parseInt(v)
        } else if (_.contains(['price'], k)) {
            json[k] = parseFloat(v)
        } else if (_.contains(['items'], k)) {
            json[k] = v == "" ? [] : JSON.parse(v) || []
        } else if (_.contains(['color'], k)) {
            json['hasColor'] = /\S/.test(v);
        }

    });
    layers[json.id] = json;
    return json;
}

function itemsJSONForLayer(layerId) {
    return CFab.itemsInLayer(layerId)
        .map(function (item) {
            var json;
            switch (item.itemType) {
                case 'static':
                    json = _.pick(item, ['_id', 'id', 'pos', 'type', 'layerId', 'itemType', 'scaleX', 'scaleY']);
                    break;
                case 'straight':
                case 'curve':
                    json = _.extend(item, {selected: false});
                break;
                default:
                    json = {};
                    break;
            }
            return json
        })
        .value();
}

function activeLayer () {
    return $('#clights-toolbar').attr('data-layerid');
}

function _updateLayer(id, fields, callback) {
    var items;
    if (_.contains(_.keys(fields), 'items')) {
        items = _(JSON.parse(fields.items))
            .filter(function (item) {
                if (item.itemType == 'static') return true;
                var isMissingPosData = false, m;
                if (item.itemType == 'straight') {
                    m = JSON.parse(JSON.stringify([item.markers[0], item.markers[1]]));
                    item.markers = m;

                } else if (item.itemType == 'curve') {
                    m = JSON.parse(JSON.stringify([item.markers[0], item.markers[1], item.markers[2]]));
                    item.markers = m;
                }
                //item.markers = _.head(item.markers, item.itemType == 'straight' ? 2 : 3);
                _(item.markers)
                    .each(function (marker) {
                        // set isMissingPosData to `true` if the marker is missing _pos, _pos.left or _pos.right
                        if (!_.has(marker, '_pos')
                            || !_.has(marker._pos, 'left')
                            || !_.has(marker._pos, 'top')) {
                            isMissingPosData = true;
                            console.log('Missing pos data: omitting items:\n' + JSON.stringify(item));
                        }
                    });
                return isMissingPosData === false ;
            })
            .value();
        fields.items = JSON.stringify(items);
    }
    if (_.isEmpty(fields)) {
        console.log('No more fields. Cancelling update');
        return;
    }
    $.ajax({
        url: './api/layer/' + id,
        data: _.extend({id: id}, fields),
        type: 'PUT'
    }).done(function (result) {
            if (result.success) {
                getLayer(id)
            }
            _.isFunction(callback) && callback(result)
        });
}

var updateLayer = _.throttle(_updateLayer, 1000);

function addStaticItem(options) {
    var newItem = CFab.getItem(options.id);
    newItem.image = new Image();
    newItem.image.onload = function () {
        newItem = _.extend(
            newItem,
            {
                _id: _.uniqueId('layer' + options.layerId + '_'),
                layerId: options.layerId,
                itemType: 'static'
            },
            options
        );
        staticItems.push(newItem);
        drawStaticItems();
    };
    newItem.image.src = newItem.data;
}

function drawStaticItems(layerId) {
    var ids = _.pluck(CFab.canvas.getObjects(), '_id')
        , scale;
    _.each(staticItems, function (item) {
        scale = toLayerScale(item.layerId, staticSize);
        if (_.contains(ids, item._id) && _.has(item, '_item')) {
            try {
                CFab.canvas.item(_.indexOf(CFab.canvas.getObjects(), item._item))
                    .set({
                        left: ((CFab.house._fit.scale.width / 100) * item.pos.left) + CFab.house._fit.padX,
                        top: ((CFab.house._fit.scale.height / 100) * item.pos.top) + CFab.house._fit.padY,
                        width: scale,
                        height: scale * (item.image.width / item.image.height),
                        layerId: item.layerId,
                        lockScalingX: true,
                        lockScalingy: true,
                        hasControls: false
                    })
                    .fire('modified');
            } catch (e) {
                console.log("e:", e);
            }
        } else {
            item._item = new fabric.Image(item.image, {
                left: ((CFab.house._fit.scale.width / 100) * item.pos.left) + CFab.house._fit.padX,
                top: ((CFab.house._fit.scale.height/ 100) * item.pos.top) + CFab.house._fit.padY,
                width: scale,
                height: scale * (item.image.width / item.image.height),
                lockUniScaling: true,
                lockScalingX: true,
                lockScalingy: true,
                hasControls: false,
                _id: item._id,
                layerId: item.layerId
            });
            CFab.canvas.add(_.extend(item._item, {_id: item._id}));
            item._item.on('modified', _.bind(function () {
                var pos = CFab.percentPos(this.left, this.top);
                item.pos = { left: pos.x, top: pos.y };
                this.setCoords();
                updateLayer(
                    item.layerId,
                    {
                        items: JSON.stringify(itemsJSONForLayer(item.layerId))
                    }
                );
            }, item._item));
            item._item.on('selected', _.bind(function () {
                CFab.layerEnsureSelected(item.layerId)
            }, item._item));
            item._item.fire('modified');

        }
    });
}

function addLayer(options) {
    options = _.defaults(
        { _id: _.uniqueId() },
        options,
        {color: 'white'}
    );
    $('#clights-layers .clights_tbody .span12')
        .append(Handlebars.templates.layer_row(options));
}

function layerIsVisible(layerId) {
    return $layerRow(layerId).hasClass('clights_selected')
}

function $layerRow(layerId) {
    return $('#clights-layers .clights_tr[data-layerid="' + layerId + '"]')
}

var $_layerRow = $layerRow;

function refreshLayers() {
    var layers = getLayer();
    CFab.lightPaths = [];
    staticItems = [];
    CFab.objch().filter(function(o){return !_.has(o, '_isHouseImg')}).each(function(o){CFab.canvas.remove(o)});
    $('#clights-layers .clights_tbody .span12').empty();
    _(layers).each(function(layer) {
        $('#clights-layers .clights_tbody .span12')
            .append(Handlebars.templates.layer_row(layer));
        if (!_.isEmpty(layer.items)) {
            _.each(layer.items, function (item) {
                if (item.itemType == 'static') {
                    addStaticItem(_.extend({layerId: layer.id}, item));
                } else if (item.itemType == 'straight' || item.itemType == 'curve') {
                    CFab.lightPaths.push(_.defaults(item, {selected: false}));
                    if (item.itemType == 'straight') {
                        CFab.drawStraightPath(item);
                        //console.log("refreshLayers(): straight path item.markers:\n", item.markers);
                    }
                    if (item.itemType == 'curve') {
                        CFab.drawCurvePath(item)
                    }
                    _.each(item.markers, function (marker, idx) {
                        //console.log("idx:", idx);
                        CFab.setPathMarkerPos({
                            pathId: item._id,
                            pathPt: marker.pathPt,
                            pos: marker._pos,
                            attrs: {
                                visible: false
                            }
                        });
                    });
                    if (item.itemType == 'straight') CFab.setLinePos({ pathId: item._id, attrs: { visible: true }}, {message: 'refreshLayers'});
                    if (item.itemType == 'curve') CFab.setCurvePos({ pathId: item._id, attrs: { visible: true }}, {message: 'refreshLayers'});
                }
            })
        }
    });
    addLayer({isNew: true});
}

function destroyPopovers() {
    $('#clights-scale-layer').popover('destroy');
    $('#clights-layer-info').popover('destroy');
    _.defer(function(){
        $('#clights_popovers_container .popover').remove();
    });
}

function isPortraitTabletOrLess() {
    return Modernizr.mq('only screen and (max-width: 767px)')
}

function isHandheld() {
    return Modernizr.mq('only screen and (max-width: 480px)')
}

function updateTotal() {
    var total = 0
        , estimateBoxHeight
        , maxFontSize
        , newFontSize;
    total = _($('#clights-layers .clights_tbody .clights_tr.clights_selected'))
        .map(function (row) {
            var priceInput = $(row).find('input[name="price"]');
            var priceVal = (!!priceInput.val() && !_.isNaN(parseFloat(priceInput.val())))
                ? priceInput.val()
                : 0;
            return parseFloat(priceVal)
        })
        .reduce(function (memo, num) {
            return memo + num
        }, 0);
    $('.clights_estimate_ttl')
        .html( Handlebars.templates.estimate_ttl({ isHandheld: isPortraitTabletOrLess() }) );
    if (isPortraitTabletOrLess()) {
        $('.clights_total_767max').text(total.format(2))
    } else {
        estimateBoxHeight = $('.clights_estimate_ttl').height();
        maxFontSize = estimateBoxHeight / 3;
        $('.clights_total_amt')
            .find('span').text(total.format(2)).end()
            .textfill(maxFontSize);
        newFontSize = $('.clights_total_amt span').css('font-size');
        $('.clights_total_amt').css({
            fontSize: newFontSize,
            lineHeight: newFontSize
        });
    }
    //console.log(total);
}

// Initialize workspaces
function refreshWorkspaces() {
    customer = undefined
        , project = undefined
        , dealer = undefined
        , userObj = undefined
        , isAdmin = undefined;

    if (!_.isUndefined(CFab.canvas)) {
        CFab.canvas = undefined;
    }
    house = undefined;
    imageSrc = undefined;
    layers = [];
    staticItems = [];
    CFab.lightPaths = [];

    $('#clights-viewport').html(Handlebars.templates.viewport());
    $('[data-clightspane="workspace"]').remove();
    $(Handlebars.templates.layers_pane()).insertAfter('#clights-viewport');
    $(Handlebars.templates.info_actions_pane()).insertAfter('#clights-layers');
    $(Handlebars.templates.popovers_container()).insertAfter('#clights-info-actions');

    /* APPLICATION TOOLBAR BINDINGS */
    // Home button event binding (triggers this function)
    $('#clights-home').on(pickEvent, function (event) {
        $evtTgt = $(event.target).hasClass('clights_action')
            ? $(event.target)
            : $(event.target).parents('.clights_action');
        refreshWorkspaces();
    });
    // Upload modal button binding
    $('#clights-upload').on(pickEvent, function (event) {
        $evtTgt = $(event.target).hasClass('clights_action')
            ? $(event.target)
            : $(event.target).parents('.clights_action');
        getImageUrl();
    });
    $('#clights-preview').on(pickEvent, function(event) {
        $('#clights-viewport').width(1024).height(768);
        CFab.redrawHouse();
        $('#clights-viewport').height(CFab.house.height);
        CFab.redrawHouse();
        $('#clights-viewport').height(CFab.house.height);
        redraw();
        _.delay(function() {
            window.open(CFab.canvas.toDataURL({format: 'png'}), '_blank');
            $('#clights-viewport').attr('style', '');
            redraw();
        }, 500);
    });
    
	$('#clights-day-for-night').on('click', function (event) {
            var houseIndex = CFab.houseIndex(); 
			var vl = 0;
			if(CFab.canvas.item(houseIndex).filters[0] != undefined)
			{
				console.log("adjustment found on reinvoke: " + CFab.canvas.item(houseIndex).filters[0].adjustment);
				vl = CFab.canvas.item(houseIndex).filters[0].adjustment;
			}
			else
			{
				console.log("Found undefined");
			}
            if (_.isEmpty($('.clights_layer_scale_range'))) {
                $('#clights-day-for-night').popover({
                    placement: 'left',
                    html: true,
                    title: 'Scale for night lights',
                    container: '#clights_popovers_container',
                    content: Handlebars.templates.daylight_scale_popover({
                        range: {min: 0, max: 50},
                        nightvision: vl
                    }),
                    trigger: 'manual'
                })
                    .popover('show');
            } else {
                $('#clights-day-for-night').popover('destroy');
            }
        });
	
    redraw = _.throttle(function () {
        updateTotal();
        CFab.redrawHouse();
        drawStaticItems();
        //noinspection JSValidateTypes
        _(CFab.lightPaths)
            .pluck('_id')
            .each(function (pathId) {
                CFab.updatePathPos(pathId);
            });
        CFab.canvas.renderAll();
    }, 250);

    updateAndRedraw = _.throttle(function (id, fields) {
        _.each(fields, function(value, key) {
            fields[key] = _.isFunction(value) ? value() : value;
        });
        console.log("updateAndRedraw: fields:", fields);
        updateLayer(id, fields, redraw);
    }, 500);

    checkSession();
}

function deleteCustomer(cmId) {
    var itemId = cmId
        , projectIds;

    $.get('api/project', {}, function (result) {
        projectIds = _(result)
            .where({customer: itemId})
            .pluck('id')
            .value();
        _.each(projectIds, function (id) {
            deleteLayers(id);
            console.log('deleting project ' + id);
            $.ajax({
                url: 'api/project/' + id,
                type: 'DELETE',
                async: false
            })
                .done(function (result) {
                    console.log(result)
                });
        });
        console.log('deleting customer ' + itemId);
        $.ajax({
            url: 'api/customer/' + itemId,
            type: 'DELETE',
            async: false
        })
            .done(function (result) {
                console.log(result);
                resetDealerCmForm();
                refreshDealerCmDropdown($('#clights-dealer-cm-modal').attr('data-showing'));
            });
    });
}

function deleteLayers(projectId) {
    var layerIds;
    $.get('api/layer', {}, function (result) {
        layerIds = _(result)
            .where({customer: projectId})
            .pluck('id')
            .value();
        _.each(layerIds, function (id) {
            console.log('deleting layer ' + id);
            $.ajax({
                url: 'api/layer/' + id,
                type: 'DELETE',
                async: false
            })
                .done(function (result) {
                    console.log(result)
                });
        });

    });
}

function deleteDealer(dealerId) {
    var itemId = dealerId;
    if (dealerId == dealer) throw ("Error! Cannot delete current user.");
    $.get('api/customer', {}, function (customers) {
        console.log('deleting customers...');
        _.each(customers, function (cm) {
            console.log(cm.id);
            deleteCustomer(cm.id);
        })
    });
    console.log('deleting dealer ' + itemId);
    $.ajax({
        url: 'api/dealer/' + itemId,
        type: 'DELETE',
        async: false
    })
        .done(function (result) {
            console.log(result);
            resetDealerCmForm();
            refreshDealerCmDropdown($('#clights-dealer-cm-modal').attr('data-showing'));
        });
}

$(function() {
    $(document)
        /* Login modal submit event */
        .on('submit', '#clights-login-form', function (event) {
            var _this = this;
            event.preventDefault();
            $.post('api/login', $(this).serialize(), function (result) {
                console.log(result);
                $('body > .clights_modal').modal('hide');
                checkSession();
            });
        })
        /* Logout button event binding */
        .on(pickEvent, '#clights-logout', function (event) {
            event.preventDefault();
            $.get('api/logout', {}, function (result) {
                window.open(document.location.pathname, '_self');
            })
        })
        /* DEALER/CUSTOMER MODAL EVENT BINDINGS */
        /* Selection of dealer/cm from dropdown */
        .on(pickEvent, '#clights-dealer-cm-dropdown li a', function (event) {
            event.preventDefault();
            if ($(event.target).hasClass('disabled')) { return; }
            var $itemLi = event.target.tagName == 'LI'
                    ? $(event.target)
                    : $(event.target).parents('li')
                , $dropdown = $('#clights-dealer-cm-dropdown')
                , type = $dropdown.attr('data-type')
                , itemId = $itemLi.attr('data-itemid')
                , isSelf = (type == 'dealer') && parseInt(itemId) == dealer;
            $('#clights-dealer-cm-delete').toggleClass('disabled', isSelf);
            loadDealerCmForm(type, itemId);
        })
        // Binding for 'New' button in dealer/cm modal
        .on(pickEvent, '#clights-new-cm', function (event) {
            resetDealerCmForm();
        })
        // Binding for value changing in dealer/cm modal form
        .on('keyup change', '#clights-dealer-cm-form input', function (event) {
            var $form = $('#clights-dealer-cm-form')
                , parsedForm = validateDealerCmForm($form);
            $('#clights-dealer-cm-save').toggleClass('disabled', !parsedForm.hasRequiredFields);
        })
        // Binding for dealer/cm modal SAVE button
        .on(pickEvent, '#clights-dealer-cm-save:not(.disabled)', function (event) {
            event.preventDefault();
            var $modal = $('#clights-dealer-cm-modal')
                , $form = $('#clights-dealer-cm-form')
                , itemId = $form.attr('data-itemid')
                , type = $modal.attr('data-showing')
                , formItemType = $form.attr('data-itemtype')
                , isSelf = type == 'dealer' && parseInt($form.attr('data-itemid')) == dealer
                , parsedForm = validateDealerCmForm($form)
                , saveMethod = formItemType == 'new' ? 'POST' : 'PUT'
                , saveUrl = saveMethod == 'POST'
                    ? 'api/' + type
                    : 'api/' + type + '/' + itemId
                , saveData = saveMethod == 'POST'
                    ? _.extend(parsedForm.data, type == 'customer' ? {dealer: dealer} : {})
                    : _.extend({id: itemId}, parsedForm.data);
            if (!parsedForm.hasRequiredFields) {
                $('#clights-dealer-cm-modal').append(
                    Handlebars.templates.alert({
                        type: 'error',
                        message: 'Missing required fields: ' + parsedForm.missingFields.join(', ') + '.'
                    })
                );
            }
            $.ajax({
                url: saveUrl,
                data: saveData,
                type: saveMethod
            }).done(function (result) {
                if (result.success) {
                    $('#clights-dealer-cm-modal').append(
                        Handlebars.templates.alert({type: 'success', message: 'Saved.'})
                    );
                    $('#clights-dealer-cm-delete').toggleClass('disabled', isSelf);
                    refreshDealerCmDropdown(type);
                    if (formItemType == 'new') {
                        loadDealerCmForm(type, result.id);
                        if (type == 'customer') {
                            refreshBidButton(result.id);
                        }
                    }
                } else {
                    $('#clights-dealer-cm-modal').append(
                        Handlebars.templates.alert({type: 'error', message: 'Could not save.'})
                    )
                }
            });
        })
        // Binding for dealer/cm modal DELETE button
        .on(pickEvent, '#clights-dealer-cm-delete:not(.disabled)', function (event) {
            event.preventDefault();
            var $deleteBtn = $('#clights-dealer-cm-delete')
                , $modal = $('#clights-dealer-cm-modal')
                , $form = $('#clights-dealer-cm-form')
                , itemId = $form.attr('data-itemid')
                , type = $modal.attr('data-showing')
                , isSelf = (type == 'dealer') && parseInt($form.attr('data-itemid')) == dealer
                , confirming = $deleteBtn.text() == 'Confirm';
            if (!confirming) {
                $deleteBtn.popover({
                    placement: 'top',
                    html: true,
                    title: 'Delete ' + $('#clights-cm-name').val() + '?',
                    container: '#clights_popovers_container',
                    content: Handlebars.templates.delete_confirm_popover({
                        type: type,
                        isDealer: type == 'dealer'
                    }),
                    trigger: 'manual'
                })
                    .popover('show');
                $('#clights-confirm-delete').parents('.popover').css({zIndex: 2000});
                $deleteBtn.text('Confirm');
            } else {
                destroyPopovers();
                console.log('api/' + type + '/' + itemId);
                if (type == 'customer') {
                    deleteCustomer(itemId);
                    $deleteBtn.text('Delete');
                } else if (type == 'dealer') {
                    deleteDealer(itemId);
                    $deleteBtn.text('Delete');
                }
            }
        })
        // cancel DELETE
        .on(pickEvent, '#clights-cancel-delete', function (event) {
            var $deleteBtn = $('#clights-dealer-cm-delete');
            $deleteBtn.text('Delete');
            destroyPopovers();
        })				.on(pickEvent, '#clights-dealer-cm-gotoquote', function (event) {				event.preventDefault();           var $evtTgt = $(event.target);		   var $form = $('#clights-dealer-cm-form');           var customerId = $form.attr('data-itemid');		   var projectId = $evtTgt.attr('data-projectid');		   console.log("customerId" + customerId);		   console.log("projectId" + projectId);		   		   var urltoopen = "api/dealercheck.php?cid=" + customerId;		   		   if(projectId != undefined)		   {			  urltoopen += "&pid=" + projectId;			}  		   		   console.log("url to open is" + urltoopen);		   var bodWidth = $('body').innerWidth();		   var iFrameWidth = bodWidth - 100;		   var leftMargin = "-" + (iFrameWidth / 2) + "px";		   console.log("leftMargin" + leftMargin)		   $md = $(Handlebars.templates.modal_external());		   $md.find(".modal-iframe").attr("src", urltoopen);		   $md.find(".modal-iframe").attr("width", iFrameWidth);		   $md.attr("style", "margin-left: " + leftMargin);		   $md.appendTo('body').modal();		   	        })
        // Binding for dealer/cm modal Go To Bid button
        .on(pickEvent, '#clights-dealer-cm-gotobid', function (event) {
            event.preventDefault();
            var $evtTgt = $(event.target)
                , $form = $('#clights-dealer-cm-form')
                , itemId = $form.attr('data-itemid')
                , actionType = $evtTgt.attr('data-action')
                , projectId = $evtTgt.attr('data-projectid');									project = parseInt(projectId);			$.get('./api/project/image/' + project, {}, function (result) 			{				if(result.image != "")				{					$('#clights-dealer-cm-modal').modal('hide');					$(document).trigger('clights:projectSelected')				}				else				{					$('#clights-dealer-cm-modal').modal('hide');					_.defer(getImageUrl);				}			});
        })
        // Binding for dealer/cm modal footer buttons to dismiss any current alerts
        .on(pickEvent, '#clights-dealer-cm-actions > .btn', function (event) {
            $('.alert').alert('close');
        })
        /*  LAYER EVENT BINDINGS */
        .on(pickEvent, '.clights_colorpicker_dropdown .dropdown-toggle', function (event) {
            var $layerRow = $(event.target).parents('.clights_tr');
            $('#clights-layers .clights_tr').removeClass('clights_highest_row');
            $layerRow.addClass('clights_highest_row');
        })
        .on(pickEvent, '.clights_colorpicker_dropdown:not([_clswatches="1"]) .btn', function (event) {
            var $btnGroup = $(this).hasClass('clights_colorpicker_dropdown')
                ? $(this)
                : $(this).parents('.clights_colorpicker_dropdown');
            $btnGroup.attr('_clswatches', 1);
            $('.dropdown-menu', $btnGroup)
                .html(Handlebars.templates.swatches({patterns: LIGHT_PATTERNS}));
            //TODO: make sure colorpicker is positioned so as to be completely visible
        })
        /* Update color event */
        .on(pickEvent, '.clights_colorpicker_dropdown .dropdown-menu li a', function (event) {
            //event.preventDefault();
            var $evtTgt = $(event.target)
                , $currentSwatch = $(this).parents('.clights_colorpicker_dropdown').find('button.btn.clights_swatch')
                , swatchName = $(event.target).attr('data-swatch')
                , $fieldCell = $currentSwatch.parents('.clights_colorpicker')
                , $layerRow = $evtTgt.parents('.clights_tr')
                , layerId = $layerRow.attr('data-layerid');
            $currentSwatch
                .removeClass(_(LIGHT_PATTERNS).pluck('swatch').value().join(' '))
                .addClass(swatchName);
            $layerRow.attr('data-color', swatchName);
            updateLayer(layerId, {color: swatchName});
            CFab.objch({layerId: layerId})
                .filter(function (light) {
                    // don't include static image items
                    return _.has(light, 'pathId')
                })
                .each(function (light) {
                    light.remove();
                });
            CFab.objch()
                .filter(function (item) {
                    return (item.type == 'line' || item.type == 'path') && item._id.startsWith('layer' + layerId)
                })
                .each(function (path) {
                    path.fire('modified');
                    if (path.type == 'path') {
                        console.log(path)
                    }
                });
            // Using defer to ensure rendering the current canvas state
            // is the last operation on the stack.
            _.delay(function(){ CFab.canvas.renderAll() }, 250);
        })
        .on(pickEvent, '.clights_add_new_row', function(event) {
            event.preventDefault();
            var layer
                , $rowEl;
            $rowEl = $(event.target).hasClass('clights_add_new_row')
                ? $(event.target)
                : $(event.target).parents('.clights_add_new_row');
            $.ajax({
                url: './api/layer',
                data: {project: project, active: 1},
                type: 'POST',
                async: false
            })
                .done(function (result) {
                    layer = getLayer(result.id);
                });
            $rowEl.replaceWith(Handlebars.templates.layer_row(layer));
            addLayer({isNew: true});
        })
        // layer checkbox toggle binding
        .on(pickEvent, '.clights_tr:not(.clights_add_new_row) .clights_row_checkbox .btn', function(event) {
            event.stopImmediatePropagation();
            var $layerRow = $(event.target).parents('.clights_tr')
                , editing = $layerRow.hasClass('clights_editing')
                , active = $(event.target).parents('.clights_tr')
                    .toggleClass('clights_selected')
                    .hasClass('clights_selected')
                , layerId = $layerRow.attr('data-layerid');
            // Ensure a layer is active if editing (i.e. don't do editing mode while a layer is not active)
            if (!active && editing) {
                $layerRow.find('.clights_edit').trigger(pickEvent)
            }
            updateLayer(layerId, {active: active ? 1 : 0});
            updateTotal();
            CFab.toggleLayerVisibility(layerId, active);
        })
        // Event for entering field edit mode
        .on(pickEvent, '.clights_tr:not(.clights_add_new_row) .clights_display_field', function(event) {
            var $evtTgt = $(event.target)
                , $layerRow = $evtTgt.parents('.clights_tr')
                , $inputTd = $evtTgt.parents('.clights_td')
                , layerId = $layerRow.attr('data-layerid')
                , fieldName = $inputTd.attr('data-fieldname');
            $('#clights-toolbar').remove();
            CFab.canvas.deactivateAllWithDispatch();
            destroyPopovers();
            $layerRow.replaceWith(Handlebars.templates.layer_row(getLayer(layerId)));
            refreshLayers();
            $_layerRow(layerId)
                .find('.clights_td[data-fieldname="' + fieldName + '"]')
                .addClass('clights_edit_fields')
                .find('input')
                .focus();
        })
        // text input (name, desc, price) keyup binding
        .on('keyup change', '.clights_tr input[type="text"], .clights_tr input[name="price"]', function(event) {
            var $evtTgt = $(event.target)
                , key = event.which
                , $layerRow = $evtTgt.parents('.clights_tr')
                , $inputTd = $evtTgt.parents('.clights_td')
                , layerId = $layerRow.attr('data-layerid')
                , data;
            if (key == 27) {
            } else if (key == 13 || ($evtTgt.attr('name') == 'price' && event.type == 'change') ) {
                data = _.object([$evtTgt.attr('name')], [$evtTgt.val()]);
                updateLayer(layerId, data, function () {
                    var refreshedFieldHtml = $(Handlebars.templates.layer_row(getLayer(layerId)))
                        .find('[data-fieldname="' + $inputTd.attr('data-fieldname') + '"]');
                    $inputTd.replaceWith(refreshedFieldHtml);
                })
            }
        })
        // price input keyup binding
        .on('keyup change', '#clights-layers input[name="price"]', function(event) {
            updateTotal();
        })
        .on(pickEvent, '.clights_tr input + .clights_save_field', function (event) {
            var $evtTgt = $(event.target)
                , $layerRow = $evtTgt.parents('.clights_tr')
                , $inputTd = $evtTgt.parents('.clights_td')
                , layerId = $layerRow.attr('data-layerid')
                , data;
            data = _.object([$evtTgt.prev().attr('name')], [$evtTgt.prev().val()]);
            updateLayer(layerId, data, function () {
                var refreshedFieldHtml = $(Handlebars.templates.layer_row(getLayer(layerId)))
                    .find('[data-fieldname="' + $inputTd.attr('data-fieldname') + '"]');
                $inputTd.replaceWith(refreshedFieldHtml);
            });
        })
        // edit button binding
        .on(pickEvent, '.clights_tr:not(.clights_add_new_row) .clights_edit', function(event) {
            var $layerRow = $(event.target).parents('.clights_tr')
                , editing = $layerRow.toggleClass('clights_editing').hasClass('clights_editing')
                , layerId = $layerRow.attr('data-layerid')
                , selection = _.contains(
                    CFab.itemsInLayer(layerId).pluck('_id').value(),
                    CFab.objch({active: true}).pluck('_id').first()
                );
            $('#clights-toolbar').remove();
            destroyPopovers();
            $('#clights-layers .clights_tr').not($layerRow).removeClass('clights_editing');
            // Ensure a layer is active if editing (i.e. don't do editing mode while a layer is not active)
            if (!$layerRow.hasClass('clights_selected') && editing) {
                $layerRow.find('.clights_row_checkbox .btn').trigger(pickEvent)
            }
            //console.log("selection:", selection);
            if (editing) {
                $('#clights-viewport').append(Handlebars.templates.toolbar({
                    layerId: layerId,
                    selection: selection
                }));
            }
        })
        // remove layer button binding
        .on(pickEvent, '.clights_tr:not(.clights_add_new_row) .clights_remove', function (event) {
            var $layerRow = $(event.target).parents('.clights_tr')
                , layerId = $layerRow.attr('data-layerid');
            $.ajax({
                url: './api/layer/' + layerId,
                type: 'DELETE'
            })
                .done(function(result) {
                    $layerRow.animate({
                        opacity: 0
                    }, 'easeOutQuart', function () {
                        $(this).animate({height: 0}, 500, function () {
                            $(this).remove();
                            CFab.objch()
                                .filter(function (o) {
                                    return (o._id && o._id.startsWith('layer' + layerId))
                                        || (o.layerId && o.layerId == layerId)
                                }).each(function (o) {
                                    o.remove()
                                });
                            CFab.lightPaths = _(CFab.lightPaths)
                                .filter(function (p) {
                                    return p.layerId != layerId
                                })
                                .value();
                            staticItems = _(staticItems)
                                .filter(function (i) {
                                    return i.layerId != layerId;
                                })
                                .value();
                            $('#clights-toolbar').remove();
                            destroyPopovers();
                            redraw();
                        });
                    });
                })

        })
        // Upload button (in modal) binding
        .on(pickEvent, '#clights-upload-bid-photo', function (event) {
            event.preventDefault();
            loadImageFile();
            $('#clights-upload-modal').modal('hide');
        })
        // Destroy modals after they have finished hiding
        .on('hidden', 'body > .clights_modal', function (event) {
            $(this).remove();
        })
        /* TOOLBAR BUTTON BINDINGS */
        // Hide popovers if clicking a button other than scale or layer in toolbar
        .on(pickEvent, '#clights-toolbar', function (event) {
            var $evtTgt = $(event.target).is('.btn-group > button')
                ? $(event.target)
                : $(event.target).parents('.btn-group > button');
            if (!_.contains(['clights-layer-info', 'clights-scale-layer'], $evtTgt.attr('id')) ) {
                destroyPopovers();
            }
        })
        .on(pickEvent, '#clights-add-wreath', function (event) {
            $('<div/>', {"data-itemid": 1, "data-itemtype": "static"})
                .addClass('clights_tool_action_overlay')
                .text((iOS ? 'Tap' : 'Click') + ' to place wreath' )
                .appendTo('#clights-viewport');
        })
        .on(pickEvent, '#clights-add-bow', function (event) {
            $('<div/>', {"data-itemid": 2, "data-itemtype": "static"})
                .addClass('clights_tool_action_overlay')
                .text((iOS ? 'Tap' : 'Click') + ' to place bow' )
                .appendTo('#clights-viewport');
        })
        .on(pickEvent, '.clights_tool_action_overlay[data-itemtype="static"]', function (event) {
            //TODO: check that click was on image, immediately return if not.
            if (pickEvent == 'touchstart') event.preventDefault();
            var $overlay = $('.clights_tool_action_overlay')
                , itemId = $overlay.attr("data-itemid")
                , layerId = $('#clights-toolbar').attr('data-layerid');
            var pos = CFab.eventPercentPos(event);
            addStaticItem({layerId: layerId, id: itemId, pos: pos});
            $overlay.remove();
            CFab.canvas.renderAll();
        })
        .on(pickEvent, '#clights-add-lights-line', function (event) {
            CFab.canvas.deactivateAllWithDispatch();
            var newItem = CFab.drawStraightPath({
                layerId: $('#clights-toolbar').attr('data-layerid')
            });
            $('<div/>', {"data-itemtype": "straight-path", "data-pathid": newItem._id})
                .addClass('clights_tool_action_overlay')
                .html((iOS ? 'Tap' : 'Click') + ' point on which to <strong>start</strong> lights' )
                .appendTo('#clights-viewport');
        })
        /* Add straight path button binding */
        .on(pickEvent, '.clights_tool_action_overlay[data-itemtype="straight-path"]', function (event) {
            if (pickEvent == 'touchstart') event.preventDefault();
            var $overlay = $('.clights_tool_action_overlay')
                , pos = CFab.eventPercentPos(event)
                , pathId = $overlay.attr('data-pathid')
                , marker1 = CFab.itemWhere({pathId: pathId, pathPt: 0})
                , marker2 = CFab.itemWhere({pathId: pathId, pathPt: 1});

            // Setting start line point
            if (marker1.visible == false) {
                CFab.setPathMarkerPos({
                    pathId: pathId,
                    pathPt: 0,
                    pos: pos,
                    attrs: {
                        visible: true
                    }
                });
                // Update help text
                $overlay.find('strong').text('end');
            }
            // Setting end line point
            else if (marker2.visible == false) {
                CFab.setPathMarkerPos({
                    pathId: pathId,
                    pathPt: 1,
                    pos: pos,
                    attrs: {
                        visible: true
                    }
                });
                CFab.setLinePos({
                    pathId: pathId,
                    attrs: {
                        visible: true
                    }
                });
                CFab.canvas.deactivateAllWithDispatch();
                CFab.togglePathSelection(pathId, true);

                $overlay.remove();
            }
        })
        .on(pickEvent, '#clights-add-lights-curve', function (event) {
            var newItem = CFab.drawCurvePath({
                layerId: $('#clights-toolbar').attr('data-layerid')
            });
            console.log('curve created for layerId', $('#clights-toolbar').attr('data-layerid'));
            $('<div/>', {"data-itemtype": "curved-path", "data-pathid": newItem._id})
                .addClass('clights_tool_action_overlay')
                .html((iOS ? 'Tap' : 'Click') + ' the <strong class="curve_step_side">bottom-left</strong> point to <strong class="curve_step_order">start</strong> the lights curve.' )
                .appendTo('#clights-viewport');
            console.log("newItem._id:", newItem._id);
        })
        .on(pickEvent, '.clights_tool_action_overlay[data-itemtype="curved-path"]', function (event) {
            if (pickEvent == 'touchstart') event.preventDefault();
            var $overlay = $('.clights_tool_action_overlay')
                , pos = CFab.eventPercentPos(event)
                , pathId = $overlay.attr('data-pathid')
                , marker1 = CFab.itemWhere({pathId: pathId, pathPt: 0})
                , marker2 = CFab.itemWhere({pathId: pathId, pathPt: 1})
                , marker3 = CFab.itemWhere({pathId: pathId, pathPt: 2});

            // Setting start line point
            if (marker1.visible == false) {
                CFab.setPathMarkerPos({
                    pathId: pathId,
                    pathPt: 0,
                    pos: pos,
                    attrs: {
                        visible: true
                    }
                });
                // Update help text, side
                $overlay.find('strong.curve_step_side').text('bottom-right');
                // Update help text, order
                $overlay.find('strong.curve_step_order').text('end');
            }
            // Setting end line point
            else if (marker2.visible == false) {
                var m1pos = marker1._pos;
                CFab.setPathMarkerPos({
                    pathId: pathId,
                    pathPt: 1,
                    pos: {
                        left: pos.left,
                        top: m1pos.top
                    },
                    attrs: {
                        visible: true
                    }
                });
                // Update help text
                $overlay.html('Click the <strong>highest point</strong> of the curve to finish');
            } else if (marker3.visible == false) {
                CFab.setPathMarkerPos({
                    pathId: pathId,
                    pathPt: 2,
                    pos: pos,
                    attrs: {
                        visible: true
                    }
                });
                CFab.setCurvePos({
                    pathId: pathId,
                    attrs: {
                        visible: true
                    }
                });
                CFab.itemWhere({pathId: pathId, type: 'path'}).fire('modified');
                CFab.canvas.deactivateAllWithDispatch();
                CFab.togglePathSelection(pathId, true);
                CFab.canvas.renderAll();
                $overlay.remove();
            }
        })
        /* Remove item button binding*/
        .on(pickEvent, '#clights-remove-item:not(.disabled)', function (event) {
            var layerId = $('#clights-toolbar').attr('data-layerid')
                , selectedItem = CFab.objch({active: true}).first();
            console.log("selectedItem:", selectedItem);
            CFab.removeLayerItem(selectedItem);
        })
        .on(pickEvent, "#clights-scale-layer", function (event) {
            var layerId = $('#clights-toolbar').attr('data-layerid');
            if (_.isEmpty($('.clights_layer_scale_range'))) {
                $('#clights-layer-info').popover('destroy');
                $('#clights-scale-layer').popover({
                    placement: 'left',
                    html: true,
                    title: 'Scale for items in this layer',
                    container: '#clights_popovers_container',
                    content: Handlebars.templates.layer_scale_popover({
                        range: {min: 5, max: 30},
                        scale: layers[layerId].scale
                    }),
                    trigger: 'manual'
                })
                    .popover('show');
            } else {
                $('#clights-scale-layer').popover('destroy');
            }
        })
        .on(pickEvent, '.clights_layer_scale_range > input', function(event) {
            var layerId = $('#clights-toolbar').attr('data-layerid')
                , $scaleSlider = $(event.target);
            console.log($scaleSlider.val());
            updateAndRedraw(layerId, {scale: function(){ return $scaleSlider.val() } });
        })
		
		.on(pickEvent, '.clights_daylight_scale_range > input', function(event) {
			if(event.target.value > 0)
			{
				var adjust = event.target.value * -1;
				houseIndex = CFab.houseIndex();
				fit = CFab.canvas.item(houseIndex)._fit;
				CFab.canvas.item(houseIndex).filters[0] = new fabric.Image.filters.DayForNight({ adjustment: adjust });
				CFab.canvas.item(houseIndex).set({
					left: (fit.scale.width / 2) + fit.padX,
					top: (fit.scale.height / 2) + fit.padY,
					width: fit.scale.width,
					height: fit.scale.height,
					selectable: false
				});
			}
			else
			{
				CFab.canvas.item(houseIndex).filters[0] = false;
			}
			CFab.canvas.item(houseIndex).applyFilters(CFab.canvas.renderAll.bind(CFab.canvas));
			
			console.log(CFab.canvas.item(houseIndex).filters[0].adjustment);
        })
		
        .on(pickEvent, '#clights-layer-info', function(event) {
            var $evtTgt = $(event.target)
                , $toolbar = $('#clights-toolbar')
                , layerId = $('#clights-toolbar').attr('data-layerid')
                , itemNames = {};
            _.each(layers[layerId].items, function (item) {
                itemNames[item._id] = {
                    name: (item.itemType == 'static')
                        ? _(staticItems).where({id: item.id}).first().name
                        : 'LIGHT: C-9'
                }
            });
            //console.log("itemNames:", itemNames);
            if (_.isEmpty($('#clights-layer-items'))) {
                $('#clights-layer-info, #clights-scale-layer').popover('destroy');
                $('#clights-layer-info').popover({
                    placement: 'left',
                    html: true,
                    title: layers[layerId].name,
                    container: '#clights_popovers_container .clights_nopadding',
                    content: Handlebars.templates.layer_items_popover({
                        itemNames: itemNames
                    }),
                    trigger: 'manual'
                });
                $('#clights-layer-info').popover('show');

            } else {
                $('#clights-layer-info').popover('destroy');
            }
        })
        .on(pickEvent, '#clights-toggle-tools', function(event) {
            var $evtTgt = $(event.target).hasClass('clights_tools_expand')
                    ? $(event.target)
                    : $(event.target).parents('.clights_tools_expand')
                , $toolbar = $('#clights-toolbar')
                , hidden = $evtTgt.hasClass('collapsed');
            $toolbar.find('button').not($evtTgt).toggle(hidden);
            $evtTgt
                .toggleClass('collapsed expanded');
        });

    $(document)
        .on('clights:userSessionNeeded', function () {
            presentLoginModal();
        })
        .on('clights:userSessionCreated', function () {
            checkProject();
        })
        .on('clights:projectNeeded', function () {
            presentDealerCmModal();
        })
        .on('clights:projectSelected', function () {			console.log("reached project selected");
            CFab.drawHouse();
        })
        // Fired at the end of CFab.drawHouse()
        .on('clights:houseLoaded', function () {			console.log("reached after drawhouse");
            $(window).on('resize', redraw);
            refreshLayers();
            updateTotal();
        });

    refreshWorkspaces();

//    _.delay(getImageUrl, 3000);
//    alert(navigator.userAgent);

});