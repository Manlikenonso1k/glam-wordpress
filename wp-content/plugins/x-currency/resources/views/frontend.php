<script data-cfasync="false" type="text/javascript">
    <?php if ( defined( 'BREEZE_VERSION' ) ) : ?>
        function xCurrencyGetCookie(name) {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return cookie.substring(name.length + 1);
            }
        }
        return null;
    }

    function xCurrencySet() {
        if( xCurrencyGetCookie('currency_code') ) {
            return;
        }
        const searchParams = new URLSearchParams(window.location.search);

        searchParams.set('setcurrency', 1);

        window.location.href = window.location.origin + window.location.pathname + '?' + searchParams.toString();
    }

    xCurrencySet();

    <?php endif; ?>

    function xCurrencyRemoveURLParams() {

        const searchParams = new URLSearchParams(window.location.search);
        
        if(searchParams.has('setcurrency') || searchParams.has('currency')) {

            if("<?php x_currency_render( x_currency_global_settings()['no_get_data_in_link'] )?>") {
                searchParams.delete('currency');
            }
            searchParams.delete('setcurrency');
        
            const newParams = searchParams.toString();
        
            let url;

            if(newParams) {
                url = window.location.origin + window.location.pathname + '?' + newParams;
            } else {
                url = window.location.origin + window.location.pathname;
            }

            history.replaceState(null, '', url);
        }
    }
    xCurrencyRemoveURLParams();
</script>