/**
 * Clights Fabric.js methods
 * Created by Sal Lara on 6/3/13 at Time: 4:24 PM Eastern US time.
 */

var CFab = {}
    , iOS = iOS || navigator.userAgent.match(/(iPad|iPhone|iPod)/i)
    , imageRatio = imageRatio || undefined
    , canvasRatio = canvasRatio || undefined
    , padX = padX || undefined
    , padY = padY || undefined
    , imageScale = imageScale || {}
    , house = house || undefined
    , imageSrc = imageSrc || undefined;

function squared (val) {
    return val * val;
}

function distance (coords) {
    coords = _.isObject() ? _.values(coords) : coords;
    var x1 = coords[0]
        , y1 = coords[1]
        , x2 = coords[2]
        , y2 = coords[3];
    return Math.sqrt( squared(x2 - x1) + squared(y2 - y1) );
}

function angle (coords) {
    return Math.atan2(coords[2] - coords[0], coords[3] - coords[1]) * -1;
}

function arcPerimeter (radiusX, radiusY, iterations) {
    var h = squared(radiusX - radiusY) / squared(radiusX + radiusY)
        , iterations = _.isUndefined(iterations) ? 11 : iterations
        , c = 1, factor = 4;
    for (var i = 1; i < iterations; i++) {
        c = c + ((1 / factor) * Math.pow(h, i));
        factor = squared(factor);
    }
//    return (((radiusX + radiusY) * 3) - Math.sqrt( (3 * radiusX + radiusY) * (radiusX + radiusY * 3) )) / 2
    return ((Math.PI * (radiusX + radiusY)) * c) / 2;
}

function toLayerScale(layerId, size) {
    var scale = layers[layerId].scale / 10;
    return size * scale;
}

CFab.dayForNight = false;

CFab.lightPaths = [];

CFab.lights = {};

/**
 * Returns filter instance from an object representation
 * @static
 * @param {Object} [options] Object from which to get project id
 */
CFab.getProjectImage = function (options, callback) {	console.log("in project image");
    options = options || {};
    var project = options.project || project;
    house = new Image();
    if (_.isUndefined(imageSrc)) {
        $.get('./api/project/' + project, {}, function (result) {
             console.log(result);
            imageSrc = result.image;
            house.src = imageSrc;
            house.addEventListener('load', callback, false);
        });
    } else {
        house.src = imageSrc;
        house.addEventListener('load', callback, false);
    }
};

CFab.getItem = function (id) {
    var item;
    $.ajax({
        url: './api/item/' + id,
        type: 'GET',
        async: false
    })
        .done(function (json) {
            item = json;
        });
    return item;
};

CFab.updateLayer = _.throttle(function (layerId) {
    updateLayer(layerId, { items: JSON.stringify(itemsJSONForLayer(layerId)) })
}, 500);

CFab.houseImg = function (options) {
    var house = new Image();
};

CFab.houseIndex = function () {
//noinspection JSCheckFunctionSignatures
    return _.indexOf(
        CFab.canvas.getObjects(),
        _.find(CFab.canvas.getObjects(), function (i){
            return i._isHouseImg
        })
    );
};

// Convenience method to grab the canvas objects. Optional argument where
// allows passing results through _.where() first.
CFab.objch = function (where) {
    //noinspection JSValidateTypes
    var chain = _(CFab.canvas.getObjects());
    return _.isUndefined(where) ? chain : chain.where(where);
};

CFab.itemWhere = function (attrs) {
    //noinspection JSValidateTypes
    return _(CFab.canvas.getObjects()).where(attrs).first();
};

CFab.lightPath = function (pathId) {
    //noinspection JSValidateTypes
    return _(CFab.lightPaths).find(function (p) {
        return p._id == pathId
    });
};

CFab.layerId = function (pathId) {
    return CFab.lightPath(pathId).layerId;
};

CFab.applyDayForNight = function (event, notoggle) {
    var $btn = $('#clights-day-for-night')
        , fit
        , houseIndex;
    if (_.isUndefined(notoggle)) { CFab.dayForNight = !CFab.dayForNight; }
    $btn.find('i')
        .toggleClass('icon-eye-close', CFab.dayForNight)
        .toggleClass('icon-eye-open', !CFab.dayForNight);
    houseIndex = CFab.houseIndex();
    fit = CFab.canvas.item(houseIndex)._fit;
    CFab.canvas.item(houseIndex).filters[0] = CFab.dayForNight
        ? new fabric.Image.filters.DayForNight({ adjustment: -100 })
        : false;
    CFab.canvas.item(houseIndex).set({
            left: (fit.scale.width / 2) + fit.padX,
            top: (fit.scale.height / 2) + fit.padY,
            width: fit.scale.width,
            height: fit.scale.height,
            selectable: false
        });
    CFab.canvas.item(houseIndex)
        .applyFilters(CFab.canvas.renderAll.bind(CFab.canvas));
};

