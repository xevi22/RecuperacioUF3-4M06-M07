<template xmlns="http://www.w3.org/1999/html">

  <div class="container">
    <div v-if="this.alert===true" class="alert alert-success" role="alert">
      Valoració guardada correctament
    </div>
    <div class="row">
      <div class="col-3">
        <h3>Llista reserves a valorar</h3>
        <form @submit.prevent="creaValoForm" method="post">
          <div class="form-group">
            <label for="name">Valoracion sobre juego: {{this.valo.idRes}}</label>
            <input type="text" class="form-control" id="name" v-model="valo.opinio" placeholder="Escribe tu valoracion"><br>
          </div>

          <button type="submit" class="btn btn-success">Crea</button>

        </form>
      </div>
      <div class="col-8">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">id Reserva</th>
            <th scope="col">id Joc</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(item, index) in reserves">
            <td>{{ item.id }}</td>
            <td>{{ item.game_id }}</td>
            <td>
              <button @click="creaValo(item)" class="btn btn-dark">Valorar</button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>

import {isEmpty} from "lodash/lang";

export default {
  data() {
    return {
      reserves: [],
      valo: {idRes: '', opinio: '',},
      alert: false
    }
  },

  created() {
    axios.get('/reserve')
        .then(result => {
          this.reserves = result.data
        })
  },
  methods: {
    creaValo(item) {
      this.valo.idRes = item.id
    },
    creaValoForm() {
        const params = {
          idRes: this.valo.idRes,
          opinio: this.valo.opinio
        }

        axios.post('/valoracio', params)
        if (!isEmpty(this.valo.opinio)){
          axios.delete(`/reserva/${this.valo.idRes}`).then(() => {
            axios.get('/reserve').then(result => {
              this.reserves = result.data
              this.alert=true
            })
          })
        }
        this.valo.idRes=''
        this.valo.opinio=''

    }

  }
}
</script>

