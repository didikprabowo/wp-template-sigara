<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if (getLogo() == null) {
                    echo "<span class='footer_logo_text'>" . get_bloginfo() . "</span>";
                } else { ?>
                    <img class="lozad" data-src="<?php echo getLogo(); ?>" alt="logo" width="150">
                <?php } ?>

                <p class="pt-3"><?php echo get_bloginfo('description'); ?></p>
            </div>
            <div class="col-md-3">
                <ul class="perusahaan_list">
                    <?php
                    $menuLocations = get_nav_menu_locations();
                    $menuID = $menuLocations['footer_1'];
                    $primaryNav = wp_get_nav_menu_items($menuID);
                    ?>
                    <li class="perusahaan_header"> Perusahaan</li>
                    <?php
                    foreach ($primaryNav as $navItem) { ?>
                        <li> <a href=" <?php echo $navItem->url; ?>"><?php echo $navItem->title; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="perusahaan_list">
                    <li class="perusahaan_header"> Social Media</li>
                    <?php
                    foreach (wp_get_nav_menu_items(get_nav_menu_locations()['social_1'])  as $s) { ?>
                        <li><a href="<?php echo $s->url; ?>"> <?php echo getIcon($s->title); ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="end_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-muted">Di buat dengan Cinta 2019</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
<script>
    let menu = document.getElementById("navbarTogglerDemo02")
    const forms = `<form class="form-inline my-2 my-lg-0 form_search" action="/" method="get">
					<input class="form-control mr-sm-2" type="search" placeholder="Cari" name="s" value="<?php echo isset($_GET['s']) ? $_GET['s'] : ''  ?>">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>`
    menu.innerHTML = menu.innerHTML + forms;
</script>
</body>

</html>