CFab.imageCenterFit = function(image, box) {
    box = box || {
        w: CFab.canvas.getWidth(),
        h: CFab.canvas.getHeight()
    };
    var imgRatio = image.width / image.height
        , canvasRatio = box.w / box.h
        , scale = {};
    scale.height = imgRatio < canvasRatio
        ? box.h
        : box.w * (image.height / image.width);
    scale.width = imgRatio < canvasRatio
        ? box.h * (image.width / image.height)
        : box.w;
    return {
        scale: scale,
        padX: imgRatio < canvasRatio
            ? (box.w - scale.width) / 2
            : 0,
        padY: imgRatio < canvasRatio
            ? 0
            : (box.h - scale.height) / 2
    }
};

CFab.redrawHouse = function() {
    CFab.canvas
        .setWidth($('#clights-viewport').width())
        .setHeight($('#clights-viewport').height());
    var houseIdx = CFab.houseIndex();
    var fit = CFab.imageCenterFit(CFab.canvas.item(houseIdx));
    CFab.canvas.item(houseIdx).set({
        left: (fit.scale.width / 2) + fit.padX,
        top: (fit.scale.height / 2) + fit.padY,
        width: fit.scale.width,
        height: fit.scale.height,
        selectable: false
    });
    CFab.canvas.item(houseIdx)._fit = fit;
    $(document).trigger('clights:houseReloaded');
};

CFab.percentPos = function (x, y) {
    return {
        x: (x - CFab.house._fit.padX) / (CFab.house._fit.scale.width / 100),
        y: (y - CFab.house._fit.padY) / (CFab.house._fit.scale.height / 100)
    }
};

CFab.linePercentPos = function (line) {
    var box, p1, p2;
    box = CFab.percentPos(line.left, line.top);
    p1 = CFab.percentPos(line.x1, line.y1);
    p2 = CFab.percentPos(line.x2, line.y2);
    return {
        left: box.x,
        top: box.y,
        x1: p1.x,
        y1: p1.y,
        x2: p2.x,
        y2: p2.y
    }
};

CFab.eventPercentPos = function (event) {
    var pageX = iOS ? event.originalEvent.pageX : event.pageX
        , pageY = iOS ? event.originalEvent.pageY : event.pageY
        , pos, percentPos;
    percentPos = CFab.percentPos(pageX, pageY);
    pos = {
        pageX: pageX,
        pageY: pageY,
        left: percentPos.x,
        top: percentPos.y
    };
    return pos;
};

