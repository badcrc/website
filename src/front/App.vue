<template>
  <div id="app">

    <header class="bg_primary">

      <div class="container">

        <div class="column row text-center">
          <img src="/assets/img/logo.png" alt="elComité">
          <h1 class="sans_font">Creando una escena de desarrollo tecnológico en Bilbao</h1>

        </div>



      </div>

    </header>

    <section class="bg_primary">

        <div class="container">
          <div class="row column">

            <article class="text-center event">
              <div class="media-object">
                <div class="media-object-section">
                  <h3>Próximo evento: {{last_event.datetime|moment}}</h3>
                  <p>{{last_event.description}}</p>
                  <a v-bind:href="last_event.url" class="button large">Únete</a>
                </div>
              </div>
            </article>

          </div>
        </div>


    </section>

    <section id="articles">

      <div class="container">


        <div class="row column">
          <h4>En nuestro <a href="http://medium.com/elcomite">Medium</a></h4>
        </div>

        <div class="row">


          <div v-for="item in articles" class="column medium-6 large-4">


              <a v-bind:href="item.link" class="article text-center" >


                <div class="image" v-bind:style="{ 'background-image': 'url(' + item.image + ')' }"></div>
                <h5 class="sans_font">{{item.title}}</h5>

                <p>{{item.description}}</p>

                <button class="button secondary">Leer más</button>


              </a>




          </div>



        </div>
      </div>


    </section>

    <section id="sponsors">


      <div class="container text-center">

        <h4>Colaboran</h4>

        <a v-for="item in sponsors"
           v-bind:href="item.url" class="sponsor">
          <img v-bind:src="item.logo_src" alt="item.name">
        </a>


      </div>

    </section>


    <footer class="bg_primary">

      <div class="container">
        <div class="row">
          <div class="column medium-6">
            elComité.bio
          </div>
          <div class="column medium-6">

          </div>
        </div>
      </div>

    </footer>
  </div>
</template>

<script>
import Hello from './components/Hello.vue';
import moment from 'moment';

export default {
    name: 'app',
    filters: {
        moment: function (date) {
            return moment(date).format('DD.MM.YYYY hh:mm');
        }
    },
    data: function () {
        return {
            last_event: window.last_event,
            articles: window.last_articles,
            sponsors: window.sponsors
        };
    },
    components: {
      Hello
    }
}
</script>

<style>
</style>
