<template>
  <div class="container">
    <div v-show="loading" class="d-flex justify-content-center">
        <i v-show="loading" class="fa fa-spinner fa-2x fa-spin mt-1"></i>
    </div>
    <div v-if="countItems > 0">

      <div class="input-group my-2">
        <input v-model="search" class="form-control py-2 border-right-0 border" type="text" placeholder="Search..">
        <span class="input-group-append">
              <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
        </span>
      </div>
      <div class="list-group">
        <a v-for="item in filteredItems" v-bind:href="'/gymnasts/'+ item.event_id + '/' + item.startno" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
          {{ item.startno }} - {{ item.name }} &middot; {{ item.category}}
          <span class="badge badge-primary badge-pill">{{ item.count }}</span>
        </a>
      </div>
    </div>
    <div v-else="countItems == 0" v-show="!loading">
      <div class="list-group">
        <button type="button" class="list-group-item list-group-item-info">Keine Daten vorhanden.</button>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  components: {
    // BaseInputText, TodoListItem
  },
  props:{
    event_id: { required: true },
  },
  data(){
    return {
      loading: true,
      items:[],
      search:'',
    }
  },
  mounted () {
    axios.get('/api/list/' + this.event_id)
    .then(response => this.items = response.data )
    .finally(() => this.loading = false)
  },
  computed:{
    filteredItems(){
      return this.items.filter(item =>  {
        var number = item.startno.toString()
        return item.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
        || number.indexOf(this.search) > -1
      })
    },
    countItems () {
      return Object.keys(this.items).length
    }
  }
}

</script>
