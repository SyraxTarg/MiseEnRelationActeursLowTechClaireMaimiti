<div class="user">

    <h1>Connexion</h1>

    <?php
    if (isset($msg))
        echo $msg;
    ?>

    <form method="POST" class="user_form" id="connexion_form">
        <div class="user_form_group">
            <label for="email">Email </label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="user_form_group">
            <label for="password">Mot de passe </label>
            <input type="password" name="password" id="password" required>
        </div>
        <input class="user_submit_button" type="submit" value="Me connecter">
    </form>

    <div class="row_align">
        <span>Pas encore de compte ? </span>
        <a class="link_action" href="index.php?page=inscription">Inscription</a>
    </div>

</div>

<style>
    .user {
        font-family: "Montserrat", sans-serif;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .user h1 {
        margin: 2vh 0;
    }

    .user p {
        margin: 0 0 2vh 0;
    }

    .user_form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 75vw;
    }

    .user_form_group {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

        margin: 2vh 0;
    }

    .user_form_group label {
        width: 30vw;
        padding: 0 2vw;

        text-align: right;
    }

    .user_form_group input {
        width: 40vw;
        height: 5vh;

        font-family: "Montserrat", sans-serif;
    }

    .user_submit_button {
        width: 15vw;
        height: 3vw;
        border: none;
        border-radius: 0.5vw;
        cursor: pointer;
        margin: 2vh 0;

        background-color: var(--bleu-marine);
        color: white;
        font-family: "Montserrat", sans-serif;
    }

    @media (max-width: 992px) {
        .user {
            font-size: 2vw;
        }

        .user h1 {
            font-size: 3.5vw;
        }

        .user_submit_button {
            margin: 5vh 0;
            font-size: 1.5vw;
        }
    }

    @media (max-width: 768px) {
        .user {
            font-size: 3vw;
        }

        .user h1 {
            font-size: 4vw;
        }

        .user_submit_button {
            width: 20vw;
            height: 5vw;
            margin: 2vh 0;
            font-size: 2vw;
        }

        .user_form_group input {
            width: 40vw;
            height: 3.5vh;
        }
    }
</style>