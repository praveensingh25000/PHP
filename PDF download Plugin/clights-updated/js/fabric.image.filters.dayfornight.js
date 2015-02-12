/**
 * Created by Sal on 6/3/13 at Time: 3:28 PM Eastern US time.
 */
/**
 * @namespace fabric.Image.filters
 * @memberOf fabric.Image
 */
fabric.Image.filters = fabric.Image.filters || { };

/**
 * DayForNight filter class
 * @class fabric.Image.filters.DayForNight
 * @memberOf fabric.Image.filters
 */
fabric.Image.filters.DayForNight = fabric.util.createClass(/** @lends fabric.Image.filters.DayForNight.prototype */ {

    /**
     * Filter type
     * @param {String} type
     * @default
     */
    type: 'DayForNight',

    /**
     * Constructor
     * @memberOf fabric.Image.filters.DayForNight.prototype
     * @param {Object} [options] Options object
     */
    initialize: function(options) {
        options = options || { };
        this.adjustment = options.adjustment || 100;
        this.min = options.min || 0;
        this.max = options.max || 120;
    },

    /**
     * Applies filter to canvas element
     * @param {Object} canvasEl Canvas element to which the filter is applied
     */
    applyTo: function(canvasEl) {
        var context = canvasEl.getContext('2d'),
            imageData = context.getImageData(0, 0, canvasEl.width, canvasEl.height),
            data = imageData.data,
            adjustment = this.adjustment,
            min = this.min,
            max = this.max,
            len, i;

        for (i = 0, len = data.length; i < len; i += 4) {
            var r = data[i];
            var g = data[i + 1];
            var b = data[i + 2];
            // CIE luminance for the RGB
            // The human eye is bad at seeing red and blue, so we de-emphasize them.
            var v = 0.2126 * r + 0.07152 * g + 0.0722 * b;
            data[i] = Math.max(min, v);
            data[i + 1] = Math.max(min, v);
            data[i + 2] = Math.max(min, ((0.7 * b) + v) / 2);
            data[i] = Math.min(max, data[i]);
            data[i + 1] = Math.min(max, data[i + 1]);
            data[i + 2] = Math.min(max, data[i + 2]);
            data[i] += adjustment;
            data[i + 1] += adjustment;
            data[i + 2] += adjustment;
        }

/*
        for (i = 0, len = data.length; i < len; i += 4) {
            data[i] += adjustment;
            data[i + 1] += adjustment;
            data[i + 2] += adjustment;
        }
*/

        context.putImageData(imageData, 0, 0);
    },

    /**
     * Returns JSON representation of filter
     * @return {String} JSON representation of filter
     */
    toJSON: function() {
        //noinspection JSValidateTypes
        return {
            type: this.type,
            adjustment: this.adjustment,
            min: this.min,
            max: this.max
        };
    }
});

/**
 * Returns filter instance from an object representation
 * @static
 * @param {Object} object Object from which to create an instance
 * @return {fabric.Image.filters.DayForNight} Instance of fabric.Image.filters.DayForNight
 */
fabric.Image.filters.DayForNight.fromObject = function(object) {
    return new fabric.Image.filters.DayForNight(object);
};