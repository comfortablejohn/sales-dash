<template>
    <div class="search-input filter__input">
        <label v-bind:for="inputId">{{ inputLabel }}</label>
        <input
            v-bind:id="inputId"
            v-bind:placeholder="placeholder"
            v-model="searchString"
            @keydown="handleInputDebounced"
        />
    </div>
</template>
<script>
import { debounce } from 'lodash';
export default {
    data() {
        return {
            searchString: "",
        };
    },
    props: {
        inputId: {
            required: true,
            type: String,
        },
        inputLabel: {
            required: true,
            type: String,
        }
    },
    computed: {
        placeholder() {
            return "Search by " + this.inputLabel;
        }
    },
    methods: {
        handleInputDebounced: debounce(function() {
            this.$emit('on-change', this.searchString);
        }, 350)
    },
}
</script>
