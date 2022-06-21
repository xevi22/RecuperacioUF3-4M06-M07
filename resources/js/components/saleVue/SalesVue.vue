<template>
  <div class="container">
    <div class="row">
      <div class="col-4">
        <div v-if="alert" class="alert alert-danger" role="alert">
            Per crear la sala omple tots els camps.
        </div>

        <form v-if="editar" @submit.prevent="editarSala(sala)" >
          <div class="form-group">
            <label for="namee">Nombre Sala</label>
            <input type="text" class="form-control" id="namee" v-model="sala.name" placeholder="Name"><br>
          </div>
          <div class="form-group">
            <label for="casalaa">Capacidad Sala</label>
            <input type="number" class="form-control" id="casalaa" v-model="sala.capacity" placeholder="Capacidad sala">
          </div>
          <br>
          <br>
          <button type="submit" class="btn btn-primary">Edita</button>
          <button @click="cancela" style="float: right;" class="btn btn-dark">Cancela</button>

        </form>

        <form v-else @submit.prevent="crearSala" method="post">
          <div class="form-group">
            <label for="name">Nombre Sala</label>
            <input type="text" class="form-control" id="name" v-model="sala.name" placeholder="Name"><br>
          </div>
          <div class="form-group">
            <label for="casala">Capacidad Sala</label>
            <input type="number" class="form-control" id="casala" v-model="sala.capacity" placeholder="Capacidad sala">
          </div>
          <br>
          <br>
          <button type="submit" class="btn btn-primary">Crea</button>

        </form>

      </div>
      <div class="col-8">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">id Sala</th>
            <th scope="col">Nombre</th>
            <th scope="col">Capacidad</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(item, index) in sales">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.capacity }}</td>
            <td>
              <button v-if="!item.isAdmin" @click="editSala(item)" class="btn btn-success">Edit</button>
              <button v-if="!item.isAdmin" @click="deleteSala(item)" class="btn btn-dark">Delete</button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  data() {
    return {
      sales: [],
      sala: {name: '', capacity: ''},
      alert: false,
      editar:false

    }
  },

  created() {
    axios.get('/sales')
        .then(result => {
          this.sales = result.data
        })
  },

  methods: {
    crearSala() {
      if (this.sala.name !== '' && this.sala.capacity !== ''){
        this.alert=false;
        const params = {
          name: this.sala.name,
          capacity: this.sala.capacity
        }
        axios.post('/sala',params)
            .then(result => {
              this.sales.push(result.data)
            })
      }else {
        this.alert=true;
      }
    },

    deleteSala(item,index){
      axios.delete(`/sala/${item.id}`).then(()=>{
        axios.get('/sala').then(result=> {
          this.sales= result.data
        })
      })
    },

    editSala(item){
      this.editar = true
      this.sala.name = item.name;
      this.sala.capacity = item.capacity;
      this.sala.id = item.id;
    },
    editarSala(sala){
      const params = {
        name: sala.name,
        capacity: sala.capacity
      }
      axios.put(`/sala/${sala.id}`, params).then(res => {
            this.edit = false;
            this.sala = {nom: '', capacity: ''}
            axios.get('/sala')
                .then(res => {
                  this.sales = res.data;
                })
          })
    },

    cancela(){
      this.editar = false
      this.sala.name = '';
      this.sala.capacity = '';
    }

  }
}
</script>