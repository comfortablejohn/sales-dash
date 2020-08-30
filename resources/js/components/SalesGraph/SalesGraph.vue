<template>
    <div class="graph">
        <line-chart
            v-bind:styles="styles"
            v-bind:options="options"
            v-bind:chart-data="chartData"></line-chart>
    </div>
</template>
<script>
import LineChart from "./LineChart";

export default {
    data() {
        return {
            styles: {
                height: "100%",
                paddingLeft: "0",
                marginLeft: "0",
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        }
    },
    components: {
        'line-chart': LineChart,
    },
    computed: {
        chartData() {
            const byDay = this.totalsByDay;
            const dates = [];
            const totals = [];
            Object.keys(byDay).forEach(key => {
                const dateTokes = key.split('-');
                dates.push(`${dateTokes[2]}/${dateTokes[1]}`);
                totals.push(byDay[key]);
            });
            return {
                labels: dates,
                datasets: [{
                    data: totals,
                    label: "Sales"
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
