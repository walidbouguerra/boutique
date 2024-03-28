	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Boutique</h1>
					<nav class="d-flex align-items-center">
						<a href="/">Accueil<span class="lnr lnr-arrow-right"></span></a>
						<a href="/shop">Shop<span class="lnr"></span></a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Catégories</div>
					<ul class="main-categories">
						<?php foreach ($categories as $categorie) : ?>
						<li class="main-nav-list"><a data-toggle="collapse" href="#cat<?= $categorie->id ?>" aria-expanded="false" aria-controls="cat<?= $categorie->id ?>"><span
								 class="lnr lnr-arrow-right"></span><?= $categorie->nom ?><span class="number">(<?= $categorie->nbProduits ?>)</span></a>
							<ul class="collapse" id="cat<?= $categorie->id ?>" data-toggle="collapse" aria-expanded="false" aria-controls="cat<?= $categorie->id ?>">
								<?php foreach ($categorie->sous_categories as $sous_categorie) : ?>
								<li class="main-nav-list child"><a href="/shop/cat<?= $sous_categorie->id ?>"><?= $sous_categorie->nom ?><span class="number">(<?= $sous_categorie->nbProduits ?>)</span></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<form method="get" action="/shop<?=isset($id) ? '/cat' . $id : null?>/page<?=$currentPage?>">
							<select name="order" onchange="this.form.submit()">
								<option value="1">Nouveautés</option>
								<option value="2">Prix croissant</option>
								<option value="3">Prix décroissant</option>
							</select>
						</form>
					</div>
					<div class="sorting mr-auto">
						<form action="/shop<?=isset($id) ? '/cat' . $id : null?>/page<?=$currentPage?>">
							<select name="show" onchange="this.form.submit()">
								<option value="1"><a href="">Show 1</a></option>
								<option value="2"><a href="">Show 2</a></option>
								<option value="3"><a href="">Show 3</a></option>
							</select>
						</form>
					</div>
					<div class="pagination">
						<a href="/shop/<?= isset($id) ? 'cat' . $id . '/page' . (($currentPage - 1) < 1 ? $nbPages : ($currentPage - 1)) : 'page' . (($currentPage - 1) < 1 ? $nbPages : ($currentPage - 1))?>" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<?php for ($i = 1; $i <= $nbPages; $i++) : ?>
						<a href="/shop/<?= isset($id) ? 'cat' . $id . '/page' . $i : 'page' . $i?>" <?=$currentPage == $i ? "class=\"active\"" : null ?>><?= $i ?></a>
						<?php endfor; ?>
						<!-- <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a> -->
						<a href="/shop/<?= isset($id) ? 'cat' . $id . '/page' . (($currentPage + 1) > $nbPages ? 1 : ($currentPage + 1)) : 'page' . (($currentPage + 1) > $nbPages ? 1 : ($currentPage + 1))?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<?php foreach ($produits as $produit) : ?>
						<!-- single product -->
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="img/product/<?= $produit->image ?>" alt="">
								<div class="product-details">
									<h6><?= $produit->nom ?></h6>
									<div class="price">
										<h6><?= $produit->prix ?> €</h6>
									</div>
									<div class="prd-bottom">

										<a href="/panier/add/<?=$produit->id?>" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">Ajouter</p>
										</a>
										<a href="/shop/<?=$produit->id?>" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">Détails</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center justify-content-center">
					<div class="pagination">
						<a href="/shop/<?= isset($id) ? 'cat' . $id . '/page' . (($currentPage - 1) < 1 ? $nbPages : ($currentPage - 1)) : 'page' . (($currentPage - 1) < 1 ? $nbPages : ($currentPage - 1))?>" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<?php for ($i = 1; $i <= $nbPages; $i++) : ?>
						<a href="/shop/<?= isset($id) ? 'cat' . $id . '/page' . $i : 'page' . $i?>" <?=$currentPage == $i ? "class=\"active\"" : null ?>><?= $i ?></a>
						<?php endfor; ?>
						<!-- <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a> -->
						<a href="/shop/<?= isset($id) ? 'cat' . $id . '/page' . (($currentPage + 1) > $nbPages ? 1 : ($currentPage + 1)) : 'page' . (($currentPage + 1) > $nbPages ? 1 : ($currentPage + 1))?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>