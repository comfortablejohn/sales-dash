import { get } from "./requests";

export function getSales(filters) {
    return get('/api/sales', filters);
}
