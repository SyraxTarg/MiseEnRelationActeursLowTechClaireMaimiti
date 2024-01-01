<footer>
    <div id="adresse">
        <h2>Low Tech Bordeaux</h2>

        <p>
            Au Garage Moderne </br> 1, rue des Etrangers </br> 33300 Bordeaux </br> FRANCE
        </p>
    </div>
    <div id="mail">
        <h2>Mail</h2>

        <p>
            contact at <a href="mailto:lowtechbordeaux.org">lowtechbordeaux.org</a>
        </p>
    </div>
    <div id="reseaux">
        <h2>Réseaux</h2>
        <ul id="liensReseaux">
            <li class="socialLogo">
                <a href="https://www.facebook.com/lowtechbordeaux"><img src="./public/images/facebook.png" alt="facebook"></a>
            </li>
            <li class="socialLogo">
                <a href="https://www.instagram.com/lowtechlabbordeaux/"><img src="./public/images/instagram.png" alt="instagram"></a>
            </li>
            <li class="socialLogo">
                <a href="https://www.youtube.com/@low-techbordeaux5463"><img src="./public/images/youtube.png" alt="youtube"></a>
            </li>
            <li class="socialLogo">
                <a href="https://discord.com/invite/DHAfV7N43U"><img src="./public/images/discord.png" alt="discord"></a>
            </li>
            <li class="socialLogo">
                <a href="https://www.helloasso.com/associations/low-tech-bordeaux"><img src="./public/images/helloasso.png" alt="helloasso"></a>
            </li>
        </ul>
    </div>
    <div id="soutien">
        <h2>Avec le soutien de:</h2>
        <div id="logos">
            <img src="./public/images/ue.png" alt="union europeenne">
            <img src="./public/images/nvlleAquitaine.png" alt="nouvelle aquitaine">
        </div>
        
    </div>
</footer>



<style>
    footer #soutien img {
        height: 5vw;
    }

    footer #reseaux img{
        height:2vw;
        margin: 2%;

    }

    footer{
        display:flex;
        flex-direction: row;
        justify-content: space-around;
        background-color: #0F3F6C;
        color: white;
        padding-top: 2vw;
        margin-top: 5%;
        padding-bottom: 2vw;
        bottom: 0;
    }

    #liensReseaux{
        list-style: none;
        display: flex;
        flex-grow: 2;
        gap: 3%;
        
       
    }

    footer h2{
        display: flex;
        justify-content: center;
        margin-bottom: 1vw;
    }

    footer a {
        color: white;
    }

    #soutien #logos{
        display: flex;
        gap: 3%;
    }



</style>