<template>
    <div class="page">
        <h1 class="hidden">Data</h1>
        <div class="filters">
            <date-range
                v-bind:initial-from-date="filter.fromDate"
                v-bind:initial-to-date="filter.toDate"
                v-on:update-date="onDateChange"
            ></date-range>
            <div class="entity-filters">
                <div>
                    <search-input
                        v-bind:api="employeesApi"
                        v-on:on-change="onEmployeeChange"
                        input-label="Employee"
                        input-id="employee"
                    ></search-input>
                    <button class="btn btn--outline filter-pill"
                        v-if="filter.employee.id"
                        @click="onEmployeeChange" >
                        &times; {{ filter.employee.name }}
                    </button>
                </div>
                <div>
                    <search-input
                        v-bind:api="customersApi"
                        v-on:on-change="onCustomerChange"
                        input-label="Customer"
                        input-id="customer"
                    ></search-input>
                    <button class="btn btn--outline filter-pill"
                            v-if="filter.customer.id"
                            @click="onCustomerChange" >
                        &times; {{ filter.customer.name }}
                    </button>
                </div>
            </div>
        </div>
        <sales-grid
            v-bind:sales="sales"
            v-bind:pagination="pagination"
            v-on:change-page="handlePageChange"
            v-on:filter-employee="onEmployeeChange"
            v-on:filter-customer="onCustomerChange"
        ></sales-grid>
    </div>
</template>

<script>
    import DateRange from "./DateRange/DateRange";
    import SearchInput from "./SearchInput";
    import {getSales} from "../services/salesApi";
    import SalesGrid from "./SalesGrid";
    import customersApi from "../services/customersApi";
    import employeesApi from "../services/employeesApi";

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
                    fromDate: "",
                    toDate: "",
                    employee: {},
                    customer: {},
                },
                pagination: {},
                customersApi,
                employeesApi,
            };
        },
        components: {
            'date-range': DateRange,
            'search-input': SearchInput,
            'sales-grid': SalesGrid,
        },
        methods: {
            handlePageChange(page) {
                console.log('change page ' + page);
                if (page > 0 && page <= this.pagination.lastPage) {
                    this.setFilter('page', page);
                }
            },
            onDateChange(dates) {
                this.setFilter('fromDate', dates.from);
                this.setFilter('toDate', dates.to);
            },
            onEmployeeChange(employee) {
                this.setFilter('employee', employee);
            },
            onCustomerChange(customer) {
                this.setFilter('customer', customer);
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
                    customer: this.filter.customer.id,
                    employee: this.filter.employee.id,
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