CFab.drawStraightPath = function (options) {
    options = options || {};
    var pathId = options._id || _.uniqueId('layer' + options.layerId + '_')
        , layerId = options.layerId
        , pathIdx
        , markers
        , line
        , staticSize = layers[layerId].scale;
    console.log('creating straight path', pathId);
    pathIdx = _.isEmpty(_.where(CFab.lightPaths, {_id: pathId}))
        ? CFab.lightPaths.push({_id: pathId, layerId: layerId, itemType: 'straight', selected: false }) - 1
        : _.indexOf(CFab.lightPaths, _.where(CFab.lightPaths, {_id: pathId})[0]);
    /* Create marker objects */
    markers = _.times(2, function(idx) {
        return _.extend(
            new fabric.Circle({
                radius: 6,
                /*stroke: 'green',
                strokeWidth: 2,*/
                fill: '#fff',
                scaleY: 1.0,
                opacity: 1.0,
                left: (CFab.house._fit.scale.width / 2) + CFab.house._fit.padX,
                top: (CFab.house._fit.scale.height / 2) + CFab.house._fit.padY,
                visible: false,
                hasBorders: false,
                hasControls: false
            }),
            {
                _id: pathId,
                pathId: pathId,
                pathPt: idx
            }
        )
    });
    /* Create line object */
    line = _.extend(
        new fabric.Line(CFab.groupCoords({markers: markers}), {
            fill: 'green',
            stroke: 'green',
            strokeWidth: 1.0,
			opacity: 0,
            selectable: true,
            /*hasBorders: false,*/
            hasControls: false
        }),
        {
            _id: pathId,
            pathId: pathId,
            pathPt: 3,
            _length: distance(CFab.groupCoords({markers: markers})),
            _last: {
                left: 0,
                top: 0
            }
        }
    );

    /* Add line to canvas */
    CFab.canvas.add(line);
    /* Add markers to canvas */
    CFab.canvas.add(markers[0]);
    CFab.canvas.add(markers[1]);

    /* Marker event bindings */
    _.each(markers, function (marker) {
        marker.on('moving', _.bind(function () {
            //console.log('moving: marker');
            var line = CFab.itemWhere({type: 'line', pathId: this.pathId});
            if (this.pathPt == 0) {
                line.set({x1: this.left});
                line.set({y1: this.top});
            }
            if (this.pathPt == 1) {
                line.set({x2: this.left});
                line.set({y2: this.top});
            }
            line.set({
                _length: distance(CFab.groupCoords({markers: markers}))
            });
            line.fire('modified', {message: 'marker:moving'});
            CFab.drawPathLights(line);
            line.setCoords();
            CFab.canvas.renderAll();
        }, marker));
        marker.on('selected', _.bind(function () {
            //console.log('marker: selected');
            _.each(CFab.lightPaths, function(lightPath) {
                CFab.togglePathSelection(lightPath._id, false);
            });
            CFab.togglePathSelection(this.pathId, true);
        }, marker));
        marker.on('unselected', _.bind(function () {
           // console.log('marker: unselected');
            //noinspection JSValidateTypes
            var anyActiveInPath = _(CFab.canvas.getObjects())
                .where({pathId: this.pathId})
                .pluck('active')
                .contains(true);
            _.each(CFab.lightPaths, function(lightPath) {
                CFab.togglePathSelection(lightPath._id, false);
            });
            CFab.togglePathSelection(this.pathId, anyActiveInPath);
        }, marker));
/*            .on('selection:cleared', _.bind(function () {
                try { console.log('selection:cleared: ', this) } catch (e) { console.log(e.message); }
            }, marker))*/
        marker.on('modified', _.bind(function () {
            //console.log('modified: marker');
            //try { console.log('modified: ', this) } catch (e) { console.log(e.message); }
            var pos = CFab.percentPos(this.left, this.top);
            this.set({
                _pos: {
                    left: pos.x,
                    top: pos.y
                }
            });
            line.fire('modified');
        }, marker));
    });

    /* Line event bindings */
    line.on('modified', _.bind(function(options) {
        console.log('modified: line');
        if (!_.isUndefined(options.message)) {
            console.log("options.message:", options.message);
        }
        this.set({
            _length: distance(CFab.groupCoords({markers: markers})),
            _pos: CFab.linePercentPos(this),
            _last: {
                left: line.left,
                top: line.top
            }
        });
        CFab.drawPathLights(this);
        if (_.isUndefined(options.message)) {
            CFab.serializePath(this.pathId);
        }
    }, line));
    line.on('selected', _.bind(function (options) {
        //console.log('selected: line');
        _.each(CFab.lightPaths, function(lightPath) {
            CFab.togglePathSelection(lightPath._id, false);
        });
        CFab.togglePathSelection(this.pathId, true);
        //console.log('pickevent:', pickEvent);
        //console.log('options.layerId:', options.layerId);
        CFab.layerEnsureSelected(layerId);
    }, line));
    line.on('unselected', _.bind(function () {
        //console.log('unselected: line');
        //noinspection JSValidateTypes
        var anyActiveInPath = _(CFab.canvas.getObjects())
            .where({pathId: this.pathId})
            .pluck('active')
            .contains(true);
        _.each(CFab.lightPaths, function(lightPath) {
            CFab.togglePathSelection(lightPath._id, false);
        });
        CFab.togglePathSelection(this.pathId, anyActiveInPath);
    }, line));
    line.on('moving', _.bind(function(event, message) {
        var _this = this;
        var dx = this.left - this._last.left
            , dy = this.top - this._last.top;
        CFab.layerEnsureSelected(layerId);
        this.set({
            x1: this.x1 + dx,
            y1: this.y1 + dy,
            x2: this.x2 + dx,
            y2: this.y2 + dy,
            _last: {
                left: this.left,
                top: this.top
            }
        });
        //noinspection JSValidateTypes
        _(markers).each(function (m) {
            m.set({
                visible: true,
                left: m.pathPt == 0 ? _this.x1 : _this.x2,
                top: m.pathPt == 0 ? _this.y1 : _this.y2
            });
            m.fire('modified', {message: 'line:moving'});
            m.setCoords();
        });
        CFab.drawPathLights(this);
        CFab.canvas.renderAll();
        this.setCoords();
    }, line));

    return CFab.lightPaths[pathIdx];
};

