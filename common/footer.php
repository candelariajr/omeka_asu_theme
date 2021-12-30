
<div class="custom-exhibit-nav d-none d-sm-block">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-3 col-lg-2 d-none d-sm-block">
                <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
                <div class="custom-exhibit-nav-button">
                    <?php echo $prevLink; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col custom-exhibit-nav-center d-none d-sm-block">
            </div>
            <div class="col-4 col-md-3 col-lg-2 d-none d-sm-block">
                <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
                <div class="custom-exhibit-nav-button">
                    <?php echo $nextLink; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<footer class="d-block d-sm-none d-md-none d-lg-none d-xl-none">
    <div class="container">
        <div class="row custom-mobile-foot-print">

        </div>
    </div>
</footer>
<footer class="custom-exhibit-mobile-foot d-lg-none d-sm-none d-xl-none">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="custom-exhibit-nav-button">
                    Previous Item
                </div>
            </div>
            <div class="col custom-exhibit-nav-center">
            </div>
            <div class="col-4">
                <div class="custom-exhibit-nav-button">
                    Next Item
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="custom-filler-boot">

</div>
</body>
</html>
