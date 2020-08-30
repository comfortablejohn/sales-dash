<template>
    <div class="page">
        <h1 class="hidden">Data</h1>
        <div class="filters">
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
        </div>
        <sales-grid
            v-bind:sales="sales"
            v-bind:pagination="pagination"
            v-on:next="handleNext"
            v-on:prev="handlePrev"
        ></sales-grid>
    </div>
</template>

<script>
    import DateRange from "./DateRange/DateRange";
    import SearchInput from "./SearchInput";
    import {getSales} from "../services/salesApi";
    import SalesGrid from "./SalesGrid";

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
                    page: 1,
                    fromDate: "2020-08-01",
                    toDate: "2020-08-30",
                    employeeSearchString: "",
                    customerSearchString: "",
                },
                pagination: {}
            };
        },
        components: {
            'date-range': DateRange,
            'search-input': SearchInput,
            'sales-grid': SalesGrid,
        },
        methods: {
            handleNext() {
                console.log('next')
                if (this.filter.page < this.pagination.lastPage) {
                    this.setFilter('page', this.filter.page + 1);
                }
            },
            handlePrev() {
                console.log('prev')
                if (this.filter.page > 1) {
                    this.setFilter('page', this.filter.page - 1);
                }
            },
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
                if (key !== 'page') {
                    newFilterData['page'] = 1;
                }
                this.filter = {
                    ...this.filter,
                    ...newFilterData
                };
            },
            fetchSales() {
                // this.state = states.LOADING;
                getSales({
                    from: this.filter.fromDate,
                    to: this.filter.toDate,
                    customer: this.filter.customerSearchString,
                    employee: this.filter.employeeSearchString,
                    page: this.filter.page || 1,
                }).then((response) => {
                    this.sales = response.data;
                    this.pagination = {
                        currentPage: response.current_page,
                        lastPage: response.last_page,
                        from: response.from,
                        to: response.to,
                        total: response.total,
                    };
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
