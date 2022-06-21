<template>

  <div class="container">
    <div class="row">
      <div class="col">
        <div v-if="editat" class="alert alert-success" role="alert">
          Usuari editat correctament
        </div>
        <form @submit.prevent="editarUser(user)" >
          <div class="form-group">
            <label for="namee">User name</label>
            <input type="text" class="form-control" id="namee" v-model="user.name" placeholder="Name"><br>
          </div>

          <br>
          <br>
          <button type="submit" class="btn btn-primary">Edita</button>
          <button @click="cancela" style="float: right;" class="btn btn-dark">Cancela</button>

        </form>
    </div>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return {
      user: {id:'', name: ''},
      editat: false
    }
  },

  created() {
    axios.get('/users')
        .then(result=> {
          this.users = result.data
        })

    axios.get('/usergetUs').then(result=>{
      this.user.id = result.data.id;
      this.user.name = result.data.name;
    })
  },

  methods: {
    cancela(){
      this.user.name = '';
      this.user.password = '';
      axios.get('/usergetUs').then(result=>{
        this.user.id = result.data.id;
        this.user.name = result.data.name;
      })
    },
    editarUser(user){
      const params = {
        id: user.id,
        name: user.name,

      }
      axios.put(`/users/${this.user.id}`, params).then(res => {
        axios.get('/usergetUs').then(result=>{
          this.editat=true
          this.user.id = result.data.id;
          this.user.name = result.data.name;
        })
      })
    },
  }
}
</script>