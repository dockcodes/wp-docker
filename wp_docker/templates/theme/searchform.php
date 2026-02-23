<button class="search-mobile-btn" id="searchMobileBtn">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M15.2848 7.64151C15.2848 3.42849 11.8559 0 7.64241 0C3.42889 0 0 3.42849 0 7.64151C0 11.8545 3.42889 15.283 7.64241 15.283C9.5666 15.283 11.3261 14.5664 12.6694 13.3896L17.1309 17.8506C17.2311 17.9508 17.3602 18 17.4909 18C17.6217 18 17.7525 17.9508 17.851 17.8506C18.0497 17.6519 18.0497 17.3292 17.851 17.1306L13.3895 12.6696C14.5681 11.3247 15.2831 9.56547 15.2831 7.64151H15.2848ZM1.01899 7.64151C1.01899 3.99057 3.99104 1.01887 7.64241 1.01887C11.2938 1.01887 14.2658 3.99057 14.2658 7.64151C14.2658 11.2925 11.2938 14.2642 7.64241 14.2642C3.99104 14.2642 1.01899 11.2925 1.01899 7.64151Z"
              fill="#2C4D4B"/>
    </svg>
</button>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-main-wrapper col-12">
        <div class="search-header col-12">
            <h3><?php esc_html_e('Search', 'docktheme'); ?></h3>
            <button type="button" class="close-btn"
                    aria-label="<?php esc_attr_e('Close', 'docktheme'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use href="#close"/>
                </svg>
            </button>
        </div>
        <div class="search-input-wrapper col-12">
            <input type="search" class="search-field" placeholder="Znajdź kurs lub produkt"
                   value="<?php echo get_search_query(); ?>" name="s" autocomplete="off">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M15.2848 7.64151C15.2848 3.42849 11.8559 0 7.64241 0C3.42889 0 0 3.42849 0 7.64151C0 11.8545 3.42889 15.283 7.64241 15.283C9.5666 15.283 11.3261 14.5664 12.6694 13.3896L17.1309 17.8506C17.2311 17.9508 17.3602 18 17.4909 18C17.6217 18 17.7525 17.9508 17.851 17.8506C18.0497 17.6519 18.0497 17.3292 17.851 17.1306L13.3895 12.6696C14.5681 11.3247 15.2831 9.56547 15.2831 7.64151H15.2848ZM1.01899 7.64151C1.01899 3.99057 3.99104 1.01887 7.64241 1.01887C11.2938 1.01887 14.2658 3.99057 14.2658 7.64151C14.2658 11.2925 11.2938 14.2642 7.64241 14.2642C3.99104 14.2642 1.01899 11.2925 1.01899 7.64151Z"
                          fill="#2C4D4B"/>
                </svg>
            </span>
        </div>
        <input type="hidden" name="post_type" value="product">
        <div class="search-suggestions"></div>
    </div>
    <div class="menu-overlay"></div>
</form>
