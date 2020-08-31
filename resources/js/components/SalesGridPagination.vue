<template>
    <div class="grid-pagination">
        <div>
            Displaying {{ from }} to {{ to }} of {{ total }}
        </div>
        <nav>
            <a
                href="#"
                @click.prevent="current > 1 ? $emit('change-page', 1) : null"
                v-bind:class="{ disabled: current === 1 }"
            >
                << First
            </a>
            <button
                v-bind:disabled="!hasPrev()"
                @click="$emit('change-page', current - 1)"
            >Prev</button>
            <span class="current">{{ current }}</span>
            <button
                v-bind:disabled="!hasNext()"
                @click="$emit('change-page', current + 1)"
            >Next</button>
            <a href="#"
               @click.prevent="current < pagination.lastPage ? $emit('change-page', pagination.lastPage) : null"
               v-bind:class="{ disabled: current === pagination.lastPage }"
            >
                Last >>
            </a>
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
        },
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
