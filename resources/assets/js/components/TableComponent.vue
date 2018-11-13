<template>
    <select class="form-control">
        <option value="0">---</option>
        <option v-for="item in itemSourceData" :key="item.value" v-bind:value="item.label">{{item.label}}</option>
    </select>
</template>
<script>
    export default {
        props: ['dataUrl','prevLevel'],
        data: function () {
            return {itemSourceData: [{'value': 0, 'label': '---'}]}
        },
        mounted() {
            this.loading = true;
            var token = localStorage.getItem('access_token');
            axios(
                {   url:this.dataUrl,
                    headers: { Authorization: "Bearer " + token}
                }
            )
            .then((response) => {
                this.loading = false;
                console.log(response.data['data']);
                this.itemSourceData = response.data['data'];
            }, (error) => {
                this.loading = false;
            })
        },
    }
</script>
