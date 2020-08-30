<template>
    <tr class="grid-row grid-row__item">
        <td>{{ invoiceId }}</td>
        <td>{{ productName }}</td>
        <td>{{ customerName }}</td>
        <td>{{ employeeName }}</td>
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
        date() {
            return this.sale.date;
        }
    }
}
</script>
