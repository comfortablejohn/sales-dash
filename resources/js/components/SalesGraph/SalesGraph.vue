<template>
    <div class="graph">
        <line-chart v-bind:chart-data="chartData"></line-chart>
    </div>
</template>
<script>
import LineChart from "./LineChart";

export default {
    components: {
        'line-chart': LineChart,
    },
    computed: {
        chartData() {
            const byDay = this.totalsByDay;
            const dates = [];
            const totals = [];
            Object.keys(byDay).forEach(key => {
                dates.push(key);
                totals.push(byDay[key]);
            });
            return {
                labels: dates,
                datasets: [{
                    data: totals,
                }]
            };
        }
    },
    props: {
        totalsByDay: {
            type: Object,
        }
    },
    watch: {
    }
}
</script>
