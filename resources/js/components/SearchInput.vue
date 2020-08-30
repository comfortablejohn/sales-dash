<template>
    <div class="search-input filter__input">
        <label v-bind:for="inputId">{{ inputLabel }}</label>
        <auto-complete
            v-bind:search="search"
            placeholder="Search by employee name"
            aria-label="Search by employee name"
            v-bind:debounce-time="200"
            v-bind:get-result-value="getResultValue"
            @submit="handleSubmit"
        >
            <template #result="{ result, props }">
                <li
                    v-bind="props"
                    class="autocomplete-result"
                >
                    <div class="">
                        {{ result.name }}
                    </div>
                </li>
            </template>
        </auto-complete>
    </div>
</template>
<script>
import Autocomplete from '@trevoreyre/autocomplete-vue'
export default {
    components: {
        'auto-complete': Autocomplete,
    },
    props: {
        api: {
            required: true,
            type: Object,
        },
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
        search(searchString) {
            if (searchString.length < 3) {
                return Promise.resolve([]);
            }
            return this.api.search(searchString);
        },
        getResultValue(result) {
            return result.name
        },
        handleSubmit(result) {
            this.$emit('on-change', result);
        }
    },
}
</script>