CFab.drawCurvePath = function (options) {
    options = options || {};
    var pathId = options._id || _.uniqueId('layer' + options.layerId + '_')
        , layerId = options.layerId
        , pathIdx
        , markers
        , curve
        , staticSize = layers[layerId].scale;
    pathIdx = _.isEmpty(_.where(CFab.lightPaths, {_id: pathId}))
        ? CFab.lightPaths.push({_id: pathId, layerId: layerId, itemType: 'curve', selected: false }) - 1
        : _.indexOf(CFab.lightPaths, _.where(CFab.lightPaths, {_id: pathId})[0]);
    /* Create marker objects */
    markers = _.times(3, function(idx) {
        return _.extend(
            new fabric.Circle({
                radius: idx == 2 ? 4 : 6,
                fill: '#fff',
                scaleY: 1.0,
                opacity: 1.0,
                left: (CFab.house._fit.scale.width / 2) + CFab.house._fit.padX,
                top: (CFab.house._fit.scale.height / 2) + CFab.house._fit.padY,
                visible: false,
                hasBorders: false,
                hasControls: false,
                lockMovementX: idx == 2,
                lockMovementY: idx == 1
            }),
            {
                _id: pathId,
                pathId: pathId,
                pathPt: idx
            }
        )
    });
    /* Create arc object */
    curve = _.extend(
        CFab.arcPath(0, 0, 100, 50, true),
        {
            _id: pathId,
            pathId: pathId,
            pathPt: 3,
            _length: arcPerimeter(CFab.curveRadii(markers).x, CFab.curveRadii(markers).y),
            _last: {
                left: 0,
                top: 0
            }
        }
    );

    /* Add arc to canvas */
    CFab.canvas.add(curve);
    /* Add markers to canvas */
    CFab.canvas.add(markers[0]);
    CFab.canvas.add(markers[1]);
    CFab.canvas.add(markers[2]);

    /* Marker event bindings */
    _.each(markers, function (marker) {
        marker.on('moving', _.bind(function () {
            console.log('moving: marker');
            if (this.pathPt != 2) {
                CFab.setPathMarkerPos({
                    pathId: this.pathId,
                    pathPt: 2,
                    pos: {
                        left: (markers[0]._pos.left + markers[1]._pos.left) / 2,
                        top: markers[2]._pos.top
                    }
                });
                if (this.pathPt == 0) {
                    CFab.setPathMarkerPos({
                        pathId: this.pathId,
                        pathPt: 1,
                        pos: {
                            left: markers[1]._pos.left,
                            top: markers[0]._pos.top
                        }
                    });
                }
            }
            var curve = CFab.itemWhere({type: 'path', pathId: this.pathId});
            CFab.setCurvePos({pathId: this.pathId});
            curve.fire('modified', {message: 'marker:moving'});
            CFab.drawPathLights(curve);
            CFab.canvas.renderAll();
        }, marker));
        marker.on('selected', _.bind(function () {
            console.log('marker: selected');
            _.each(CFab.lightPaths, function(lightPath) {
                CFab.togglePathSelection(lightPath._id, false);
            });
            CFab.togglePathSelection(this.pathId, true);
        }, marker));
        marker.on('unselected', _.bind(function () {
            // console.log('marker: unselected');
            //noinspection JSValidateTypes
            var anyActiveInPath = _(CFab.canvas.getObjects())
                .where({pathId: this.pathId})
                .pluck('active')
                .contains(true);
            _.each(CFab.lightPaths, function(lightPath) {
                CFab.togglePathSelection(lightPath._id, false);
            });
            CFab.togglePathSelection(this.pathId, anyActiveInPath);
        }, marker));
        marker.on('modified', _.bind(function () {
            //console.log('modified: marker');
            //try { console.log('modified: ', this) } catch (e) { console.log(e.message); }
            var pos = CFab.percentPos(this.left, this.top);
            this.set({
                _pos: {
                    left: pos.x,
                    top: pos.y
                }
            });
            curve.fire('modified');
        }, marker));
    });
    /* Curve event bindings */
    curve.on('moving', _.bind(function () {
        console.log('moving: curve ', this);
        var mpos = [
            CFab.percentPos(this.left - (this.width / 2), this.top + (this.height / 2)),
            CFab.percentPos(this.left + (this.width / 2), this.top + (this.height / 2)),
            CFab.percentPos(this.left, this.top - (this.height / 2)),
        ];
        _.each(markers, function (marker) {
            CFab.setPathMarkerPos({
                pathId: pathId,
                pathPt: marker.pathPt,
                pos: {
                    left: mpos[marker.pathPt].x,
                    top: mpos[marker.pathPt].y
                }
            });
            marker.setCoords();
        });
        CFab.drawPathLights(this);
        CFab.canvas.renderAll();
        this.setCoords();
    }, curve));
    curve.on('selected', _.bind(function (options) {
        console.log('selected: line');
        _.each(CFab.lightPaths, function(lightPath) {
            CFab.togglePathSelection(lightPath._id, false);
        });
        CFab.togglePathSelection(this.pathId, true);
        CFab.layerEnsureSelected(layerId);
    }, curve));
    curve.on('unselected', _.bind(function () {
        //console.log('unselected: line');
        //noinspection JSValidateTypes
        var anyActiveInPath = _(CFab.canvas.getObjects())
            .where({pathId: this.pathId})
            .pluck('active')
            .contains(true);
        _.each(CFab.lightPaths, function(lightPath) {
            CFab.togglePathSelection(lightPath._id, false);
        });
        CFab.togglePathSelection(this.pathId, anyActiveInPath);
    }, curve));
    curve.on('modified', _.bind(function(options) {
        //console.log('modified: line');
        var pos = CFab.percentPos(this.left, this.top);
        this.set({
            _length: arcPerimeter(CFab.curveRadii(markers).x, CFab.curveRadii(markers).y),
            _pos: {
                left: pos.x,
                top: pos.y
            },
            _last: {
                left: curve.left,
                top: curve.top
            }
        });
        CFab.drawPathLights(this);
        if (_.isUndefined(options.message)) CFab.serializePath(this.pathId);
    }, curve));

    return CFab.lightPaths[pathIdx];

};

