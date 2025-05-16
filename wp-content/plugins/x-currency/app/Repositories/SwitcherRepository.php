<?php

namespace XCurrency\App\Repositories;
use XCurrency\App\DTO\SwitcherDTO;

class SwitcherRepository {
    public function get() {
        $args = [
            'post_type'   => x_currency_config()->get( 'app.switcher_post_type' ),
            'post_status' => 'publish, draft',
            'numberposts' => -1,
            'order'       => 'ASC'
        ];

        return get_posts( $args );
    }

    public function get_side_sticky() {
        $posts = get_posts(
            [
                'post_type'   => x_currency_config()->get( 'app.switcher_post_type' ),
                'post_status' => 'publish',
                'numberposts' => -1,
                'meta_query'  => [
                    [
                        'key'     => 'type',
                        'value'   => 'sticky',
                        'compare' => '='
                    ]
                ]
            ] 
        );
        return $this->switcher_list_data( $posts );
    }

    public function create( SwitcherDTO $dto ) {
        $args = [
            'post_title'  => $dto->get_title(),
            'post_type'   => x_currency_config()->get( 'app.switcher_post_type' ),
            'post_status' => $dto->is_active_status() == true ? 'publish' : 'draft'
        ];

        $post_id = wp_insert_post( $args );

        $custom_css = $dto->get_custom_css();

        // Save custom css
        if ( ! empty( $custom_css ) ) {
            add_post_meta( $post_id, 'custom_css', $custom_css );
        }

        add_post_meta( $post_id, 'type', $dto->get_type() );
        add_post_meta( $post_id, 'customizer_id', $dto->get_customizer_id() );
        add_post_meta( $post_id, 'template', $dto->get_template() );
        add_post_meta( $post_id, 'package', $dto->get_package() );

        return $post_id;
    }

    public function update( SwitcherDTO $dto ) {
        $post_id = $dto->get_id();

        $args = [
            'ID'          => $dto->get_id(),
            'post_title'  => $dto->get_title(),
            'post_type'   => x_currency_config()->get( 'app.switcher_post_type' ),
            'post_status' => $dto->is_active_status() == true ? 'publish' : 'draft'
        ];

        wp_update_post( $args );

        // Save custom css
        if ( ! empty( $custom_css ) ) {
            update_post_meta( $post_id, 'custom_css', $custom_css );
        }

        update_post_meta( $post_id, 'type', $dto->get_type() );
        update_post_meta( $post_id, 'customizer_id', $dto->get_customizer_id() );
        update_post_meta( $post_id, 'template', $dto->get_template() );
        update_post_meta( $post_id, 'package', $dto->get_package() );

        return $post_id;
    }

    /**
     * @param $posts
     * @return mixed
     */
    public function switcher_list_data( $posts ) {
        $post_type   = x_currency_config()->get( 'app.switcher_post_type' );
        $final_posts = [];
        foreach ( $posts as $value ) {
            $meta_values               = $this->post_meta( $value->ID );
            $meta_values['id']         = $value->ID;
            $meta_values['name']       = $value->post_title;
            $meta_values['short_code'] = "[" . $post_type . " id=" . $value->ID . "]";
            $meta_values['active']     = $value->post_status == 'publish' ? true : false;
            $final_posts[$value->ID]   = $meta_values;
        }
        return $final_posts;
    }

    /**
     * @param $post_id
     */
    private function post_meta( $post_id ) {
        $switcher_type = get_post_meta( $post_id, 'type', true );
        $customizer_id = get_post_meta( $post_id, 'customizer_id', true );
        $package       = get_post_meta( $post_id, 'package', true );
        $page          = get_post_meta( $post_id, 'page', true );

        if ( empty( $page ) ) {
            $page = 'all';
        }

        return [
            'type'          => $switcher_type,
            'page'          => $page,
            'template'      => get_post_meta( $post_id, 'template', true ),
            'custom_css'    => get_post_meta( $post_id, 'custom_css', true ),
            'customizer_id' => empty( $customizer_id )  ? $switcher_type . '-default' : $customizer_id,
            'package'       => empty( $package )  ? 'free' : $package,
        ];
    }

    public function organizer( $ids, $type ) {
        switch ( $type ) {
            case 'active':
                foreach ( $ids as $id ) {
                    wp_update_post( ['ID' => $id, 'post_status' => 'publish'] );
                }
                break;
            case 'deactive':
                foreach ( $ids as $id ) {
                    wp_update_post( ['ID' => $id, 'post_status' => 'draft'] );
                }
                break;
            case 'delete':
                foreach ( $ids as $id ) {
                    wp_delete_post( $id, true );
                }
                break;
        }
    }
}