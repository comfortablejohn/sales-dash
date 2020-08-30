import { get } from "./requests";

function search(searchString) {
    return get('/api/customers/search', { s: encodeURIComponent(searchString)});
}

export default {
    search
};
