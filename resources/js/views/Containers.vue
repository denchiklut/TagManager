<template>
  <div>
      <div class="card-expansion">
          <md-card>
              <md-card-area>
                  <md-card-media>
                      <md-toolbar class="md-dense">
                          <h3 class="md-title">Скрипт</h3>
                      </md-toolbar>
                      <md-content class="md-scrollbar">
                      <!--<img src="https://i0.wp.com/insights.samsung.com/wp-content/uploads/2017/12/programmingcodeabstractt_499140.jpg?ssl=1" alt="People">-->
                        <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias excepturi expedita fuga in ipsa ipsam quam repellendus temporibus tenetur. Consectetur culpa debitis eaque illum nostrum! Ex impedit porro possimus quasi!</h1>
                      </md-content>
                  </md-card-media>

                  <md-card-header>
                      <div class="md-title">Container: {{$route.params.id}}</div>
                      <div class="md-subhead">Subtitle here</div>
                  </md-card-header>
              </md-card-area>
              <md-card-actions md-alignment="space-between">
                  <div>
                      <md-button>Edit</md-button>
                      <md-button>Remove</md-button>
                  </div>
              </md-card-actions>
          </md-card>

          <router-link :to="{ name: 'companies' }" class="nav-link active">Назад</router-link>
      </div>
  </div>


</template>

<script>
    export default {
        props:['id'],
        name: "Containers"
    }
</script>
<style scoped>
    /*.card-expansion {*/
        /*height: 480px;*/
    /*}*/

    .md-card {
        width: 500px;
        margin: 4px;
        display: inline-block;
        vertical-align: top;
    }

    .md-content {
        max-width: 500px;
        max-height: 200px;
        overflow: auto;
        background: #282c33;
    }
</style>