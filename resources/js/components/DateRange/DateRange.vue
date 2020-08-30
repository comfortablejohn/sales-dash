<template>
    <div class="date-range-filter">
        <form @submit.prevent="updateDate()">
            <div class="date-range-filter__from">
                <label for="from-date">From</label>
                <input
                    id="from-date"
                    type="text"
                    v-model="from"
                />
            </div>
            <div class="date-range-filter__to">
                <label for="to-date">To</label>
                <input
                    id="to-date"
                    type="text"
                    v-model="to"
                />
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</template>
<script>

export default {
    data() {
        return {
            from: this.initialFromDate,
            to: this.initialToDate,
        };
    },
    props: {
        initialFromDate: {
            type: String,
        },
        initialToDate: {
            type: String,
        }
    },
    methods: {
        updateDate() {
            console.log('updateDate');
            this.$emit('update-date', { from: this.from, to: this.to });
        }
    }
}
</script>
