<template>
  <div class="container">
    <div v-show="loading" class="d-flex justify-content-center">
        <i v-show="loading" class="fa fa-spinner fa-2x fa-spin mt-1"></i>
    </div>
    <div v-if="countItems > 0">
      <ul class="list-group">
        <li class="list-group-item" v-bind:class="{ 'rg_animate': item.color == 1 }" v-for="item in items">
          <div class="media">
            <div v-if="item.apparatus">
              <a v-bind:href="'/gymnasts/'+ item.event_id + '/' + item.startno"><img class="mr-3" :src="item.imageUrl" alt="RG image"></a>
            </div>
            <div v-else>
              <img class="mr-3" :src="item.imageUrl" alt="RG image" width="80">
            </div>
            <div class="media-body">
              <h4>{{ item.startno }} {{ item.name }} &middot; {{ item.category }}</h4>
              <strong>{{item.apparatus}}: {{ item.f_score }}</strong><br />D:{{ item.d_score }} E:{{ item.e_score }} {{ item.penalty}}
              <div class="float-sm-right"><i class="far fa-clock"></i>
                <small>{{ item.updated_at_humans }}</small>
                <a v-bind:href="'/gymnasts/'+ item.event_id + '/' + item.startno" class="text-dark"><i class="fas fa-chevron-down"></i></a>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <div v-show="loadingbottom" class="d-flex justify-content-center">
        <i v-show="loadingbottom" class="fa fa-spinner fa-2x fa-spin mb-5"></i>
      </div>
    </div>
    <div class="jumbotron jumbotron-fluid" v-else="countItems == 0" v-show="!loading">
      <div class="container-fluid">
        <h1 class="display-4">{{ StartLang }}</h1>
        <p class="lead">{{ TextLang }}</p>
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
    lang_start: { required: true },
    lang_text: { required: true },
  },
  data() {
    return {
      page: 10,
      interval: null,
      bottom: false,
      loading: false,
      loadingbottom: false,
      items: [],
      countLoad: 0,
      StartLang: this.lang_start,
      TextLang: this.lang_text
    }
  },
  watch:{
    bottom(bottom) {
      if (bottom) {
        this.page = this.page + 10
        if (this.page > 10){
         this.loadingbottom = true;
        }
        this.loadData()
      }
    },
  },
  methods: {
    bottomVisible() {
      const scrollY = window.scrollY
      const visible = document.documentElement.clientHeight
      const pageHeight = document.documentElement.scrollHeight
      const bottomOfPage = visible + scrollY >= pageHeight
      return bottomOfPage || pageHeight < visible
    },
    loadData: function () {
      if (this.countLoad < 1 )
      {
        this.loading = true;
      }
      axios.get('/api/live/' + this.page )
      .then(response => this.items = response.data)
      .finally(() => {this.loading = false, this.loadingbottom = false, this.countLoad++ })
      return this.items
    }
  },
  created: function () {
    window.addEventListener('scroll', () => {
     this.bottom = this.bottomVisible()
    });
   this.loadData();
    this.interval = setInterval(function () {
      this.loadData();
    }.bind(this), 30000);
  },
  beforeDestroy: function(){
    clearInterval(this.interval);
  },
  computed:{
    countItems () {
      return Object.keys(this.items).length
    },
  }
}
</script>

<style>
.rg_animate {
  -webkit-animation: colorchange 5s;
  animation: colorchange 5s;
}
@-webkit-keyframes color-change {
    0% { background: #e0a3a2; }
    50% { background: #e0bfbf; }
    100% { background: #f8fafc; }
    }
@keyframes colorchange {
    0% { background: #e0a3a2; }
    50% { background: #e0bfbf; }
    100% { background: #f8fafc; }
    }
</style>
