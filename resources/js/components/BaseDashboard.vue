<template>
    <div class="container">
        <h1 class="hidden">Dashboard</h1>
        <date-range
            v-bind:initial-from-date="fromDate"
            v-bind:initial-to-date="toDate"
            v-on:update-date="onDateChange"
        ></date-range>
        <base-sales-graph
            v-bind:fromDate="fromDate"
            v-bind:toDate="toDate"
        ></base-sales-graph>
    </div>
</template>

<script>
    import BaseSalesGraph from "./BaseSalesGraph";
    import DateRange from "./DateRange/DateRange";

    export default {
        data() {
            return {
                fromDate: '2020-08-01',
                toDate: '2020-08-30',
            };
        },
        components: {
            "base-sales-graph": BaseSalesGraph,
            "date-range": DateRange,
        },
        methods: {
            onDateChange(dates) {
                console.log(dates);
                this.fromDate = dates.from;
                this.toDate = dates.to;
            }
        }
    }
</script>
