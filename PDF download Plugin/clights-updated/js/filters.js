/**
 * Created by Sal on 5/28/13 at Time: 6:31 PM Eastern US time.
 */

var Filters = {};

Filters.getPixels = function() {
    var c = document.getElementById("canvas");
    var ctx = c.getContext('2d');
    return ctx.getImageData(0, 0, c.width, c.height);
};

Filters.putPixels = function(imageData) {
    var c = document.getElementById("canvas");
    var ctx = c.getContext('2d');
    return ctx.putImageData(imageData, 0, 0);
};

Filters.filterImage = function(filter, image, var_args) {
    var args = [image];
    for (var i=2; i<arguments.length; i++) {
        args.push(arguments[i]);
    }
    return filter.apply(null, args);
};

Filters.grayscale = function(pixels, args) {
    var d = pixels.data;
    for (var i=0; i<d.length; i+=4) {
        var r = d[i];
        var g = d[i+1];
        var b = d[i+2];
        // CIE luminance for the RGB
        // The human eye is bad at seeing red and blue, so we de-emphasize them.
        var v = 0.2126*r + 0.7152*g + 0.0722*b;
        d[i] = d[i+1] = d[i+2] = v
    }
    return pixels;
};

Filters.dayForNight = function(pixels, adjustment) {
    //if (typeof adjustment == 'undefined') adjustment = -50;
    var d = pixels.data;
    var min = 0;
    var max = 120;
    for (var i=0; i<d.length; i+=4) {
        var r = d[i];
        var g = d[i+1];
        var b = d[i+2];
        // CIE luminance for the RGB
        // The human eye is bad at seeing red and blue, so we de-emphasize them.
        var v = 0.2126*r + 0.07152*g + 0.0722*b;
        d[i]   = Math.max(min, v);
        d[i+1] = Math.max(min, v);
        d[i+2] = Math.max(min, ((0.7 * b) + v) / 2);
        d[i]   = Math.min(max, d[i]);
        d[i+1] = Math.min(max, d[i+1]);
        d[i+2] = Math.min(max, d[i+2]);
    }
    return Filters.brightness(pixels, adjustment);
};

Filters.brightness = function(pixels, adjustment) {
    var d = pixels.data;
    for (var i=0; i<d.length; i+=4) {
        d[i] += adjustment;
        d[i+1] += adjustment;
        d[i+2] += adjustment;
    }
    return pixels;
};