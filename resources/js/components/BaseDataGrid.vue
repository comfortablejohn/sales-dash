<template>
    <div class="container">
        <h1 class="hidden">Data</h1>
        <date-range
            v-bind:initial-from-date="filter.fromDate"
            v-bind:initial-to-date="filter.toDate"
            v-on:update-date="onDateChange"
        ></date-range>
        <search-input
            v-on:on-change="onEmployeeChange"
            input-label="Employee"
            input-id="employee"
        ></search-input>
        <search-input
            v-on:on-change="onCustomerChange"
            input-label="Customer"
            input-id="customer"
        ></search-input>
        {{ sales }}
    </div>
</template>

<script>
    import DateRange from "./DateRange/DateRange";
    import SearchInput from "./SearchInput";
    import {getSales} from "../services/salesApi";

    const states = {
        LOADING: "LOADING",
        READY: "READY",
        ERROR: "ERROR",
    };

    export default {
        data() {
            return {
                states,
                state: states.LOADING,
                sales: [],
                filter: {
                    fromDate: "2020-08-01",
                    toDate: "2020-08-30",
                    employeeSearchString: "",
                    customerSearchString: "",
                },
            };
        },
        components: {
            'date-range': DateRange,
            'search-input': SearchInput,
        },
        methods: {
            onDateChange(dates) {
                this.setFilter('fromDate', dates.from);
                this.setFilter('toDate', dates.to);
            },
            onEmployeeChange(employeeSearchString) {
                console.log('update employee');
                console.log(employeeSearchString);
                this.setFilter('employeeSearchString', employeeSearchString);
            },
            onCustomerChange(customerSearchString) {
                this.setFilter('customerSearchString', customerSearchString);
            },
            setFilter(key, value) {
                const newFilterData = {};
                newFilterData[key] = value;
                this.filter = {
                    ...this.filter,
                    ...newFilterData
                };
            },
            fetchSales() {
                // this.state = states.LOADING;
                getSales(this.filter).then((sales) => {
                    this.sales = sales;
                });
            }
        },
        watch: {
            filter() {
                this.fetchSales();
            }
        },
        mounted() {
            this.fetchSales();
        }
    }
</script>