CFab.lineAngle = function (line) {
    var coords = CFab.groupCoords({
            markers: _.where(CFab.canvas.getObjects(), {
                    pathId: line.pathId, type: "circle"
                })
        });
    return angle(coords);
};

CFab.arrangeLineLights =  function (line) {
    var angle = CFab.lineAngle(line)
        , layerId = CFab.lightPath(line.pathId).layerId
        , lightHeight = toLayerScale(layerId, LIGHT_HEIGHT)
        , lightSpacing = lightHeight * LIGHT_HEIGHT_TO_SPACING_RATIO
        , lightsNeeded = Math.floor(line._length / lightSpacing) + 1
        , lengthOnLine, lightAngle;
    // Turn the lights at a perpendicular angle to the line, but keep them facing up
    lightAngle = (angle + ((Math.PI / 2) * ((angle > 0) ? -1 : 1))) * (180 / Math.PI);
    CFab.lightsInPath(line.pathId)
        .each(function(light, idx) {
            lengthOnLine = lightSpacing * idx;
            light.set({
                width: lightHeight * 0.8,
                height: lightHeight,
                left: line.x1 + (lengthOnLine * Math.cos(angle + (Math.PI / 2))),
                top: line.y1 + (lengthOnLine * Math.sin(angle + (Math.PI / 2))),
                visible: idx < lightsNeeded && layerIsVisible(layerId),
                angle: lightAngle
            });
        });
};

CFab.arrangeCurveLights = function (curve) {
    var layerId = CFab.lightPath(curve.pathId).layerId
        , markers = CFab.objch({pathId: curve.pathId, type: 'circle'}).value()
        , curveRadii = CFab.curveRadii(markers)
        , pivotX = markers[0].left + curveRadii.x
        , pivotY = markers[0].top
        , lightHeight = toLayerScale(layerId, LIGHT_HEIGHT)
        , lightSpacing = lightHeight * LIGHT_HEIGHT_TO_SPACING_RATIO
        , lightsNeeded = Math.floor(curve._length / lightSpacing) + 1
        , startAngle = angle([pivotX, pivotY, markers[0].left, markers[0].top]) * (180 / Math.PI) + 90
        , arcUpFlag = (markers[2].top < markers[0].top) ? 1 : -1
        , lengthOnLine, angleDeg, angleRad;

    CFab.lightsInPath(curve.pathId)
        .each(function(light, idx) {
            lengthOnLine = lightSpacing * idx;
            angleDeg =  (startAngle + ((180 / curve._length) * lengthOnLine)) * arcUpFlag;
            angleRad = angleDeg * (Math.PI / 180);
            light.set({
                width: lightHeight * 0.8,
                height: lightHeight,
                left: pivotX + Math.cos(angleRad) * curveRadii.x,
                top: pivotY + Math.sin(angleRad) * curveRadii.y,
                visible: idx < lightsNeeded && layerIsVisible(layerId),
                angle: angleDeg + 90
            });
        });
};

CFab.drawPathLights = function (path, options) {
    options = options || {};
    var arrangeFn = path.type == 'line' ? CFab.arrangeLineLights : CFab.arrangeCurveLights
        , layerId = CFab.lightPath(path.pathId).layerId
        , lightHeight = toLayerScale(layerId, LIGHT_HEIGHT)
        , lightSpacing = lightHeight * LIGHT_HEIGHT_TO_SPACING_RATIO
        , lightsNeeded
        , lightsInPath
        , colorPattern, nextColor;
    lightsNeeded = Math.floor(path._length / lightSpacing) + 1;
    lightsInPath = _.where(CFab.canvas.getObjects(), {pathId: path.pathId, type: 'image'}).length;
    colorPattern = _.find(LIGHT_PATTERNS, function(p) {
        return p.swatch == $layerRow(layerId).attr('data-color')
    }) || LIGHT_PATTERNS[0];
    nextColor = 0;

    if (path._lastRenderedPattern != $layerRow(layerId).attr('data-color')) {
        //console.log('new color: removing previous lights');
        CFab.lightsInPath(path.pathId)
            .each(function(light) {
                light.remove();
            });
        lightsInPath = 0;
    }

    if (lightsInPath < lightsNeeded && layerIsVisible(layerId)) {
        //console.log('lightsNeeded - lightsInPath =', lightsNeeded - lightsInPath);
        _.times(lightsNeeded - lightsInPath, function(idx) {
            nextColor = idx % colorPattern.patternNames.length;
            var l = $('img[data-lightcolor="' + colorPattern.patternNames[nextColor] + '"]')[0];
/*
            l._item = _.isUndefined(CFab.lights[colorPattern.patternNames[nextColor]])
                ? CFab.lights[colorPattern.patternNames[nextColor]]
                : CFab.lights[colorPattern.patternNames[nextColor]];
*/
//            l.onload = function () {
                var light = _.extend(
                    new fabric.Image(l, {
                        width: lightHeight * 0.8,
                        height: lightHeight,
                        visible: false,
                        selectable: false
                    }),
                    {
                        layerId: layerId,
                        pathId: path.pathId,
                        pathLightId: _.uniqueId('pathlight')
                    }
                );
                CFab.canvas.add(light);
                if ((idx + 1) == (lightsNeeded - lightsInPath)) {
                    arrangeFn(path);
                }
//            };
//            l.src = l._item.data;
        });
        path._lastRenderedPattern = colorPattern.swatch;
    } else {
        arrangeFn(path);
    }
//    path.type == 'path' && path.fire("modified");
    if (!options.noRender) {
        CFab.canvas.renderAll();
    }

};

