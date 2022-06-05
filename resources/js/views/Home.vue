<template>
    <v-container>
        <v-row class="justify-content-center text-center">
            <v-col cols="12" xl="12" lg="12" md="2" sm="12" xs="12">
                <h1 class="mb-0 text-primary-nx">
                    <b>¡BIENVENIDOS A NX!</b></h1>
                <p class="mb-0"><b>NEXURA INTERNACIONAL S.A.S</b></p>
            </v-col>
            <v-col cols="12" xl="4" lg="4" md="4" sm="4" xs="4">
                <img :src="'/images/errors/welcome.svg'" alt="welcome.svg">
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Home"
}
</script>

<style scoped>
.text-primary-nx {
    color: #941C23 !important;
}
</style>
