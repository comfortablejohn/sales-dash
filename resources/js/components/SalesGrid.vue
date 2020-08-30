<template>
    <div class="sales-grid">
        <sales-grid-pagination
            v-on="$listeners"
            v-bind:pagination="pagination"
        ></sales-grid-pagination>
        <table class="grid">
            <thead class="grid-row grid-row__headings">
                <tr>
                    <th>Invoice ID</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Sales Person</th>
                    <th>Date ⩔</th>
                </tr>
            </thead>
            <tbody>
                <sales-grid-row-item
                    v-on="$listeners"
                    v-for="sale in sales"
                    v-bind:sale="sale"
                    v-bind:key="sale.id"
                >
                </sales-grid-row-item>
            </tbody>
        </table>
    </div>
</template>
<script>
import SalesGridRowItem from "./SalesGridRowItem";
import SalesGridPagination from "./SalesGridPagination";
export default {
    components: {
        'sales-grid-row-item': SalesGridRowItem,
        'sales-grid-pagination': SalesGridPagination,
    },
    props: ['sales', 'pagination'],
    mounted() {
        console.log(this.sales);
    }
}
</script>