CFab.arcPath = function (left, top, arcW, arcH, goUp) {
    var arcPts = [
        "m", 0, goUp ? arcH : 0,
        "a", arcW / 2, arcH, 0, 0, goUp ? 1 : 0, arcW, 0
    ];
    var ap = new fabric.Path(arcPts.join(' '), {
        fill: 'none', width: arcW, height: arcH
    });
    ap.set({
        left: left,
        top: top,
        stroke: '#020',
        strokeWidth: 2,
        lockScalingX: true,
        lockScalingY: true,
        selectable: true,
        hasBorders: false,
        hasControls: false
    });
    return ap;
};

CFab.setPathMarkerPos = function(options, msjObj) {
    if (_.isUndefined(options)) throw 'No options argument passed';
    var marker = CFab.objch(_.pick(options, ['pathId', 'pathPt'])).first()
        , fit = CFab.house._fit
        , markerPos
        , markers;
    if (CFab.lightPath(options.pathId).itemType == 'curve' && marker.pathPt > 0) {
        if (marker.pathPt == 1) {
            markers = CFab.objch({pathId: options.pathId, type: 'circle'}).value();
            marker.set({
                left: ((fit.scale.width / 100) * options.pos.left) + fit.padX,
                top: markers[0].top
            });
            /* Note this marker's y coordinate is locked to the y coordinate of markers[0] */
            markerPos = CFab.percentPos(marker.left, markers[0].top);
        } else if (marker.pathPt == 2) {
            markers = CFab.objch({pathId: options.pathId, type: 'circle'}).value();
            marker.set({
                left: (markers[0].left + markers[1].left) / 2,
                top: ((fit.scale.height/ 100) * options.pos.top) + fit.padY
            });
            markerPos = CFab.percentPos(marker.left, marker.top);
        }
        marker.set({
            _pos: {
                left: markerPos.x,
                top: markerPos.y
            }
        });
    }

    if (CFab.lightPath(options.pathId).itemType == 'straight' || marker.pathPt == 0) {
        marker.set({
            left: ((fit.scale.width / 100) * options.pos.left) + fit.padX,
            top: ((fit.scale.height/ 100) * options.pos.top) + fit.padY
        });
        markerPos = CFab.percentPos(marker.left, marker.top);
        marker.set({
            _pos: {
                left: markerPos.x,
                top: markerPos.y
            }
        });
    }

    if (!_.isUndefined(options.attrs)) marker.set(options.attrs);
    marker.setCoords();

    // Only do serialization if all markers have been initialized with a `_pos`
//    CFab.serializePath(options.pathId);
    if (!CFab.objch({type: 'circle', pathId: options.pathId}).pluck('_pos').contains(undefined)) {
        CFab.serializePath(options.pathId);
    } else {
        CFab.serializePath(options.pathId, {doUpdate: false});
    }
    CFab.canvas.renderAll();
};

CFab.setLinePos = function(options, msgObj) {
    if (_.isUndefined(options)) throw 'No options argument passed';
    var line = CFab.objch({pathId: options.pathId, type: 'line'}).first()
        , markers = CFab.objch({pathId: options.pathId, type: 'circle'}).value();
    line.set({
        x1: markers[0].left,
        y1: markers[0].top,
        x2: markers[1].left,
        y2: markers[1].top,
        _length: distance(CFab.groupCoords({markers: [markers[0], markers[1]]})),
        _last: {
            left: line.left,
            top: line.top
        }
    });
    if (!_.isUndefined(options.attrs)) line.set(options.attrs);
    CFab.drawPathLights(line);
    line.fire('modified');
    line.setCoords();
};

