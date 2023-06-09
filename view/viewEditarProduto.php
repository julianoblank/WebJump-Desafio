
<!doctype html>
<html ⚡>
<head>
    <title>Webjump | Backend Test | Add Product</title>
    <meta charset="utf-8">

    <link  rel="stylesheet" type="text/css"  media="all" href="../assets/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script></head>
<!-- Header -->
<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
    <div class="close-menu">
        <a on="tap:sidebar.toggle">
            <img src="images/bt-close.png" alt="Close Menu" width="24" height="24" />
        </a>
    </div>
    <a href="/public/dashboard"><img src="../assets/images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
    <div>
        <ul>
            <li><a href="/public/categorias" class="link-menu">Categorias</a></li>
            <li><a href="/public/produtos" class="link-menu">Produtos</a></li>
        </ul>
    </div>
</amp-sidebar>
<header>
    <div class="go-menu">
        <a on="tap:sidebar.toggle">☰</a>
        <a href="/public/dashboard" class="link-logo"><img src="../assets/images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
    </div>
    <div class="right-box">
        <span class="go-title">Administration Panel</span>
    </div>
</header>
<!-- Header -->
<!-- Main Content -->
<main class="content">
    <h1 class="title new-item"><?=$titulo?></h1>
    <div class="<?=isset($_SESSION['tipo-mensagem']) ? $_SESSION['tipo-mensagem'] : ''?>"><?=isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : '' ?></div>
    <?php
        unset($_SESSION['tipo-mensagem']);
        unset($_SESSION['mensagem']);
    ?>
    <form method="POST" action="/public/salvarProduto<?= isset($produto) ? '?id='.$produto->getId() : '';?>">
        <div class="input-field">
            <label for="sku" class="label">Product SKU</label>
            <input type="text" id="sku" name="sku" class="input-text" value="<?= isset($produto) ? $produto->getSku() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="name" class="label">Product Name</label>
            <input type="text" id="name" name="name" class="input-text" value="<?= isset($produto) ? $produto->getNome() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="price" class="label">Price</label>
            <input type="text" id="price" name="price" class="input-text" value="<?= isset($produto) ? $produto->getPreco() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="quantity" class="label">Quantity</label>
            <input type="text" id="quantity" name="quantity" class="input-text" value="<?= isset($produto) ? $produto->getQuantidade() : ''; ?>"/>
        </div>
        <div class="input-field">
            <label for="category" class="label">Categories</label>
            <select multiple id="category" name="category[]" class="input-text">
                <?php if(is_array($categorias)){
                        foreach ($categorias as $categoria):
                ?>
                         <option value="<?= $categoria->getId()?>"><?=$categoria->getNome() ?></option>
                  <?php  endforeach;
                    }?>
            </select>
        </div>
        <div class="input-field">
            <label for="description" class="label">Description</label>
            <textarea id="description" name="description" class="input-text"><?= isset($produto) ? $produto->getDescricao() : ''; ?></textarea>
        </div>
        <div class="actions-form">
            <a href=<?=$_SERVER['HTTP_REFERER']??'/public/dashboard' ?> class="action back">Back</a>
            <input class="btn-submit btn-action" type="submit" value="Save Product" />
        </div>

    </form>
</main>
<!-- Main Content -->

<!-- Footer -->
<footer>
    <div class="footer-image">
        <img src="../assets/images/go-jumpers.png" width="119" height="26" alt="Go Jumpers" />
    </div>
    <div class="email-content">
        <span>go@jumpers.com.br</span>
    </div>
</footer>
<!-- Footer --></body>
</html>

