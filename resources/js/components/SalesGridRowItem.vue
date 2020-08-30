<template>
    <tr class="grid-row grid-row__item">
        <td>{{ invoiceId }}</td>
        <td>{{ productName }}</td>
        <td @click="$emit('filter-customer', customerId)">{{ customerName }}</td>
        <td @click="$emit('filter-employee', employeeId)">{{ employeeName }}</td>
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
        date() {
            return this.sale.date;
        }
    }
}
</script>
