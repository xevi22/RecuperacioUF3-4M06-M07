<template>


  <div class="container">

    <div class="row" >
      <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 18rem; margin-right:10px;"
           v-for="(item, index) in jocs">
        <img style="height:350px ;" :src="getImgUrl(item.img)" v-bind:alt="item.img"/>
        <div class="card-body">
          <h1 class="card-title" style="">{{item.name}}</h1>
          <h4 class="card-text">Room id: {{item.room_id}} </h4>
          <a style="text-decoration: none; color:white" href="reserva" ><button class="btn btn-dark">Reserva</button></a>
        </div>
      </div>
    </div>

  </div>

</template>

<script>

export default {
  data() {
    return {
      jocs: [],

    }
  },

  created() {
    axios.get('/jocs')
        .then(result => {
          this.jocs = result.data
        })
  },

  methods: {
    getImgUrl(pet) {
      var images = require.context('../../../views/imgs/', false, /\.png$/)
      return images('./' + pet)
    },

  }
}
</script>

