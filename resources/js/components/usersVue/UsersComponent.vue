<template>
  <div class="container">
  <table class="table">
    <thead>
    <tr>
      <th scope="col">id User</th>
      <th scope="col">Nombre</th>
      <th scope="col">mail</th>
      <th scope="col">isAdmin</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(item, index) in users">
      <td>{{item.id}}</td>
      <td>{{item.name}}</td>
      <td>{{item.email}}</td>
      <td>{{item.isAdmin}}</td>
      <td><button v-if="!item.isAdmin" @click="deleteUser(item)"  class="btn btn-dark">Delete</button></td>
    </tr>
    </tbody>
  </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      user: {name: ''}
    }
  },

  created() {
    axios.get('/users')
    .then(result=> {
      this.users=  result.data
    })
  },

  methods:{
    deleteUser(item,index){
      axios.delete(`/users/${item.id}`).then(()=>{
       axios.get('/users').then(result=> {
         this.users= result.data
       })
      })
    }
  }
}
</script>