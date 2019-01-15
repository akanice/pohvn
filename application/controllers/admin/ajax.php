<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

    public function widget_featured_tour() {
        $values = array(
            'heading'        => $this->input->post('f_tour_heading'),
            'description'    => $this->input->post('f_tour_description'),
            'number_display' => $this->input->post('f_tour_display'),
            'biggest'        => $this->input->post('f_tour_biggest'),
        );
        $this->widget_update('featured_tour', $values);
    }

    private function widget_update($section_name, $values) {
        $this->load->helper('url');
        $this->load->model('widgetmodel');
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';
        $data = array();
        $data = $this->widgetmodel->read(array('section_name' => $section_name));

        foreach ($data as $d) {
            $r = $this->widgetmodel->update(array('value' => $values[$d->position]), array(
                'section_name' => $section_name,
                'position'     => $d->position));
        }
        if (!$r) {
            $result->msg = 'Có lỗi xảy ra';
            echo json_encode($result);
            die();
        }

        $result->ok = true;
        echo json_encode($result);
        die();
    }

    public function widget_places() {
        $values = array(
            'heading'          => $this->input->post('places_heading'),
            'description'      => $this->input->post('places_description'),
            'number_display'   => $this->input->post('places_display'),
            'number_available' => $this->input->post('places_available'),
        );
        $this->widget_update('places', $values);
    }

    public function widget_blogs() {
        $values = array(
            'heading'          => $this->input->post('blogs_heading'),
            'description'      => $this->input->post('blogs_description'),
            'number_display'   => $this->input->post('blogs_display'),
            'number_available' => $this->input->post('blogs_available'),
        );
        $this->widget_update('blogs', $values);
    }

    public function widget_testimonials() {
        $values = array(
            'heading'          => $this->input->post('testimonials_heading'),
            'description'      => $this->input->post('testimonials_description'),
            'number_display'   => $this->input->post('testimonials_display'),
            'number_available' => $this->input->post('testimonials_available'),
        );
        $this->widget_update('testimonials', $values);
    }

    public function widget_footeruser1() {
        $values = array(
            'heading' => $this->input->post('footeruser1_heading'),
            'content' => $this->input->post('footeruser1_content'),
        );
        $this->widget_update('footeruser1', $values);
    }

    public function widget_footeruser2() {
        $values = array(
            'heading' => $this->input->post('footeruser2_heading'),
            'content' => $this->input->post('footeruser2_content'),
        );
        $this->widget_update('footeruser2', $values);
    }

    public function loadUrl() {
        if ($_POST['dataString']) {
            $type_url = $_POST['dataString'];
            switch ($type_url) {
                case "t_landing":
                    $this->load->model('newsmodel');
                    $data = $this->newsmodel->read(array("type" => 'landing'));
                    break;
                case "t_cat":
                    $this->load->model('newscategorymodel');
                    $data = $this->newscategorymodel->read(array());
                    break;
                case "t_page":
                    $this->load->model('pagesmodel');
                    $data = $this->pagesmodel->read(array());
                    break;
                default:
                    $data = '';
            }
            if ($data && $data != '') {
                foreach ($data as $item) {
                    $title = $item->title;
                    $id = $item->id;
                    echo '<option value="' . $id . '">' . $title . '</option>';
                }
            } else {
                echo '<option value="">--- Chọn ---</option>';
            }
        }
    }

    public function searchUser() {
        $userName = $_POST['username'];
        $this->load->model('affiliatesmodel');
        $result = $this->affiliatesmodel->getListUserAvailForAffi($userName);
        echo json_encode($result);
    }

    public function addAffiUser() {
        $userId = $_POST['id'];
        $this->load->model('affiliatesmodel');
        $result = $this->affiliatesmodel->createNewAffiliateUser($userId);
        echo json_encode($result);
    }
}
