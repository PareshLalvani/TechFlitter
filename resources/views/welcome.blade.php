<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" name="viewport" />
        <style type="text/css">
            [v-cloak] { display: none; } .v-navigation-drawer--absolute { position: fixed;  } .v-data-table__wrapper tbody td { cursor: pointer;  }
        </style>
    </head>
    <body>
        <div id="app">
            <v-app>
                <v-container>
                    <v-card>
                        <v-card-title>
                            Users
                            <v-spacer></v-spacer>
                            <v-text-field append-icon="search" hide-details="" label="Search" single-line="" v-model="search"></v-text-field>
                        </v-card-title>
                        <v-data-table :disable-sort="true" :footer-props="{'items-per-page-options': [10, 20, 30, 40, 50]}" :headers="headers" :items="users" :items-per-page.sync="perPage" :loading="loading" :page.sync="page" :search="search" :server-items-length="totalUsers" @click:row="viewUserInfo" class="elevation-1" loading-text="Loading... Please wait"></v-data-table>
                    </v-card>
                    <v-navigation-drawer v-cloak absolute="" temporary="" v-if="user" v-model="showUser">
                        <v-list-item>
                            <v-list-item-avatar>
                                <v-img src="https://imgplaceholder.com/420x320/cccccc/757575/glyphicon-user"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <span :title="user.name">
                                        @{{ user.name }}
                                    </span>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <strong>
                                        Phone:
                                    </strong>
                                    <span :title="user.phone">
                                        @{{ user.phone }}
                                    </span>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <strong>
                                        Company:
                                    </strong>
                                    <span :title="user.company">
                                        @{{ user.company }}
                                    </span>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-navigation-drawer>
                </v-container>
            </v-app>
        </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js">
</script>
<script crossorigin="anonymous" integrity="sha256-T/f7Sju1ZfNNfBh7skWn0idlCBcI3RwdLSS4/I7NQKQ=" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js">
</script>
<script>
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
      data () {
      return {
        loading: true,
        totalUsers: 0,
        headers: [
          {
            text: 'Name',
            value: 'name',
          },
          {
            text: 'Email',
            value: 'email',
          },
        ],
        users: [],
        page : 1,
        perPage : 10,
        search : '',
        showUser: false,
        user : null,
      }
    },
    created() {
        this.getUsers();
    },
    watch: {
        page() {
            this.getUsers();
        },
        perPage() {
            this.getUsers();
        },
        search() {
            this.getUsers();
        },
        showUser(value) {
            if(!value) this.user = null;
        }
    },
    methods: {
        async getUsers() {
            let url = "{{ url('/') }}/api/user/getUsers";
            let input = {
                page : this.page,
                perPage : this.perPage,
                search : this.search
            };
            const response = await axios.post(url, input)
                .then(response => {
                    let data = response.data;
                    return data;
                })
                .catch(e => {
                    return null;
                });
            if(response) {
                let data = response.data;
                this.loading = false;
                this.users = data.users;
                this.totalUsers = data.count;
            }
        },
        viewUserInfo(user) {
            this.user = user;
            this.showUser = true;
        }
    }
})
</script>
