<nav>
    <div class="container">
        <a href="home.php" class="logo">
            <h2 class="logo"><img src="images/logo.png" alt="" />Scribbli</h2>
        </a>

        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="pesquisar pessoas" />
        </div>

        <div class="create">
            <label for="create-post" class="btn btn-primary">Criar</label>
            <div class="profie-picture">
                <img src="<?= $user_data['user_image'] ?>" alt="" />
            </div>
        </div>
    </div>
</nav>