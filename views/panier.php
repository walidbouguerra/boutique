
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Panier</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Accueil<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/panier">Panier</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area"  id ="table">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Produit</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($panier as $produit): ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/<?=$produit->image?>" alt="" width="150">
                                        </div>
                                        <div class="media-body">
                                            <p><?=$produit->nom?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?=$produit->prix?> €</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" class="qty" maxlength="12" value="<?=$produit->quantite?>" class="input-text qty">
                                        <button class="increase items-count qtyup"  type="button"><a href="/panier/1/<?=$produit->id?>"><i class="lnr lnr-chevron-up"></i></a></button>
                                        <button class="reduced items-count qtydown" type="button"><a href="/panier/2/<?=$produit->id?>"><i class="lnr lnr-chevron-down"></i></a></button>
                                    </div>
                                </td>
                                <td>
                                    <h5><?=($produit->prix) * ($produit->quantite)?> €</h5>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->