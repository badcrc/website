<template>
  <div id="app">

    <header class="bg_primary" v-bind:style="{ 'background-image': 'url(' + main_image.url + ')' }">



      <div class="contrast_layer"></div>
      <div class="claim">

        <div class="container">


          <div class="column row text-center">
            <div class="credit_cont">
              <a v-bind:href="main_image.user_src" target="_blank" class="image_credits">crédito de la imagen</a>

            </div>
            <img src="/assets/img/logo.png" alt="elComité">
            <h1 class="sans_font">Somos una comunidad de creadores que nos juntamos para crear proyectos en Bilbao.</h1>

          </div>



        </div>
      </div>

    </header>

    <section class="bg_primary" v-if="last_event">

        <div class="container">
          <div class="row ">

            <div class="column medium-7">
              <article class="event">
                <div class="media-object">
                  <div class="media-object-section">
                    <h3><span class="fa fa-calendar"></span> {{last_event.datetime|moment}}</h3>
                    <p>{{last_event.description}}</p>

                  </div>
                </div>
              </article>
            </div>
            <div class="column medium-4 medium-offset-1">
              <a v-bind:href="last_event.url" class="button large expanded">Apúntate en nuestro Meetup</a>
            </div>



          </div>
        </div>


    </section>

    <section id="articles" v-if="articles.length">

      <div class="container" >


        <div class="row column">
          <h4>En nuestro <a href="http://medium.com/elcomite">Medium</a></h4>
        </div>

        <div class="row" >



          <div v-for="item in articles" class="column large-4">


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

    <section id="sponsors"  v-if="sponsors.length">


      <div class="container text-center">

        <h4>Colaboran con nosotros</h4>

        <a v-for="item in sponsors"
           v-bind:href="item.url" class="sponsor">
          <img v-bind:src="item.logo_src" alt="item.name">
        </a>


      </div>

    </section>


    <footer class="bg_primary">

      <div class="container">
        <div class="row">
          <div class="column small-6">
            elComite.bio
          </div>
          <div class="column small-6 text-right">

            <a v-bind:href="social_links.twitter"><span class="fa fa-twitter icon-w"></span></a>
            <a v-bind:href="social_links.mail"><span class="fa fa-envelope icon-w"></span></a>

          </div>
        </div>
      </div>

    </footer>
  </div>
</template>

<script>
import moment from 'moment';

export default {
    name: 'app',
    filters: {
        moment: function (date) {
            return moment(date).format('DD/MM/YYYY hh:mm');
        }
    },
    data: function () {

        const images = window.hero_images.sort( function() { return 0.5 - Math.random() } );

        return {
            last_event: window.last_event,
            articles: window.last_articles,
            sponsors: window.sponsors,
            main_image: images[0],
            social_links: social_links
        };
    },
    components: {

    }
}
</script>

