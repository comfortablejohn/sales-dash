function handleSuccess(response) {
    console.log(response);
    return response.data;
}

function handleError(error) {
    console.error(error);
    throw new Error('Something went wrong');
}

function get(url, params={}) {
    let queryString = '';

    const keys = Object.keys(params);
    if (keys.length) {
        const args = [];
        keys.forEach(key => {
            args.push(`${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`);
        })
        queryString += '?' + args.join('&');
    }

    return axios.get(`${url}${queryString}`).then(handleSuccess, handleError);
}

export {
    get,
}
