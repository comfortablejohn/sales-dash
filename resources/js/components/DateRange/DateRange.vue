<template>
    <div class="date-range-filter">
        <form @submit.prevent="updateDate()">
            <div class="date-range-picker filter__input">
                <label for="from-date">From</label>
                <date-picker
                    format="yyyy-MM-dd"
                    id="from-date"
                    type="text"
                    v-model="from"
                ></date-picker>
            </div>
            <div class="date-range-picker filter__input">
                <label for="to-date">To</label>
                <date-picker
                    format="yyyy-MM-dd"
                    id="to-date"
                    type="text"
                    v-model="to"
                ></date-picker>
            </div>
            <button
                class="btn btn--primary"
                type="submit"
            >Update</button>
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
            if (!date) {
                return '';
            }

            return moment(date).format('YYYY-MM-DD');
        }
    }
}
</script>
