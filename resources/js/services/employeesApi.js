import { get } from "./requests";

function search(searchString) {
    return get('/api/employees/search', { s: encodeURIComponent(searchString)});
}

export default {
    search
};
