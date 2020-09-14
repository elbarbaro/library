var put = function(url, data, callback, errorCallback) {
    var params = urlEncodedParameters(data);
    fetch(url, { method: 'PUT', body: params, headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }})
    .then(function(response) {
        return response.json();
    })
    .then(function(json) {
        callback(json)
    })
    .catch(function(error) {
        errorCallback(error)
    });
}

var formDataBuilder = function(data) {
    var formData = new FormData();
    for(let property in data) {
        formData.append(property, data[property]);
    }
    console.log(formData);
    return formData;
}

const urlEncodedParameters = function(data) {
    return Object.keys(data).map((key) => {
        return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
    }).join('&');
}