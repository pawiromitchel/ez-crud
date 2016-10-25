/**
 * Get value from the url
 * example: http://localhost/users-details?id=1
 * @param  {string} name this needs to be the name, in this case its the "id"
 * @return {string}      will return the value of the parameter
 */
function getUriParam(param){
    if(param=(new RegExp('[?&]'+encodeURIComponent(param)+'=([^&]*)')).exec(location.search))
      return decodeURIComponent(param[1]);
}

/**
 * This will test if the url is valid or not
 * @param  {string} testUrl needs to be a url
 * @return {http.status}    this will return 200 on success, and 0 or negative value on error
 * 
 */
function urlExists(testUrl){
    var http = $.ajax({
        type:"HEAD",
        url: testUrl,
        async: false
    });
    return http.status;
}

/**
 * calculate the difference between 2 days
 * @param  {date} one     
 * @param  {date} another 
 * @return {int}          the difference of the 2 dates
 */
function daysBetween(one, another) {
    return Math.round(Math.abs(one - another) / 8.64e7) + 1;
}

/**
 * get data from a webservice
 * @param  {string}     url     the url of the webservice
 * @param  {function}           onSuccess
 * @param  {function}           onFail   
 */
function ajaxGet(url, onSuccess, onFail){
    $.ajax({
        type: "GET",
        url: url,
        success: onSuccess,
        fail: onFail
    });
}

/**
 * post data to a webservice
 * @param  {string} formName the id/class of the form
 * @return {[type]}          [description]
 */
function formSubmit(formName){
    formName.submit(function (ev) {
        $.ajax({
            method: formName.attr('method'),
            url: formName.attr('action'),
            data: formName.serialize(),
            success: onSuccess,
            fail: onFail
        });
        ev.preventDefault();
    });
}