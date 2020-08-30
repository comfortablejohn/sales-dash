import { get } from "./requests";

function dailySalesCount({ from, to }) {
    return get('/api/stats/daily', { from, to });
}

export default {
    dailySalesCount
}
