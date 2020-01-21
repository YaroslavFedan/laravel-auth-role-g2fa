<template>
    <div>
        <md-table v-model="users" md-sort="name" md-sort-order="asc" md-card>

            <md-table-row slot="md-table-row" slot-scope="{ item }">
                <md-table-cell md-label="ID" md-numeric>{{ item.id }}</md-table-cell>
                <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
                <md-table-cell md-label="Email" md-sort-by="email">{{ item.email }}</md-table-cell>
                <md-table-cell md-label="Gender" md-sort-by="gender">{{ item.gender }}</md-table-cell>
                <md-table-cell md-label="Job Title" md-sort-by="title">{{ item.title }}</md-table-cell>
            </md-table-row>
        </md-table>
    </div>
</template>

<script>
    export default {
        name: 'TableSort',
        data: () => ({
            users:[],
        }),
        methods: {
            getUsers: function(){
                axios.get('/api/user').then( ({data}) => {
                   this.users = data;
                })
            }
        },
        mounted:function(){
            this.getUsers()
        }
    }
</script>