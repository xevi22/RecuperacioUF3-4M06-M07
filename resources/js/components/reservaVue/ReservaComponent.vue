<template xmlns="http://www.w3.org/1999/html">
    <div class="container">
      <div class="row" v-if="!this.veureRes">
        <div class="col-2">
          <form @submit.prevent="crearReser" method="post">
            <div class="form-group">
              <h4 for="name"><b>{{this.joc.name}}</b></h4>
            </div>
            <div class="form-group">
              <label for="date">Dia reserva per el <b>{{this.joc.name}}</b></label>
              <input type="date" class="form-control" id="date" v-model="reserva.date"><br>
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
            <button @click="verureRese" class="btn btn-dark">Veure Reserves</button>
          </form>
        </div>
        <div class="col-8">
          <table class="table">
            <thead>
            <tr>
              <th scope="col">Nom Joc</th>
              <th scope="col">idRoom</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in jocs">
              <td>{{ item.name }}</td>
              <td>{{ item.room_id }}</td>
              <td>
                <button @click="creaRes(item)" class="btn btn-dark">Reserves</button>

              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    <div class="row" v-else>
      <div class="col-2">
        <h3>Llista Reserves</h3>
        <button @click="tornaRese" class="btn btn-dark">Torna</button>
      </div>
      <div class="col-8">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">id Reserva</th>
            <th scope="col">date</th>
            <th scope="col">idJoc</th>

          </tr>
          </thead>
          <tbody>
          <tr v-for="(item, index) in reserves">
            <td>{{ item.id }}</td>
            <td>{{ item.date }}</td>
            <td>{{ item.game_id }}</td>
            <td>
              <button v-if="isAdmin" @click="editRes(item)" class="btn btn-success">Accepta reserva</button>
              <button @click="borraRes(item)" class="btn btn-danger">Cancelar reserva</button>
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
      joc: {name: '', idJoc: '',},
      reserves: [],
      reserva: {date: '',},
      veureRes: false,
      isAdmin:false,
      user: {isAdmin: '',}
    }
  },

  created() {
    axios.get('/jocs')
        .then(result => {
          this.jocs = result.data
        })
    axios.get('/reserva')
        .then(result => {

          this.reserves = result.data
        })
    axios.get('/userReserva').then(result => {
      if (result.data ===1){
        this.isAdmin=true
      }
    })
    axios.get('/usergetUs').then(result=>{
      this.isAdmin = result.data.isAdmin;
    })
  },
  methods:{

    verureRese(){
      this.veureRes=true
    },
    tornaRese(){
      this.veureRes=false
    },

    creaRes(jooc){
      this.joc.name=jooc.name
      this.joc.idJoc= jooc.id
    },
    crearReser() {
        const params = {
          date: this.reserva.date,
          game_id: this.joc.idJoc
        }

        axios.post('/reserva',params)
            .then(result => {
              this.reserves.push(result.data)
              this.veureRes=true
            })

    },

    borraRes(item,index){
      axios.delete(`/reserva/${item.id}`).then(()=>{
        axios.get('/reserva').then(result=> {
          this.reserves= result.data
        })
      })
    },
    editRes(item,index){
      axios.put(`/reserva/${item.id}`).then(()=> {
        axios.get('/reserva')
            .then(res => {
              this.reserves = res.data;
            })
      })
    },



  }
}
</script>

