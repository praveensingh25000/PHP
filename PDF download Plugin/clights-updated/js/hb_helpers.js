Handlebars.registerHelper('dateInputVal', function(unixTime) {
//    console.log(unixTime);
    var fmtDate = new Handlebars.SafeString(
        Date.create(parseInt(unixTime)).format('{yyyy}-{MM}-{dd}')
    );
//    console.log(fmtDate);
    return fmtDate;
});

Handlebars.registerHelper('ternary', function(valIfTrue, valIfFalse) {
    valIfTrue = valIfTrue || 'true';
    valIfFalse = valIfFalse || "false";
    var args = arguments
        , numConditions = args.length - 2
        , conditions = Array.prototype.slice.call(args, 2)
        , results = [];
    console.log('ternary conditions:', numConditions);
    [].forEach.call(conditions, function (condition) {
        results.push(!!condition)
    });
    return !_.contains(results, false)
        ? new Handlebars.SafeString(valIfTrue)
        : new Handlebars.SafeString(valIfFalse);
});

