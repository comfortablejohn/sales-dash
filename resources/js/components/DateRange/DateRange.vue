<template>
    <div class="date-range-filter">
        <form @submit.prevent="updateDate()">
            <div class="date-range-filter__from">
                <label for="from-date">From</label>
                <date-picker
                    format="yyyy-MM-dd"
                    id="from-date"
                    type="text"
                    v-model="from"
                ></date-picker>
            </div>
            <div class="date-range-filter__to">
                <label for="to-date">To</label>
                <date-picker
                    format="yyyy-MM-dd"
                    id="to-date"
                    type="text"
                    v-model="to"
                ></date-picker>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</template>
<script>
import moment from 'moment';
import Datepicker from 'vuejs-datepicker';

export default {
    components: {
        'date-picker': Datepicker,
    },
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
            this.$emit('update-date', {
                from: this.format(this.from),
                to: this.format(this.to)
            });
        },
        format(date) {
            return moment(date).format('YYYY-MM-DD');
        }
    }
}
</script>
