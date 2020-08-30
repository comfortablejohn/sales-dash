<template>
    <div id="app">
        <div class="header">
            <nav class="header__nav">
                <ul>
                    <li><router-link to="/dashboard">Dashboard</router-link></li>
                    <li><router-link to="/data">Data Grid</router-link></li>
                </ul>
            </nav>
            <div class="header__logo">
                <h3>Sales Demo</h3>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
        }
    }
</script>
