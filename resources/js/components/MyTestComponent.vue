<template>
    <div class="container">
        <button :type="type" class="my-button" v-text="text">Hello!</button>
        <br>
        <button :type="type" class="my-button" v-text="test.name">Hello!</button>
    </div>
</template>

<script>
    export default {
        name: "MyTestComponent",

        mounted() {
            console.log('Component mounted.');

            axios.post('api/vue', {}).then(response => {
                this.test = response.data;
            });
        },

        data: function() {
            return {
                test: null,
            }
        },

        props: [
            'text',
            'type'
        ]
    }
</script>

<style scoped>
    .my-button {
        padding: 10px 20px;
        background-color: #6cb2eb;
    }
</style>
