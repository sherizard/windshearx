<!-- Navigation -->
<nav class="navbar navbar-light static-top navbar-home">
    <div class="container">
        <a id="siteTitle" class="navbar-brand text-white" href="#">
            <?php echo $title ?>
        </a>

        <div class="">
            <?php foreach ($logos as $logo): ?>
                <img src="<?php echo base_url('assets/img/' . $logo->file) ?>"
                class="ws-logo" alt="Logo">&nbsp;
            <?php endforeach; ?>

            <?php if ($this->session->username): ?>
                <a class="btn btn-primary btn-circle" href="<?php echo base_url('admin') ?>">
                    <i class="fas fa-cog"></i>
                </a>&nbsp;
                <button id="btnLogout" class="btn btn-danger btn-circle"
                data-toggle="modal" data-target="#modalLogout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            <?php else: ?>
                <button id="btnLogin" class="btn btn-primary btn-circle"
                data-toggle="modal" data-target="#modalLogin">
                    <i class="fas fa-sign-in-alt"></i>
                </button>
            <?php endif; ?>
        </div>
    </div>
</nav>
