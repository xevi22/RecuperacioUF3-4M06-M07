<template>

  <div class="container">
    <div class="row">
      <div class="col-4">
        <form @submit.prevent="crearJoc()" method="post">
          <div class="form-group">
            <label for="name">Nombre Juego</label>
            <input type="text" class="form-control" id="name" placeholder="Name"  v-model="joc.name"><br>
          </div>
          <div class="form-group">
            <label for="img">Imagen Juego</label>
            <input type="file" class="form-control" @change="onFileSelected" id="img" placeholder="Password" >
          </div>
          <br>
          <div class="form-group">
            <label>Sala</label>
            <select class="form-select" aria-label="Default select example"  v-model="joc.room_id">
              <option  disabled>Selecciona una sala</option>
              <option  v-for="sala in sales" :key="sala.name" :value="sala.id">{{sala.id}}  - {{sala.name}}</option>
            </select>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Crea</button>
        </form>
      </div>
      <div class="col-8">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">id Joc</th>
            <th scope="col">Nombre</th>
            <th scope="col">Room id</th>

          </tr>
          </thead>
          <tbody>
          <tr v-for="(item, index) in jocs">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.room_id }}</td>
            <td>
              <button @click="deleteJoc(item)" class="btn btn-dark">Delete</button>
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
      jocs: [],
      joc: {name: '', room_id: ''},
      sales:[],
      selectedFile:null
    }
  },

  created() {
    axios.get('/jocs')
        .then(result => {
          this.jocs = result.data
        })
    axios.get('/sala')
        .then(res => {
          this.sales = res.data
        })
  },

  methods: {
    onFileSelected(event){
      this.selectedFile = event.target.files[0];
    },
    crearJoc() {
      const params = {
        name: this.joc.name,
        img: this.selectedFile.name,
        room_id: this.joc.room_id
      }
      axios.post(`/jocs`, params).then(() => {
        axios.get('/jocs').then(result => {
          this.jocs = result.data
        })
      })
    },
    deleteJoc(item){
      axios.delete(`/jocs/${item.id}`).then(()=>{
        axios.get('/jocs').then(result=> {
          this.jocs= result.data
        })
      })
    },
  }
}
</script>