<div id="home">
    <img class="home_main_img" src="./public/images/presTinyHouse.jpg" alt="Visuel sur une tiny house de Low Tech">

    <section id="projet" class="section_with_icon">
        <div class="icon_right">
            <div class="home_text">
                <h2 class="home_section_title">Le projet</h2>
                <p class="home_description">Low Tech Lab Bordeaux va, au cours des deux prochaines années, entreprendre
                    un projet de construction de Tiny House équipées de Low-Techs, tels qu’un poêle de masse, un garde
                    manger, marmite norvégienne ou une jardinière autonome.</p>
                <p class="home_description">Ce projet fera collaborer différentes associations, et la tiny sera exposée
                    sur les quais de la Garonne à Bordeaux.</p>
            </div>
            <img class="home_icon" id="home_icon_hammer" src=".\public\images\elements\elements3_hammer.png"
                alt="Icone marteau">
        </div>
    </section>

    <section id="objectifs" class="section_with_icon">
        <div class="icon_left">
            <div class="home_text">
                <h2 class="home_section_title">Les objectifs</h2>
                <ul class="home_description">
                    <li>Sensibiliser le grand public autour des enjeux écologiques, l'éco-construction, de la low tech
                        et du réemploi.</li>
                    <li>Proposer des chantiers participatifs où chacun peut venir contribuer ou apprendre à bricoler
                    </li>
                </ul>
                <p class="home_description">En créant un maillage des acteurs Low Tech sur le territoire, l’association
                    veut devenir la vitrine du réseau Low Tech de la région, développer des partenariats avec les autres
                    acteurs et créer une dynamique sur le territoire de la Nouvelle-Aquitaine.</p>
            </div>
            <img class="home_icon" src=".\public\images\elements\elements5_recycle.png" alt="Icone tri selectif">
        </div>
    </section>

    <section id="actors">
        <div class="section_with_icon">
            <div class="icon_right">
                <div class="home_text">
                    <h2 class="home_section_title">Les acteurs</h2>
                    <p class="home_description"><i>Low Tech Lab Bordeaux (LTLB)</i> est une association de Loi 1901 qui
                        croit au pouvoir de l'innovation utile, accessible et durable pour répondre aux enjeux
                        écologiques d'aujourd'hui et de demain.</p>
                    <p class="home_description">Les basses technologies offrent à chacun et partout, les moyens de
                        répondre à ses besoins dans le respect des Humains et de la Planète.</p>
                    <p class="home_description"><i>Ses valeurs : Accessibilité, partage, sobriété, résilience,
                            collaboration, autonomie, réemploi</i></p>
                    <br>
                    <p class="home_description">Ce projet est une collaboration avec deux autres structures, Tiny Lab et
                        La Planche.</p>
                </div>
                <img class="home_icon" src=".\public\images\elements\elements6_earth.png" alt="Icone Terre">
            </div>
        </div>

        <div class="vert_clair_bg">
            <div>
                <img class="actor_logo" id="tiny_lab_logo" src=".\public\images\tiny_lab_logo.png"
                    alt="Logo de Tiny Lab">
                <p class="actors_description">Association créée par des professionnels de l'éco-construction, dont les
                    activités se concentrent autour de la construction inclusive de tiny houses et habitats légers
                    autonomes.</p>
            </div>

            <div>
                <img class="actor_logo" id="la_planche_logo" src=".\public\images\la_planche_logo.png"
                    alt="Logo de La Planche">
                <p class="actors_description">Atelier partagé situé dans le quartier Saint-Michel à Bordeaux entièrement
                    dédié au matériau bois, dans lequel artisans·anes, concepteurs·trices et grand public viennent
                    mutualiser des outils de travail, apprendre, fabriquer et partager leurs savoir-faire.</p>
            </div>
        </div>
</div>
</section>


<section id="enjeux">
    <div class="vert_moyen_bg">
        <div>
            <h2 class="home_section_title">Une maison totalement écologique et low-tech</h2>
            <iframe class="ytb_player" src="https://www.youtube.com/embed/l8X9jxeYYmw"></iframe>
        </div>
    </div>
</section>
</div>

<style>
    @media (max-width: 1150px) {
        .section_with_icon {
            margin-bottom: 25vh;
        }
    }

    @media (max-width: 992px) {
        .section_with_icon {
            margin-bottom: 35vh;
        }

        .home_icon {
            height: 225%;
            margin-top: -10vh;
        }
    }

    @media (max-width: 768px) {
        #home {
            overflow-y: hidden;
        }

        .section_with_icon {
            margin-bottom: 50vh;
        }

        .home_icon {
            height: 350%;
            margin-top: -10vh;
        }

        .icon_right .home_icon {
            margin-right: -25vw;
        }

        .icon_left .home_icon {
            margin-left: -25vw;
        }

        #home_icon_hammer{
            margin-top: 5vh;
        }
    }

    @media (max-width: 700px) {
        .section_with_icon {
            margin-bottom: 60vh;
        }
    }

    @media (max-width: 570px) {
        .section_with_icon {
            margin-bottom: 75vh;
        }

        #la_planche_logo{
            width: 70vw;
        }

        .home_main_img{
            width: 70vh;
        }
    }

    @media (max-width: 500px) {
        .section_with_icon {
            margin-bottom: 90vh;
        }
    }

    @media (max-width: 430px) {
        .section_with_icon {
            margin-bottom: 105vh;
        }

        .home_icon {
            height: 500%;
            margin-top: -10vh;
        }

        .icon_right .home_icon {
            margin-right: -40vw;
        }

        .icon_left .home_icon {
            margin-left: -40vw;
        }
    }

    @media (max-width: 370px) {
        .section_with_icon {
            margin-bottom: 120vh;
        }
    }
</style>