<!doctype html>
<html ⚡>
<head>
    <title>Webjump | Backend Test | Dashboard</title>
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
            <img src="../assets/images/bt-close.png" alt="Close Menu" width="24" height="24" />
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
    <div class="header-list-page">
        <h1 class="title">Dashboard</h1>
    </div>
    <div class="infor">
        You have <?= $totalProdutos ?> products added on this store: <a href="/public/adicionarProduto" class="btn-action">Add new Product</a>
    </div>
    <?php if(is_array($produtos)){?>
        <ul class="product-list">
            <?php foreach ($produtos as $produto): ?>
                <li>
                    <div class="product-image">
                        <img src="../assets/images/product/tenis-runner-bolt.png" layout="responsive" width="164" height="145" alt="Tênis Runner Bolt" />
                    </div>
                    <div class="product-info">
                        <div class="product-name"><span><?= $produto->getDescricao() ?></span></div>
                        <div class="product-price"><span class="special-price"><?=$produto->getQuantidade().' avaiable' ?></span> <span><?= 'R$'.str_replace('.',',',number_format($produto->getPreco(),2)) ?></span></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php } ?>
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