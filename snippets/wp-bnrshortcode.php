<?php $dynamic_slider = $this->meta_data;?>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $i = 1;
        foreach( $dynamic_slider as $key => $data ):
        $img_src = wp_get_attachment_url( $data['banner_image'], 'full' );?>
            <div class="carousel-item <?php echo $i == 1 ? 'active' : '' ?>">
                <img src="<?php echo $img_src;?>" class="d-block w-100" alt="<?php echo $data['banner_title']?>">
            </div>
        <?php $i++;
        endforeach;?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>