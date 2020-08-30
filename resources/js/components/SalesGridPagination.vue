<template>
    <div class="grid-pagination">
        <div>
            Displaying {{ from }} to {{ to }} of {{ total }}
        </div>
        <nav>
            <button
                v-bind:disabled="!hasPrev()"
                @click="$emit('prev')"
            >Prev</button>
            <span class="current">{{ current }}</span>
            <button
                v-bind:disabled="!hasNext()"
                @click="$emit('next')"
            >Next</button>
        </nav>
    </div>
</template>
<script>
export default {
    props: {
        pagination: {
            required: true,
            type: Object,
        }
    },
    methods: {
        hasPrev() {
            return this.pagination.currentPage > 1;
        },
        hasNext() {
            return this.pagination.currentPage < this.pagination.lastPage;
        }
    },
    computed: {
        current() {
            return this.pagination.currentPage;
        },
        from() {
            return this.pagination.from;
        },
        to() {
            return this.pagination.to;
        },
        total() {
            return this.pagination.total;
        }
    }
}
</script>
