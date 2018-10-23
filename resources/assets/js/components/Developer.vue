<template>
    <div class="container">
        <div class="row justify-content-center" v-if="$gate.isSuperAdmin()">
            <div class="col-md-12">
                <passport-clients></passport-clients>
                <passport-authorized-clients></passport-authorized-clients>
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
        <div v-if="!$gate.isSuperAdmin()">
            <not-found></not-found>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
