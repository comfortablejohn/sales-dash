<template>
    <div>
        Showing for {{ fromDate }} {{ toDate }}
        <sales-graph
            v-bind:totals-by-day="totalsByDay"
        ></sales-graph>
    </div>
</template>
<script>
import statsApi from '../services/statsApi';
import SalesGraph from "./SalesGraph/SalesGraph";

const states = {
    LOADING: "LOADING",
    READY: "READY",
    ERROR: "ERROR",
};

export default {
    components: {
        "sales-graph": SalesGraph,
    },
    props: {
        fromDate: {
            type: String,
        },
        toDate: {
            type: String,
        },
    },
    data() {
        return {
            states,
            state: states.LOADING,
            totalsByDay: {},
        }
    },
    methods: {
        fetchDailySalesCount() {
            this.state = states.LOADING;
            statsApi.dailySalesCount({ from: this.fromDate, to: this.toDate }).then((totalsByDay) => {
                this.state = states.READY;
                this.totalsByDay = totalsByDay;
            })
        }
    },
    watch: {
        fromDate() {
            this.fetchDailySalesCount();
        },
        toDate() {
            this.fetchDailySalesCount();
        }
    },
    created() {
        this.fetchDailySalesCount();
    }
}

const dummyTotals = {
    "2020-08-01": 21,
    "2020-08-02": 15,
    "2020-08-03": 16,
    "2020-08-04": 16,
    "2020-08-05": 15,
    "2020-08-06": 18,
    "2020-08-07": 21,
    "2020-08-08": 17,
    "2020-08-09": 16,
    "2020-08-10": 17,
    "2020-08-11": 14,
    "2020-08-12": 22,
    "2020-08-13": 18,
    "2020-08-14": 24,
    "2020-08-15": 14,
    "2020-08-16": 19,
    "2020-08-17": 22,
    "2020-08-18": 13,
    "2020-08-19": 18,
    "2020-08-20": 17,
    "2020-08-21": 21,
    "2020-08-22": 15,
    "2020-08-23": 13,
    "2020-08-24": 14,
    "2020-08-25": 20,
    "2020-08-26": 6,
    "2020-08-27": 14,
    "2020-08-28": 18,
    "2020-08-29": 21,
    "2020-08-30": 13
};
</script>
