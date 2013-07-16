yii = {
    urls: {
        baseUrl: "\/studyenglish",
        pureUrl: "localhost:8081\/studyenglish\/signsmartv2\/index.php\/"
    }
};


var queryStrings = getQueryStrings();
var prev_r = decodeURIComponent(queryStrings['prev_r']);
var qtrings = "";


$.each( queryStrings, function( index, key ) {
    if(key!='prev_r')
        qtrings += key+"="+ queryStrings[key] +"&";
});

var prevUrl = yii.urls.pureUrl +  prev_r + '?' +qtrings;

function buildUrlFromExistQueryString(router, queryStringsObj){
    if(router == ''){
        router = decodeURIComponent(queryStrings['prev_r']);
    }

    var _cQueryStrings = {};
    $.each( queryStrings, function( index, key ) {
        _cQueryStrings[key] = queryStrings[key];
    });

    if(queryStringsObj != null){
        $.each( queryStringsObj, function( key, value ) {
            _cQueryStrings[key] = value;

        });
    }

    var Qstrings = "";
    var totalKeyInObj = Object.keys(_cQueryStrings).length;
    var index= 1;
    $.each( _cQueryStrings, function( key, value ) {
        if(key!='prev_r')
            Qstrings += key+"="+ value;

        if (index < totalKeyInObj)
            Qstrings += "&";
        index++;
    });

    return (yii.urls.pureUrl +  router + '?' +Qstrings);
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function getQueryStrings()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    var queyrystring_id = window.location.pathname.slice(window.location.pathname.lastIndexOf('/')+1);
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    if(isNumber(queyrystring_id)){
        vars.push('id');
        vars['id'] = queyrystring_id;
    }


    return vars;
}
