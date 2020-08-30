<template>
    <tr class="grid-row grid-row__item">
        <td>{{ invoiceId }}</td>
        <td>{{ productName }}</td>
        <td><span class="actionable" @click="$emit('filter-customer', customerForFilter)">{{ customerName }}</span></td>
        <td><span class="actionable" @click="$emit('filter-employee', sale.employee)">{{ employeeName }}</span></td>
        <td>{{ date }}</td>
    </tr>
</template>

<script>
export default {
    props: {
        sale: {
            required: true,
        }
    },
    computed: {
        productName() {
            return this.sale.product.name;
        },
        invoiceId() {
            return this.sale.invoice_id;
        },
        customerName() {
            const customer = this.sale.customer;
            return [customer.first_name, customer.last_name].join(' ');
        },
        employeeName() {
            return this.sale.employee.name;
        },
        employeeId() {
            return this.sale.employee.id;
        },
        customerId() {
            return this.sale.customer.id;
        },
        customerForFilter() {
            return {
                id: this.sale.customer.id,
                name: this.customerName,
            }
        },
        date() {
            return this.sale.date;
        }
    }
}
</script>