CFab.setCurvePos = function(options, msgObj) {
    if (_.isUndefined(options)) throw 'No options argument passed';
    var curve = CFab.objch({pathId: options.pathId, type: 'path'}).first()
        , markers = CFab.objch({pathId: options.pathId, type: 'circle'}).value()
        , curveWidth = Math.abs(markers[1].left - markers[0].left)
        , curveHeight = markers[0].top - markers[2].top
        , pathAttrs;
    curve.set({
        left: markers[0].left + (curveWidth / 2),
        top: markers[0].top - (curveHeight / 2),
        width: curveWidth,
        height: Math.abs(curveHeight),
        _length: arcPerimeter(CFab.curveRadii(markers).x, CFab.curveRadii(markers).y),
        _last: {
            left: curve.left,
            top: curve.top
        }
    });
    if (!_.isUndefined(options.attrs)) curve.set(options.attrs);
    curve.setCoords();

    // The SVG path is defined as an object here purely for readability.
    pathAttrs = {
        command: 'A',
        radiusX: curveWidth / 2,
        radiusY: Math.abs(curveHeight),
        rotation: 0,
        largeArch: 0,
        sweepDirection: curveHeight < 0 ? 0 : 1,
        arcToX: curveWidth,
        arcToY: curveHeight > 0 ? Math.abs(curveHeight) : 0
    };
    curve.path[0] = ['M', 0, curveHeight > 0 ? Math.abs(curveHeight) : 0];
    curve.path[1] = _.values(pathAttrs);

    CFab.drawPathLights(curve);
    curve.fire('modified');
    curve.setCoords();

};

CFab.serializePath = function (pathId, options) {
    options = options || {};
    CFab.lightPath(pathId).markers = CFab.objch({pathId: pathId, type: 'circle'})
        .map(function (m) {
            return _.pick(m, ['pathPt', '_pos'])
        }).value();
    if (options.doUpdate !== false) {
        CFab.updateLayer(CFab.lightPath(pathId).layerId);
    }

};

CFab.togglePathSelection = function (pathId, force) {
    var selected = _.isUndefined(force)
        ? !CFab.lightPath(pathId).selected
        : force
        , staticSize = layers[CFab.layerId(pathId)].scale;

    try {
        CFab.lightPath(pathId).selected = selected;
    } catch (e) {
        console.log("error in CFab.togglePathSelection:", e);
        return
    }
//    console.log("togglePathSelection: selected:", selected);
    //noinspection JSValidateTypes
    _(CFab.canvas.getObjects())
        .filter(function (o) {
            return o.pathId == pathId && o.type != 'image'
        })
        .each(function(o) {
            if (o.type == 'line' || o.type == 'path') {
                o.set({stroke: selected ? 'red' : '#020'})
            }
            if (o.type == 'circle') {
                o.set({
                    visible: selected,
                    radius: o.pathPt < 2
                        ? 6
                        : 4
                })
            }
            o.isSelected = selected;
        });
    CFab.canvas.renderAll();
};

CFab.updatePathPos = function(pathId) {
    var fit = CFab.house._fit,
        path = CFab.objch()
            .filter(function (item) {
                return item.type == 'line' || item.type == 'path'
            })
            .where({pathId: pathId})
            .first();
    //noinspection JSValidateTypes
    _(CFab.canvas.getObjects())
        .filter(function (obj) {
            return obj.pathId == pathId && _.contains(['circle', 'line', 'path'], obj.type)
        })
        .each(function (obj) {
            if (obj.type == 'circle') {
                if (!_.has(obj, '_pos')) {
                    var pos = CFab.percentPos(obj.left, obj.top);
                    obj.set({
                        _pos: {
                            left: pos.x,
                            top: pos.y
                        }
                    })
                }
                obj.set({
                    left: ((fit.scale.width / 100) * obj._pos.left) + fit.padX,
                    top: ((fit.scale.height / 100) * obj._pos.top) + fit.padY
                });
                obj.setCoords();
            } else if (obj.type == 'line') {
                if (!_.has(obj, '_pos')) {
                    obj.set({
                        _pos: CFab.linePercentPos(obj)
                    })
                }
                obj.set({
                    left: ((fit.scale.width / 100) * obj._pos.left) + fit.padX,
                    top: ((fit.scale.height / 100) * obj._pos.top) + fit.padY,
                    x1: ((fit.scale.width / 100) * obj._pos.x1) + fit.padX,
                    y1: ((fit.scale.height / 100) * obj._pos.y1) + fit.padY,
                    x2: ((fit.scale.width / 100) * obj._pos.x2) + fit.padX,
                    y2: ((fit.scale.height / 100) * obj._pos.y2) + fit.padY
                });
            } else if (obj.type == 'path') {
                _.delay(function () {
                    CFab.setCurvePos({pathId: obj.pathId})
                }, 300)
            }
            obj.fire('modified');
            obj.setCoords();
        });
    CFab.drawPathLights(path);
};

