<div class="w-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><?= isset($pageTitle) ? $pageTitle : 'Author'; ?></span>

            <div class="ms-auto">
                <span class="me-3">
                    <i class="bi bi-person-circle"></i>
                    <?= htmlspecialchars($_SESSION['nama']); ?>
                </span>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-4">