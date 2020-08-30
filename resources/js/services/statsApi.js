function handleSuccess(response) {
    return response.data;
}

function handleError(error) {
    console.error(error);
    throw new Error('Something went wrong');
}

function dailySalesCount({ from, to }) {
    const args = [];
    if (from) {
        args.push(`from=${from}`);
    }

    if (to) {
        args.push(`to=${to}`);
    }

    let queryString = '';
    if (args.length) {
        queryString += '?' + args.join('&');
    }

    return axios.get(`/api/stats/daily${queryString}`).then(handleSuccess, handleError);
}

export default {
    dailySalesCount
}