CFab.lightsInPath = function (pathId) {
    //noinspection JSValidateTypes
    return _(CFab.canvas.getObjects())
        .where({pathId: pathId, type: 'image'})
};

CFab.removeLayerItem = function (item) {
    var layerId = $('#clights-toolbar').attr('data-layerid')
        , itemObjs = CFab.itemsInLayer(layerId)
            .map(function (io) {
                return _.pick(io, ['_id', 'itemType'])
            })
            .value();
    _(itemObjs).each(function (io) {
        if (io.itemType == 'static' && io._id == item._id) {
            staticItems = _.filter(staticItems, function (i) {
                return i._id != item._id
            });
            item.remove();
            drawStaticItems();
        }
        else if (_(['straight', 'curve']).contains(io.itemType) && io._id == item.pathId) {
            CFab.objch({pathId: item.pathId})
                .each(function (i) {
                    i.remove();
                });
            CFab.lightPaths = _.filter(CFab.lightPaths, function (p) {
                return p._id != item.pathId
            });
        }
    });
    updateLayer(layerId, { items: JSON.stringify(itemsJSONForLayer(layerId)) } );
};

CFab.itemsInLayer = function (layerId) {
    //noinspection JSValidateTypes
    return _(_.union(CFab.lightPaths, staticItems))
        .where({layerId: layerId})
};

CFab.layerEnsureSelected = function (layerId) {
    if (!$layerRow(layerId).hasClass('clights_editing')) {
        $('#clights-layers .clights_tr[data-layerid="' + layerId + '"] .clights_edit')
            .trigger(pickEvent);
    }
};

CFab.toggleLayerVisibility = function (layerId, state) {
    CFab.itemsInLayer(layerId)
        .each(function (item) {
            if (item.itemType == 'static') {
                item._item.set({
                    visible: state
                });
                CFab.canvas.renderAll();
            } else if (item.itemType == 'straight' || item.itemType == 'curve') {
                CFab.objch({pathId: item._id})
                    .each(function (object) {
                        if (object.type == 'circle') {
                            object.set({ visible: item.selected})
                        }
                        if (object.type == 'line' || object.type == 'path') {
                            object.set({
                                visible: state
                            });
                            CFab.drawPathLights(object)
                        }
                    });
            }
        });

};

CFab.groupCoords = function (lightPath) {
    return _(lightPath.markers)
        .map(function (m) { return [m.left, m.top] })
        .reduce(function(m,n){
            _.each(n, function(c) { m.push(c) });
            return m;
        })
};

CFab.curveRadii = function (markers) {
    return {
        x: Math.abs(markers[1].left - markers[0].left) / 2,
        y: Math.abs(markers[2].top - markers[0].top)
    }
};

CFab.drawHouse = function (options) {
    options = options || {};
    options = _.defaults({
        newWidth: $('#clights-viewport').width(),
        newHeight: $('#clights-viewport').height()
    }, options);
    if (!Modernizr.canvas) {
        return;
    } else {
        CFab.canvas = new fabric.Canvas('canvas');
        CFab.canvas
            .setWidth(options.newWidth)
            .setHeight(options.newHeight);
        CFab.cornerSize = iOS ? 40 : 10;
    }
	console.log("before get project image");
    getProjectImage(project, eventImageLoaded);	console.log("after get project image");

    // Fetch lights from server by their ids
    CFab.lights.clear = CFab.getItem(3);
    CFab.lights.red   = CFab.getItem(4);
    CFab.lights.green = CFab.getItem(5);
    CFab.lights.blue  = CFab.getItem(7);
    CFab.lights.amber = CFab.getItem(6);

    function eventImageLoaded () {
        console.log('eventImageLoaded');

        var fit = CFab.imageCenterFit(house);
        CFab.house = new fabric.Image(house, {
            left: (fit.scale.width / 2) + fit.padX,
            top: (fit.scale.height / 2) + fit.padY,
            width: fit.scale.width,
            height: fit.scale.height,
            selectable: false
        });
        CFab.canvas.add(_.extend(CFab.house, {_fit: fit, _isHouseImg: true}));
        CFab.canvas.on('mouse:down', function (e) {
            destroyPopovers();
        });
        CFab.canvas.on('object:selected', function (e) {
            var item = e.target;
            //console.log("object:selected:", item);
            $('#clights-remove-item').removeClass('disabled');
        });
        CFab.canvas.on('selection:cleared', function(e) {
            //console.log("no selection");
            //noinspection JSValidateTypes
            _(CFab.canvas.getObjects())
                .where({isSelected: true})
                .each(function (o) {
                    o.fire('unselected')
                });
            $('#clights-remove-item').addClass('disabled');
        });
        $(document).trigger('clights:houseLoaded');
    }

};
