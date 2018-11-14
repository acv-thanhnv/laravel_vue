<template>
    <table class="form-control">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="item in itemSourceData" :key="item.value">
            <td>{{item.value}}</td>
            <td>{{item.label}}</td>
        </tr>
        </tbody>

    </table>
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
