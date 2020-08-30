<template>
    <div class="page">
        <h1 class="hidden">Dashboard</h1>
        <div class="filters">
            <date-range
                v-bind:initial-from-date="fromDate"
                v-bind:initial-to-date="toDate"
                v-on:update-date="onDateChange"
            ></date-range>
        </div>
        <base-sales-graph
            v-bind:fromDate="fromDate"
            v-bind:toDate="toDate"
        ></base-sales-graph>
    </div>
</template>

<script>
    import BaseSalesGraph from "./BaseSalesGraph";
    import DateRange from "./DateRange/DateRange";
    import moment from 'moment';

    export default {
        data() {
            return {
                fromDate: '',
                toDate: '',
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
        },
        created() {
            this.toDate = moment().format('YYYY-MM-DD');
            this.fromDate = moment().subtract(1, 'month').format('YYYY-MM-DD');
        }
    }
</script>
