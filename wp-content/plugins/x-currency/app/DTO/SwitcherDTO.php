<?php

namespace XCurrency\App\DTO;

class SwitcherDTO
{
    private int $id;

    private string $title;

    private string $type;

    private bool $active_status = false;

    private string $custom_css = '';

    private string $customizer_id;

    private string $template;

    private string $package;

    /**
     * Get the value of id
     *
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function set_id( int $id ) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function set_title( string $title ) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return string
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param string $type
     *
     * @return self
     */
    public function set_type( string $type ) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of active_status
     *
     * @return bool
     */
    public function is_active_status() {
        return $this->active_status;
    }

    /**
     * Set the value of active_status
     *
     * @param bool $active_status
     *
     * @return self
     */
    public function set_active_status( bool $active_status ) {
        $this->active_status = $active_status;

        return $this;
    }

    /**
     * Get the value of custom_css
     *
     * @return string
     */
    public function get_custom_css() {
        return $this->custom_css;
    }

    /**
     * Set the value of custom_css
     *
     * @param string $custom_css
     *
     * @return self
     */
    public function set_custom_css( string $custom_css ) {
        $this->custom_css = $custom_css;

        return $this;
    }

    /**
     * Get the value of customizer_id
     *
     * @return string
     */
    public function get_customizer_id() {
        return $this->customizer_id;
    }

    /**
     * Set the value of customizer_id
     *
     * @param string $customizer_id
     *
     * @return self
     */
    public function set_customizer_id( string $customizer_id ) {
        $this->customizer_id = $customizer_id;

        return $this;
    }

    /**
     * Get the value of template
     *
     * @return string
     */
    public function get_template() {
        return $this->template;
    }

    /**
     * Set the value of template
     *
     * @param string $template
     *
     * @return self
     */
    public function set_template( string $template ) {
        $this->template = $template;

        return $this;
    }

    /**
     * Get the value of package
     *
     * @return string
     */
    public function get_package() {
        return $this->package;
    }

    /**
     * Set the value of package
     *
     * @param string $package
     *
     * @return self
     */
    public function set_package( string $package ) {
        $this->package = $package;

        return $this;
    }
}
