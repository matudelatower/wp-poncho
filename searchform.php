<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <div class="input-group">
        <input type="text" class="form-control" placeholder="Realizá una búsqueda" name="s"
               value="<?php echo get_search_query(); ?>">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>

</form>
